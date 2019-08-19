<?
namespace OptimalGroup;

class City {
    private $RegionIblock = BRANCH_IBLOCK;
    private function GetGeoData($ip){
        require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/IpGeo/ipgeobase.php');
        $CIDRFile = $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/IpGeo/cidr_optim.txt';
        $CitiesFile = $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/IpGeo/cities.txt';
        $gb = new \IPGeoBase($CIDRFile, $CitiesFile);
        $data = $gb->getRecord($ip);        
        return $data;
    }
    private function GetRegionIblock($filter){
        $SiteType = SiteSection::Get();
        $result = false;
        $cache_dir = "/branch";
        $cache = \Bitrix\Main\Data\Cache::createInstance(); 
        if ($cache->initCache("360000", serialize($filter).serialize($SiteType), $cache_dir)) 
        {
            $result = $cache->getVars(); 
        } 
        elseif ($cache->startDataCache()) 
        {
            \CModule::IncludeModule("iblock");
            $arSelect = Array("ID", "NAME", "IBLOCK_ID","PROPERTY_*");
            $arFilter = Array("IBLOCK_ID"=>$this->RegionIblock, "ACTIVE"=>"Y");
            $res = \CIBlockElement::GetList(Array(), array_merge($arFilter,$filter), false, Array("nPageSize"=>1), $arSelect);
            
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache($cache_dir);
            
            while($ob = $res->GetNextElement()){
                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();
                $CACHE_MANAGER->RegisterTag("iblock_id_".$arFields["IBLOCK_ID"]);
                foreach ($arProps as $code=>$arProperty){
                    if ($code == "GROUP")
                        $arFields[$code] = $arProperty['VALUE_XML_ID'];
                    else
                        $arFields[$code] = $arProperty['~VALUE'];
                }
                if ($SiteType['CODE'] == "business"){
                    $arFields['PHONE'] = $arFields['PHONE_LEGAL'];
                    unset($arFields['PHONE_LEGAL']);
                    $arFields['PHONE_ADD'] = $arFields['PHONE_ADD_LEGAL'];
                    unset($arFields['PHONE_ADD_LEGAL']);
                }
                //Clean ~fields
                foreach ($arFields as $code=>$field)
                    if (substr($code, 0, 1) == "~") unset($arFields[$code]);
                $result = $arFields;
            }
            if ($isInvalid) { 
                $cache->abortDataCache(); 
            }
            
            $CACHE_MANAGER->EndTagCache();
            
            $cache->endDataCache($result); 
        }

        return $result;
    }
    private function GetListByRegion($type){
        global $APPLICATION, $USER;
        $domain = SiteSection::GetSubDomain();
        $is_shop = false;
        $ip = $_SERVER["REMOTE_ADDR"];
        
        $default_id = DEFAULT_REGION_ID;
        
        if ($domain == "shop") {
            $is_shop = true;
        }
        if (!empty($_SERVER["HTTP_X_REAL_IP"]))
			$ip = $_SERVER["HTTP_X_REAL_IP"];
        if ($_REQUEST['ip'])
            $ip = $_REQUEST['ip'];
            
        $currentRegion = self::GetGeoData($ip);
        
        if (!$domain){
            $this->RedirectCookie();
        }
        
        
        $result = array(
            'IP' => $currentRegion
        );
        if (!$result['IBLOCK']){
            if (empty($domain)) {
                $result['IBLOCK'] = $this->SetRegionById($default_id);
            }
            else {
                $result['IBLOCK'] = $this->SetRegionByDomain($domain);
                if (!$is_shop){
                    $result['AGREED'] = true;
                }
            }
        }
        if ($result['IBLOCK']['GROUP'] != "all" && $is_shop) {
            $result['NO_STORE'] = $result['IBLOCK'];
            $cookie = $this->GetCookieRegion();
            
            if ($cookie){
                $result['IBLOCK'] = $this->SetRegionByDomain($cookie);
                $result['AGREED'] = true;
            }
            else 
                $result['IBLOCK'] = $this->SetRegionById($default_id);
        }
        
        //if (
//            $result['IBLOCK']['URL'] != $domain 
//            && $APPLICATION->sDirPath != "/bitrix/admin/" 
//            && $result['IBLOCK']['URL'] 
//            && !$USER->IsAdmin()
//            && !$is_shop)
//        {
//            $NewDomain = Url::Make($result['IBLOCK']['URL']);
//            unset($_SESSION['BXExtra']);
//            LocalRedirect($NewDomain.$APPLICATION->GetCurUri(),true,"301 Moved permanently");
//        }
        $this->ShopPriceCode($result['IBLOCK']['URL']);
        
        return $result;
    }
    private function ShopPriceCode($domain_url){
        \CModule::IncludeModule("catalog");
        $result = array();
        $dbPriceType = \CCatalogGroup::GetList(
            array("SORT" => "ASC"),
            array("%NAME" => strtoupper($domain_url))
        );
        while ($arPriceType = $dbPriceType->Fetch()){
            $result = $arPriceType;
        }
        $_SESSION['BXExtra']['PRICE'] = $result;
    }
    public function RedirectCookie(){
        $cookie = $this->GetCookieRegion();
        if ($cookie){
            global $APPLICATION;
            $NewDomain = Url::Make($cookie);
            unset($_SESSION['BXExtra']);
            LocalRedirect($NewDomain.$APPLICATION->GetCurUri(),true,"301 Moved permanently");
        }
    }
    public function GetCookieRegion(){
        return \Bitrix\Main\Application::getInstance()->getContext()->getRequest()->getCookie("REGION");        
    }
    public function SetCookieRegion($code){
        $cookie = new \Bitrix\Main\Web\Cookie("REGION", $code, time() + 60*60*24*60);
        $cookie->setDomain("esplus.ru");
        \Bitrix\Main\Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
    }
    public function SetRegionById($id, $change){
        $result = $this->GetRegionIblock(array('ID' => $id));
        $this->SetCookieRegion($result['URL']);
        if ($result && $change){
            $_SESSION['BXExtra']['REGION']['IBLOCK'] = $result;
            $_SESSION['BXExtra']['REGION']['AGREED'] = true;
            $this->ShopPriceCode($result['URL']);
        }
        return $result;
    }
    public function SetRegionByDomain($domain, $change){
        $result = $this->GetRegionIblock(array('PROPERTY_URL' => $domain));
        
        $this->SetCookieRegion($result['URL']);
        if ($result && $change){
            $_SESSION['BXExtra']['REGION']['IBLOCK'] = $result;
            $_SESSION['BXExtra']['REGION']['AGREED'] = true;
            $this->ShopPriceCode($result['URL']);
        }
        return $result;
    }
    
    public function GetRegionById($id){
        $cityObj = $this;
        if (!$this)
            $cityObj = new \OptimalGroup\City;
        return $cityObj->GetRegionIblock(array("ID"=>$id));
    }
    public function GetRegionByDomain($domain){
        $cityObj = $this;
        if (!$this)
            $cityObj = new \OptimalGroup\City;
        return $cityObj->GetRegionIblock(array('PROPERTY_URL' => $domain));
    }
    public function Init($type){
        if (Main::isBot()) return false;
        if (!$_SESSION['BXExtra']['REGION'] || $type == "m"){ 
            $UserCity = $this->GetListByRegion($type);            
            $_SESSION['BXExtra']['REGION'] = $UserCity;
        }
        else {
            $UserCity = $_SESSION['BXExtra']['REGION'];
        }
        return $UserCity;
    }
    public function GetBranchList($cityFilter){
        $arBranchList = array();
        $domain = SiteSection::GetSubDomain();
        $branchFilter = array("IBLOCK_ID"=>BRANCH_IBLOCK, "ACTIVE"=>"Y");
        if ($cityFilter){
            $branchFilter = array_merge($branchFilter,$cityFilter);
        }
        
        if ($domain == "shop"){
            $branchFilter['PROPERTY_GROUP'] = PROPERTY_BRANCH_ALL;
        }
        
        $cache_id = "city_list";
        $cache_id .= implode('.',$branchFilter);
        $cache_dir = "/city-list";
        $cache = \Bitrix\Main\Data\Cache::createInstance(); 
        if ($cache->initCache("360000", $cache_id, $cache_dir)) 
        {
            $arBranchList = $cache->getVars(); 
        } 
        elseif ($cache->startDataCache()) 
        {
            \CModule::IncludeModule("iblock");
            $arBranchList = array(); 

            $arSelect = Array("ID", "NAME", "IBLOCK_ID", "SORT", "PROPERTY_*");
            $res = \CIBlockElement::GetList(array("SORT"=>"ASC"), $branchFilter, false, false, $arSelect);

            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache($cache_dir);

            while($ob = $res->GetNextElement())
            {
                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();
                
                foreach ($arProps as $code=>$arProperty){
                    if ($code == "GROUP")
                        $arFields[$code] = $arProperty['VALUE_XML_ID'];
                    else
                        $arFields[$code] = $arProperty['~VALUE'];
                }
                if ($SiteType['CODE'] == "business"){
                    $arFields['PHONE'] = $arFields['PHONE_LEGAL'];
                    unset($arFields['PHONE_LEGAL']);
                    $arFields['PHONE_ADD'] = $arFields['PHONE_ADD_LEGAL'];
                    unset($arFields['PHONE_ADD_LEGAL']);
                }
                //Clean ~fields
                foreach ($arFields as $code=>$field)
                    if (substr($code, 0, 1) == "~") unset($arFields[$code]);
                    
                $arBranchList[] = $arFields;

                $CACHE_MANAGER->RegisterTag("iblock_id_".$arFields["IBLOCK_ID"]);
            }
            if ($isInvalid) { 
                $cache->abortDataCache(); 
            } 
            $CACHE_MANAGER->EndTagCache();

            $cache->endDataCache($arBranchList); 
        }
        return $arBranchList;
    }
}
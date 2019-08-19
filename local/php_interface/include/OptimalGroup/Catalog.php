<?
namespace OptimalGroup;
class Catalog {
    /*
    Get catalog section list id by section proprty "UF_TYPE"
    */
    private function GetList($code){
        $result = array();        
        $cache_dir = "/section-types";
        $cache = \Bitrix\Main\Data\Cache::createInstance(); 
        if ($cache->initCache("36000", "section-type".$code, $cache_dir)) 
        {
            $result = $cache->getVars(); 
        } 
        elseif ($cache->startDataCache()) 
        {
            \CModule::IncludeModule("iblock");
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache($cache_dir);
                
            $result = array();
            $arFilter = Array('IBLOCK_ID'=>CATALOG_IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y', 'UF_TYPE'=> $code);
            $db_list = \CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
            while($ar_result = $db_list->GetNext()){
                $CACHE_MANAGER->RegisterTag("iblock_id_".$ar_result["IBLOCK_ID"]);
                $result[] = $ar_result['ID'];
            }
            if ($isInvalid) { 
                $cache->abortDataCache(); 
            } 
            $CACHE_MANAGER->EndTagCache();
            $cache->endDataCache($result); 
        }
        return $result;
    }
    /*
    Get catalog section property list of "UF_TYPE"
    */
    private function SectionsType(){
        \CModule::IncludeModule("iblock");
        $result = array();
        $rsUField = \CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME" => 'UF_TYPE'));   
        while($arUField = $rsUField->GetNext())   {      
            $result[$arUField['XML_ID']] = $arUField['ID'];
        }
        return $result;
    }
    /*
    Get catalog sections list by property "UF_TYPE"
    */
    public function GetSectionsListByType(){   
        $UfList = self::SectionsType();
        $result = array(); 
        foreach ($UfList as $code=>$uf){
            $result[$code] = self::GetList($uf);
        }
        return $result;
    }
    /*
    Get catalog sections id by code of it throw property "UF_TYPE"
    */
    public function GetSectionsIdByCode($code){
        $UfList = self::SectionsType();
        $result = array();
        if ($code) {
           $result = self::GetList($UfList[$code]); 
        }
        return $result;
    }
    /*
    Get stock list by product ids or all stocks in current branch
    @var $id = "all" or array of product id
    */
    public function GetStock($id){
        if (empty($id)) exit();
        $arResult = array();
        if ($id == "all"){
            $arFilter = Array("UF_REGION"=>$_SESSION['BXExtra']['REGION']['IBLOCK']['ID']);
        }
        else {
            $arFilter = Array("PRODUCT_ID"=>$id, ">PRODUCT_AMOUNT"=>0, "UF_REGION"=>$_SESSION['BXExtra']['REGION']['IBLOCK']['ID']);
        }
        $cache_dir = "/stock-list";
        $cache = \Bitrix\Main\Data\Cache::createInstance(); 
        if ($cache->initCache("36000", serialize($arFilter), $cache_dir)) 
        {
            $arResult = $cache->getVars(); 
        } 
        elseif ($cache->startDataCache()) 
        {
            \CModule::IncludeModule("catalog");
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache($cache_dir);
            $arSelectFields = Array("*", "UF_*");
            $res = \CCatalogStore::GetList(Array(),$arFilter,false,false,$arSelectFields);
            while ($arRes = $res->GetNext()){
                if (is_array($id)){
                    $arResult[$arRes['ELEMENT_ID']][] = $arRes;
                }
                else {
                    $arResult[] = $arRes;            
                }
                $CACHE_MANAGER->RegisterTag("stock_".$arRes["ID"]);
            }
            if ($isInvalid) { 
                $cache->abortDataCache(); 
            } 
            $CACHE_MANAGER->EndTagCache();
            $cache->endDataCache($arResult); 
        }
        return $arResult;
    }
    /*
    Product stock quantity for public view
    */
    public function GetStockView($count){
        $result = 0;
        if ($count == 1) $result = 1;
        elseif($count <= 3 && $count > 1) $result = 2;
        elseif($count <= 9 && $count > 3) $result = 3;
        elseif($count <= 28 && $count > 9)  $result = 4;
        elseif($count >= 29)  $result = 5;
        return $result;
    }
    /*
    Get current products id and quantity in basket
    */
    public function InCart(){
        \CModule::IncludeModule('sale');
        $fUserId = (int) \CSaleBasket::GetBasketUserID(true);
        $arCart = array();
        if ($fUserId > 0) {
            $dbBasketItems = \CSaleBasket::GetList(
                array("NAME" => "ASC", "ID" => "ASC"),
                array("FUSER_ID" => $fUserId, "LID" => 's1', "ORDER_ID" => "NULL"),
                false,
                false,
                array()
            );
            while($Basket=$dbBasketItems->GetNext()){
                $arCart['CART'][] = $Basket;
                $arCart['QUANTITY'][$Basket['PRODUCT_ID']] = $Basket['QUANTITY'];
            }
            return $arCart;
        }
    }
    /*
    Recalculate product in basket when branch is changed
    */
    public function RecalculateCart(){
        $inCart = self::InCart();
        foreach ($inCart['CART'] as $basketItem){
            $newPrice = array();
            $db_res = \CPrice::GetList(array(),array("PRODUCT_ID" => $basketItem['PRODUCT_ID'], "CATALOG_GROUP_ID" => $_SESSION['BXExtra']['PRICE']['ID']));
            while ($arPriceRes = $db_res->Fetch()){
                $newPrice = array(
                    "PRICE" => $arPriceRes['PRICE'],
                    "PRICE_TYPE_ID"  => $arPriceRes['CATALOG_GROUP_ID'],
                    "PRODUCT_PRICE_ID" => $arPriceRes['ID']
                );
            }
            if ($newPrice && \CModule::IncludeModule("sale")){
                \CSaleBasket::Update($basketItem['ID'], $newPrice);
            }
        }
    }
    /*
    Get product id filtered by current branch stocks and quantity on it for catalog
    */
    public function GetProductsIdByStock($params,$filter){  
        $result = array();
        $localFilter = array(
            "ACTIVE" => "Y",
            "IBLOCK_ID" => $params['IBLOCK_ID'],
            "INCLUDE_SUBSECTIONS" => $params['INCLUDE_SUBSECTIONS'],
        );
        if ($params['SECTION_CODE'])
            $localFilter['SECTION_CODE'] = $params['SECTION_CODE'];
        $cache_dir = "/product-stock";
        $cache = \Bitrix\Main\Data\Cache::createInstance(); 
        if ($cache->initCache($params['CACHE_TIME'], serialize($filter).serialize($params), $cache_dir)) 
        {
            $result = $cache->getVars(); 
        } 
        elseif ($cache->startDataCache()) 
        {
            \CModule::IncludeModule("iblock");
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache($cache_dir);
            if ($filter){
                $localFilter = array_merge($filter,$localFilter);
            }
            $InStock = array();
            $NoStock = array();
            $result = array();
            $res = \CIBlockElement::GetList(array(), $localFilter, false, false, array("ID","NAME"));
            while($ar_fields = $res->GetNext()){
                $CACHE_MANAGER->RegisterTag("iblock_id_".$ar_fields["IBLOCK_ID"]);
                $CurrentIDs[] = $ar_fields['ID'];
            }
            if ($CurrentIDs){
                $arStocks = \OptimalGroup\Catalog::GetStock($CurrentIDs);
                foreach ($CurrentIDs as $id){
                    $arItem['STOCK'] = $arStocks[$id];
                    if ($params['SHOW_ALL_STOCK'] != "all")
                        if (!$arItem['STOCK']) continue;

                    $maxQuantity = 0;
                    foreach ($arItem['STOCK'] as $arStock){
                        if ($arStock['PRODUCT_AMOUNT']>$maxQuantity) $maxQuantity = $arStock['PRODUCT_AMOUNT'];
                    }
                    $stock_availability = \OptimalGroup\Catalog::GetStockView($maxQuantity);
                    if ($stock_availability){
                        $InStock[] = $result[] = $id;

                    } else {
                        $NoStock[] = $id;         
                    }
                }
                if ($params['SHOW_ALL_STOCK'] == "all"){
                    $result = array_merge($InStock,$NoStock);
                }
            }
            if ($isInvalid) { 
                $cache->abortDataCache(); 
            } 
            $CACHE_MANAGER->EndTagCache();
            $cache->endDataCache($result); 
        }
        
        return $result;
    }
    public function GetItemsForBasket($arProductId, $sUrl){
        \Bitrix\Main\Loader::includeModule('iblock');    
        $arItems = [];
        $rs = \CIBlockElement::GetList([], ['ID' => $arProductId], false, false, ['ID', 'NAME', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'IBLOCK_SECTION_ID', 'PRODUCT_ID']);
        while ($rsResult = $rs->GetNext()) {
            $isService = false;
            $nav = \CIBlockSection::GetNavChain(false, $rsResult['IBLOCK_SECTION_ID']);
            while($ar_group = $nav->GetNext()){
                if ($ar_group['ID'] == CATALOG_IBLOCK_SERVICE_SECTION)
                    $isService = true;
            }
            $img = "";
            if ($rsResult['PREVIEW_PICTURE'])
               $img = $rsResult['PREVIEW_PICTURE'];
            if ($rsResult['DETAIL_PICTURE'])
               $img = $rsResult['DETAIL_PICTURE'];

            if ($img)            
                $img = $sUrl . "" . \CFile::ResizeImageGet($img, array('width'=>100, 'height'=>100), BX_RESIZE_IMAGE_PROPORTIONAL, false)['src'];
            elseif ($isService)
                $img = $sUrl . "" .MEDIA_PATH . "icons/icon-service-no-photo.jpg";
            else
                $img = $sUrl . "" .MEDIA_PATH . "images/no_image.jpg";
            
            $rsResult['IMAGE'] = $img;
            
            $arItems[$rsResult['ID']] = $rsResult;
        }
        return $arItems;
    }
}
\Bitrix\Main\Loader::includeModule('catalog');
\Bitrix\Main\Loader::includeModule('sale');
class CatalogProductProvider extends \CCatalogProductProvider
{
    public static function GetProductData($params)
    {
        $params['CHECK_PRICE'] = "N";//Need to store current price for branch
        $result = parent::GetProductData($params);
        return $result;
    }
    
}
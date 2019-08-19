<?
namespace OptimalGroup;

class SiteSection {    
    const names = array(
        "home" => array(
            "CODE"=>"home",
            "ID"=> 2,
            "NAME"=>"Для дома"
        ),
        "business"=> array(
            "CODE"=>"business",
            "ID"=> 3,
            "NAME"=>"Для бизнеса"
        ),
        "shop" => array(
            "CODE" => "shop",
            "ID" => 79708,
            "NAME" => "Интернет магазин"
        )
    );
    public function Set($code){
        $names = self::names;
        $_SESSION['BXExtra']['SITE'] = $names[$code];
        return $_SESSION['BXExtra']['SITE'];
    }
    public function Get(){
        $names = self::names;
        if(!$_SESSION['BXExtra']['SITE']){
            if (self::GetSubDomain() == "shop"){
                $defaultSite = "shop";  
            } else {
                $defaultSite = DEFAULT_SITE;
            }
            self::Set($defaultSite);
        }
        return $names[$_SESSION['BXExtra']['SITE']['CODE']];
    }
    public function Check($type){
        $SiteSection = self::Get();
        if ($SiteSection['CODE'] != $type)
            self::Set($type);
            
        return self::Get();
    }
    public function GetSubDomain($link = true){
        $currentUrl = explode(".",$_SERVER['HTTP_HOST']);
        $oldSubdomain = false;
        if (count($currentUrl) > 2){
            $oldSubdomain = array_shift($currentUrl);
        }
        if (count($currentUrl) > 2){//Catch if www in url
            $oldSubdomain = array_shift($currentUrl);
        }
        if ($oldSubdomain == "www") $oldSubdomain = "";
        
        if ($link){
            if (!$oldSubdomain) 
                $oldSubdomain = $_SESSION['BXExtra']['REGION']['IBLOCK']['URL'];
        }
        
        return $oldSubdomain;
    }
    public function Filter(){
        return array(
            "PROPERTY_TYPE" => $_SESSION['BXExtra']['SITE']['ID'],
            "PROPERTY_BRANCH" => $_SESSION['BXExtra']['REGION']['IBLOCK']['ID']
        );
    }
    public function FilterOr(){
        return array(
            array(
                "LOGIC" => "OR",
                self::Filter(),
                array(
                    "PROPERTY_TYPE" => $_SESSION['BXExtra']['SITE']['ID'],
                    "PROPERTY_BRANCH" => false
                )
            )
        );
    }

    public function str_replace_once($search, $replace, $text)
    {
        $pos = strpos($text, $search);
        return $pos!==false ? substr_replace($text, $replace, $pos, strlen($search)) : $text;
    }
}
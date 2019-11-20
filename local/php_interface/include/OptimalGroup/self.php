<?
namespace OptimalGroup;

class Main {
    function isBot(){
	    $bots = array(
	        'rambler','googlebot','ia_archiver', 'Wget', 'WebAlta','MJ12bot', 'aport','yahoo','msnbot', 'mail.ru',
	        'alexa.com', 'Baiduspider', 'Speedy Spider', 'abot', 'Indy Library', 'Page Speed Insights' );

	    foreach($bots as $bot)
	        if(stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== false){
		      return $bot;
	        }
	    return false;
	}
    public static function isAjax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
    }
}

class Core {
    /*
    Для упрощения вызовать обычной страницы с компонентом, т.к. много где выводиться страница из инфоблока
    */
    function SimplePage($params){
        global $APPLICATION;
        $APPLICATION->IncludeFile(
            INCLUDE_PATH . '/text-page.php', 
            $params, 
            array("SHOW_BORDER"=> false)
        );
    }
    /*
    Для переопределения урлов, если самый первый раздел в урле /business/ чтоб не плодить папку /business/
    */
    function GetCurPage(){
        global $APPLICATION;
        $CurPage = $APPLICATION->GetCurPage();
        $arCurPage = explode('/',$CurPage);
        if ($arCurPage[1] == "business"){
            unset($arCurPage[1]);
            $CurPage = implode('/',$arCurPage);
        }
        return $CurPage;
    }
    function YaShare(){
    }
    
    function AddJs($name){
        if (is_array($name))
	       foreach ($name as $src)
               \Bitrix\Main\Page\Asset::getInstance()->addJs(MEDIA_PATH ."js/". $src.".js");    
    }
    function AddCss($name){
        if (is_array($name))
	       foreach ($name as $src)
               \Bitrix\Main\Page\Asset::getInstance()->addCss(MEDIA_PATH ."css/". $src.".css");    
    }
    function GetGroup(){
        return $_SESSION['BXExtra']['REGION']['IBLOCK']['GROUP'];
    }
    //Все надстройки сайта
    function Settings(){
        return array(
            "SITE" => $_SESSION['BXExtra']['SITE'],
            "DOMAIN" => $_SESSION['BXExtra']['REGION']['IBLOCK']['URL'],
            "GROUP" => $_SESSION['BXExtra']['REGION']['IBLOCK']['GROUP'],
            "BRANCH" => $_SESSION['BXExtra']['REGION']['IBLOCK'],
            "PRICE" => $_SESSION['BXExtra']['PRICE'],
        );
    }
    
    static function clearLogFile($fileName = "log.json", $path = "/local/_log/")
    {
        file_put_contents($fileName, '{}');
    }
    static function saveJSON($text, $fileName, $path = "/local/_log/")
    {        
        $filePath = $_SERVER["DOCUMENT_ROOT"].$path.$fileName.'.json';
        $current_json = json_decode(file_get_contents($filePath), true);
        $current_json[date("d.m.Y H:i:s")] = $text;        
        $json = json_encode($current_json, JSON_UNESCAPED_UNICODE);
        $result = file_put_contents($filePath, $json);
    }
    static function getJSON($fileName, $path = "/local/_log/")
    {
        $filePath = $_SERVER["DOCUMENT_ROOT"].$path.$fileName.'.json';
        $data = json_decode(file_get_contents($filePath), true);
        if (count($data) > 0) {
            return $data;
        }
    }
    
}
class Template {
    /*
    2 или 3 баннера на странице, для упрощения вызова компонента
    */
    function OfferBanners($params){
        global $APPLICATION;
        $APPLICATION->IncludeFile(
            INCLUDE_PATH . '/offer-banner.php', 
            $params, 
            array("SHOW_BORDER"=> false)
        );
    }
    const arSections = array(
        "HIDE_TITLE" => array(
            "/news/",
            "/promo/",
            "/water-meter/",
            "/registration/",
            "/password-recovery/"
        ),
        "HIDE_CRUMB" => array(
            "/registration/",
            "/password-recovery/"
        ),
        "FULL_WIDTH" => array(
            "/offices/",
            "/catalog/",
            "/electric-meter/",
            "/electrical-work/",
            "/water-meter/",
            "/services/",
            "/feedback/"
           // "/online-services/individual/pay/"
        ),
        "GREY_BG" => array(
            "/online-services/",
            "/clients/",
            "/about/purchase/information/",
            "/about/quality-of-services/",
            "/partners/",
            "/electric-config/",
            "/water-meter/",
            "/registration/",
            "/password-recovery/",
            "/feedback/",
            "/odpu/",
            "/service/"
        ),
        "SHOW_WHITE_BG" => array(
            "/clients/individuals/power_supply/fees_and_regulations/"
        )
    );
    
    public function ShowFullWidth(){
        $result = false;
        if (in_array(getRealCurDir(),self::arSections['FULL_WIDTH']) || isStartPage()){
            $result = true;
        }
        return $result;
    }
    public function GreyContentBg($nestedTo = false){
        global $APPLICATION;
        $result = false;
        foreach (self::arSections['GREY_BG'] as $bgRule){
            if (strpos(getRealCurDir(),$bgRule)!==false && !in_array(Core::GetCurPage(), self::arSections['SHOW_WHITE_BG']))
                $result = true;
        }
        return $result;
    }
    public function HideCrumb(){
        foreach (self::arSections['HIDE_CRUMB'] as $rule){
            if (strpos(getRealCurDir(),$rule)!==false)
                $result = true;
        }
        return $result;
    }
    public function HideTitle(){
        $result = false;
        foreach (self::arSections['HIDE_TITLE'] as $rule){
            if (strpos(getRealCurDir(),$rule)!==false)
                $result = true;
        }
        return $result;
    }
}
class Url {    
    /*
    Конструктор ссылок для сайта
    */
    public function Make($subDomain, $params, $folder){
        $currentUrl = explode(".",$_SERVER['SERVER_NAME']);
        if (count($currentUrl) > 2){
            $oldSubdomain = array_shift($currentUrl);
        }
        $mainDomain = implode(".", $currentUrl);
        //$protocol = $_SERVER['HTTP_X_FORWARDED_PROTO']?$_SERVER['HTTP_X_FORWARDED_PROTO']:$_SERVER['REQUEST_SCHEME'];
        $protocol = "http";
        if (isset($_SERVER["HTTPS"]) &&  $_SERVER["HTTPS"] == "on") {
            $protocol = "https";
        }
        $url = $protocol.'://'.$subDomain.'.'.$mainDomain.$folder;
        if (is_array($params)){
            $url .= "?".http_build_query($params);
        }
        return $url;
    }
    /*
    Создание ссылки для основной версии сайта, субдомен берется из сессиии (используется в интернет магазине, чтоб попасть на основную версию сайта)
    */
    public function Site($folder,$params){
        $SiteDomain = $_SESSION['BXExtra']['REGION']['IBLOCK']['URL'];
        if ($_SESSION['BXExtra']['REGION']['NO_STORE']['URL']){
            $SiteDomain = $_SESSION['BXExtra']['REGION']['NO_STORE']['URL'];
        }
        return self::Make($SiteDomain,$params,$folder);
    }
    /*
    Создание ссылки для версии сайта "Магазин" находясь в основной версии сайта
    */
    public function Shop($folder,$params){
        $params['from'] = SiteSection::GetSubDomain();
        return self::Make('shop',$params,$folder);
    }
}
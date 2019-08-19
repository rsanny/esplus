<?
$eventManager = \Bitrix\Main\EventManager::getInstance();
if(file_exists(dirname(__FILE__).'/include/OptimalGroup/constants.php'))
	require dirname(__FILE__).'/include/OptimalGroup/constants.php';
if(file_exists(dirname(__FILE__).'/include/OptimalGroup/self.php'))
	require dirname(__FILE__).'/include/OptimalGroup/self.php';        
if(file_exists(dirname(__FILE__).'/include/OptimalGroup/City.php'))
    require dirname(__FILE__).'/include/OptimalGroup/City.php';    
if(file_exists(dirname(__FILE__).'/include/OptimalGroup/EsplusApi.php'))
    require dirname(__FILE__).'/include/OptimalGroup/EsplusApi.php';
if(file_exists(dirname(__FILE__).'/include/OptimalGroup/AtolApi.php'))
	require dirname(__FILE__).'/include/OptimalGroup/AtolApi.php';
if(file_exists(dirname(__FILE__).'/include/OptimalGroup/SiteSection.php'))
	require dirname(__FILE__).'/include/OptimalGroup/SiteSection.php'; 
if(file_exists(dirname(__FILE__).'/include/OptimalGroup/Catalog.php'))
	require dirname(__FILE__).'/include/OptimalGroup/Catalog.php'; 
if(file_exists(dirname(__FILE__).'/include/OptimalGroup/CFormSelect.php'))
	require dirname(__FILE__).'/include/OptimalGroup/CFormSelect.php'; 
if(file_exists(dirname(__FILE__).'/include/OptimalGroup/mail/NewOrder.php'))
	require dirname(__FILE__).'/include/OptimalGroup/mail/NewOrder.php'; 
if(file_exists(dirname(__FILE__).'/include/OptimalGroup/ValidateForm.php'))
	require dirname(__FILE__).'/include/OptimalGroup/ValidateForm.php';     
if(file_exists(dirname(__FILE__).'/include/OptimalGroup/Shop/User/analytics.php'))
   require dirname(__FILE__).'/include/OptimalGroup/Shop/User/analytics.php';

if(file_exists(dirname(__FILE__).'/include/OptimalGroup/Shop/Sale/PaymentStatus.php'))
   require dirname(__FILE__).'/include/OptimalGroup/Shop/Sale/PaymentStatus.php';
   
/**
 * Подключение классов и данных классов
 * пространство имён DorrBitt
 */
if(file_exists(dirname(__FILE__).'/include/DorrBitt/debug.php'))
   require dirname(__FILE__).'/include/DorrBitt/debug.php';

if(file_exists(dirname(__FILE__).'/include/DorrBitt/abvCityParse.php'))
   require dirname(__FILE__).'/include/DorrBitt/abvCityParse.php';

if(file_exists(dirname(__FILE__).'/include/DorrBitt/dbApi.php'))
   require dirname(__FILE__).'/include/DorrBitt/dbApi.php';
   
if(file_exists(dirname(__FILE__).'/include/DorrBitt/catalogPriceType.php'))
   require dirname(__FILE__).'/include/DorrBitt/catalogPriceType.php';

if(file_exists(dirname(__FILE__).'/include/DorrBitt/categoryTovarsShop.php'))
   require dirname(__FILE__).'/include/DorrBitt/categoryTovarsShop.php';

if(file_exists(dirname(__FILE__).'/include/DorrBitt/dbCity.php'))
   require dirname(__FILE__).'/include/DorrBitt/dbCity.php';

//	
//Скрипты для обмена с 1С
//
if(file_exists(dirname(__FILE__).'/include/OptimalGroup/1c_exchange.php'))
	require dirname(__FILE__).'/include/OptimalGroup/1c_exchange.php'; 


AddEventHandler(
     "main", 
     "OnUserLoginExternal", 
     Array("__ESPLUSAuth", "OnUserLoginExternal"), 
     100, 
     $_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/OptimalGroup/AuthEsplus.php'
);
AddEventHandler(
     "main", 
     "OnExternalAuthList", 
     Array("__ESPLUSAuth", "OnExternalAuthList"), 
     100, 
     $_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/OptimalGroup/AuthEsplus.php'
);
$eventManager->addEventHandler("sale", "OnSaleOrderBeforeSaved", "updateBasketItems");
function updateBasketItems(\Bitrix\Main\Event $event){
    $order = $event->getParameter("ENTITY");
    $basket = $order->getBasket();
    $basketItems = $basket->getBasketItems();
    $PropRemove = array(
        "PRICE_OLD",
        "TYPE",
        "WITH_COUNTER",
        "WITH_SERVICE",
        "SERVICE",
        "SECTION",
        "PRODUCT",
        "PICTURE"
    );
    
    foreach ($basket as $basketItem) {
        $basketPropertyCollection = $basketItem->getPropertyCollection();
        $basketPropertyCollection->getPropertyValues();
        foreach ($basketPropertyCollection as $propertyItem) {
            $code = $propertyItem->getField('CODE');
            if (in_array($code, $PropRemove)) {
                $propertyItem->delete();
            }
        }
        $basketPropertyCollection->save();
        $basketItem->save();
    }
}
AddEventHandler("main", "OnBeforeProlog", "RedirectAndSetRegion", 50);

function RedirectAndSetRegion()
{
    global $APPLICATION;
    $OptimalGroupCity = new \OptimalGroup\City;
    $CurrentCity = $OptimalGroupCity->Init($_REQUEST['type']);
    $current = \OptimalGroup\SiteSection::Get();
    $domain = \OptimalGroup\SiteSection::GetSubDomain();
    if ($domain == "shop"){
        if ($current['CODE'] != $domain) {//Если не магазин то устанавливаем магазин
            $_REQUEST['site_section'] = $domain;
        }
            
        if ($_REQUEST['from']){//При переходе с основного получаем его домен, для сохранения в сессию, чтоб знать с какого домена пришли
            $OptimalGroupCity->SetRegionByDomain($_REQUEST['from'], true);
        }
    }
    if ($_REQUEST['site_section'] && $_REQUEST['site_section'] != $current['CODE']){
        \OptimalGroup\SiteSection::Set($_REQUEST['site_section']);
    }
    
    //If domain is root set page
    $checkIndex = \OptimalGroup\SiteSection::GetSubDomain(false);
    if (empty($checkIndex) && !\OptimalGroup\Main::isAjax() && $APPLICATION->GetCurDir() == "/"){
        
        $APPLICATION->RestartBuffer();
        $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/index.php', Array(), Array("SHOW_BORDER"=> false));
        die();
    }
    
}

function getRealCurDir() {
    global $APPLICATION;
    $filePath = $_SERVER["REAL_FILE_PATH"];
    $fileArr = explode("/",$filePath);
    array_pop($fileArr);
    $curDir = $_SERVER["REAL_FILE_PATH"] ? implode("/", $fileArr)."/" : $APPLICATION->GetCurDir();
    return $curDir;    
}
function isStartPage() {
    if((getRealCurDir()=="") or (getRealCurDir()=="/")) return true;
    else return false;
}
//FormatHelper::plural(count($arResult['ITEMS']), array('позиция', 'позиции', 'позиций'))
class FormatHelper
{
    function FileSize($sizeInBytes) {
        $s = array('байт', 'кб', 'Мб', 'Гб', 'Тб', 'Пб');
        $n = floor(log($sizeInBytes, 1024));
        return number_format($sizeInBytes / pow(1024, $n), 1, ',', ' ') . ' ' . $s[$n];
    }
    function dates($dateString) {
        $date = strtotime($dateString);
        $months = array('', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
        return date('d', $date) . '  ' . $months[(int) date('m', $date)] .  ', ' . date('H:i');
    }
    function plural($number, $titles){
        $cases = array (2, 0, 1, 1, 1, 2);
        return $titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ];
    }
    function price($price){
        $price = number_format($price, 0, ',', ' ');
        return $price;
    }
    function jsonOutput($data, $restartBuffer = true){
		if ($restartBuffer === true) {
			global $APPLICATION;
			$APPLICATION->RestartBuffer();
		}
		header('Content-Type: application/json');
		echo json_encode($data);
		exit();
    }
	function Error($text,$word){
		$textString = $text;
		if ($word) $textString = 'Поле "'.$text.'" является обязательным для заполнения!<br>';
		return '<div class="bg-danger bg-message mb-20">'.$textString.'</div>';
	}
	function Success($text){
		if (empty($text)) $text = "Спасибо! Ваша заявка принята!";
		return '<div class="bg-success bg-message mb-20">'.$text.'</div>';
	}
    function FileType($type){
        $fileType = "pdf";
        if (strpos($type,"word") !== false)
            $fileType = "doc";
        if (strpos($type,"spreadsheetml") !== false || strpos($type,"excel") !== false)
            $fileType = "exl";
        if (strpos($type,"image") !== false)
            $fileType = "img";
        if (strpos($type,"zip") !== false)
            $fileType = "zip";
        if (strpos($type,"rar") !== false)
            $fileType = "zip";
        
        return $fileType;
    }
}
function pr($item, $show_for = false) {
	global $USER;
	if ($USER->GetID() == 1 || $show_for == 'all' || $_GET['print_r']) {	
    $bt = debug_backtrace();
    $bt = $bt[0];
    $dRoot = $_SERVER["DOCUMENT_ROOT"];
    $dRoot = str_replace("/", "\\", $dRoot);
    $bt["file"] = str_replace($dRoot, "", $bt["file"]);
    $dRoot = str_replace("\\", "/", $dRoot);
    $bt["file"] = str_replace($dRoot, "", $bt["file"]);
    echo "<div style=\"padding: 3px 5px; background:#99CCFF; font-weight: bold;\">File:".$bt['file']." [".$bt['line']."] </div>";
		if (!$item) echo ' <br />пусто <br />';
		elseif (is_array($item) && empty($item)) echo '<br />массив пуст <br />';
		else echo ' <pre>' . print_r($item, true) . ' </pre>';
	}
}
AddEventHandler('form', 'onAfterResultAdd', 'my_onAfterResultAddUpdate');
//AddEventHandler('form', 'onAfterResultUpdate', 'my_onAfterResultAddUpdate');

function my_onAfterResultAddUpdate($WEB_FORM_ID, $RESULT_ID)
{


    //echo $RESULT_ID;
    //die();
    $arVALUE = array();
    // символьный идентификатор вопроса
    if($WEB_FORM_ID==27)
    {
        $FIELD_SID = "SIMPLE_QUESTION_234";
        $ANSWER_ID_ARRAY = array(614,748,749,750,751,752);
    }
    else if($WEB_FORM_ID==8)
    {

        $FIELD_SID = "SIMPLE_QUESTION_259";
        $ANSWER_ID_ARRAY = array(230,821,822,823,824,862);
    }
    else if($WEB_FORM_ID==24)
    {
        $FIELD_SID = "SIMPLE_QUESTION_121";
        $ANSWER_ID_ARRAY = array(582,734,735,736,737,738);
    }
    else if($WEB_FORM_ID==33)
    {
        $FIELD_SID = "SIMPLE_QUESTION_121";
        $ANSWER_ID_ARRAY = array(788,789,790,791,792,793);
    }
    else if($WEB_FORM_ID==28)
    {
        $FIELD_SID = "SIMPLE_QUESTION_126";
        $ANSWER_ID_ARRAY = array(630,866,867,868,869,870);
    }

    // ID полей ответа
    //$path = $_SERVER["DOCUMENT_ROOT"]."/images/news.gif"; // путь к файлу
    $arrLoadImg=explode(",",$_COOKIE["imageIdLoad"]);
    foreach($arrLoadImg as $key=>$arrIdImage):
        $arVALUE[$ANSWER_ID_ARRAY[$key]] = CFile::MakeFileArray(CFile::GetPath($arrIdImage));
    endforeach;

    CFormResult::SetField($RESULT_ID, $FIELD_SID, $arVALUE);

    if (file_exists('/var/www/esplus/data/www/esplus.extyl.pro/uploads/')) {
        foreach (glob('/var/www/esplus/data/www/esplus.extyl.pro/uploads/*') as $file) {
            unlink($file);
        }
    }
    unset($_COOKIE['imageIdLoad']);
    setcookie ("imageIdLoad", " ",  time() - 3600,"/");
}

function spr($arr)
{
    echo "<pre>" . print_r($arr,1) . "</pre>";
}
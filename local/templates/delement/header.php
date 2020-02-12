<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
unset($GLOBALS["strError"]);

if(!$_COOKIE['BITRIX_SM_REGION'] && !$_COOKIE['region']) {
    if(empty($_GET)) {
        if(empty($_SESSION['domain']) || $_SESSION['domain'] == null) {
            LocalRedirect('?from=ekb');
        }
        else {
            LocalRedirect('?from='.$_SESSION['domain']);
        }
    }
    else if(empty($_GET['region']) && empty($_GET['from'])) {
        if(empty($_SESSION['domain']) || $_SESSION['domain'] == null) {
            $url = array_merge($_GET,array('from' => 'ekb'));
            LocalRedirect('?'.http_build_query($url));
        }
        else {
            $url = array_merge($_GET,array('from' => $_SESSION['domain']));
            LocalRedirect('?'.http_build_query($url));
        }
    }
    else {
        //если надо from в начало строки
        /*
        $url = array_merge(array('from' => 'samara'),$_GET);
        $url = urldecode(htmlentities(http_build_query($url)));
        */
        if(!empty($_GET['region']) && empty($_GET['from'])) {
            switch ($_GET['region']) {
                case 51:
                    $url = array_merge($_GET,array('from' => 'samara'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11131:
                    $url = array_merge($_GET,array('from' => 'samara'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 240:
                    $url = array_merge($_GET,array('from' => 'samara'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11139:
                    $url = array_merge($_GET,array('from' => 'samara'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11148:
                    $url = array_merge($_GET,array('from' => 'udm'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 44:
                    $url = array_merge($_GET,array('from' => 'udm'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11084:
                    $url = array_merge($_GET,array('from' => 'oren'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 48:
                    $url = array_merge($_GET,array('from' => 'oren'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 972:
                    $url = array_merge($_GET,array('from' => 'oren'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11070:
                    $url = array_merge($_GET,array('from' => 'kirov'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 46:
                    $url = array_merge($_GET,array('from' => 'kirov'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 10658:
                    $url = array_merge($_GET,array('from' => 'vladimir'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 192:
                    $url = array_merge($_GET,array('from' => 'vladimir'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 10656:
                    $url = array_merge($_GET,array('from' => 'vladimir'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 10661:
                    $url = array_merge($_GET,array('from' => 'vladimir'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 10668:
                    $url = array_merge($_GET,array('from' => 'vladimir'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11077:
                    $url = array_merge($_GET,array('from' => 'chuvashia'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 41:
                    $url = array_merge($_GET,array('from' => 'chuvashia'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11156:
                    $url = array_merge($_GET,array('from' => 'chuvashia'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 45:
                    $url = array_merge($_GET,array('from' => 'chuvashia'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11117:
                    $url = array_merge($_GET,array('from' => 'mordovia'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 42:
                    $url = array_merge($_GET,array('from' => 'mordovia'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11079:
                    $url = array_merge($_GET,array('from' => 'novgorod'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 47:
                    $url = array_merge($_GET,array('from' => 'novgorod'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11083:
                    $url = array_merge($_GET,array('from' => 'novgorod'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11095:
                    $url = array_merge($_GET,array('from' => 'penza'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 49:
                    $url = array_merge($_GET,array('from' => 'penza'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11108:
                    $url = array_merge($_GET,array('from' => 'perm'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 50:
                    $url = array_merge($_GET,array('from' => 'perm'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11146:
                    $url = array_merge($_GET,array('from' => 'saratov'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 194:
                    $url = array_merge($_GET,array('from' => 'saratov'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11132:
                    $url = array_merge($_GET,array('from' => 'saratov'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11143:
                    $url = array_merge($_GET,array('from' => 'saratov'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11153:
                    $url = array_merge($_GET,array('from' => 'ulianovsk'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 195:
                    $url = array_merge($_GET,array('from' => 'ulianovsk'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 10687:
                    $url = array_merge($_GET,array('from' => 'ivanovo'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 5:
                    $url = array_merge($_GET,array('from' => 'ivanovo'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 10939:
                    $url = array_merge($_GET,array('from' => 'komi'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 19:
                    $url = array_merge($_GET,array('from' => 'komi'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                default:
                    $url = array_merge($_GET,array('from' => $_SESSION['domain']));
                    LocalRedirect('?'.http_build_query($url));
            }
        }
        else if(!empty($_GET['from'])) {
            if(\CModule::includeModule('iblock')) {
                $res_region = \CIBlockElement::GetList(array(), array("IBLOCK_ID"=> 6, "PROPERTY_URL" => $_GET['from']), false, false, array("IBLOCK_ID", "ID", "PROPERTY_URL", "PROPERTY_REGION"))->Fetch();
                if(!empty($res_region['PROPERTY_URL_VALUE'])) {
                    setcookie("region", $res_region['PROPERTY_URL_VALUE'], time()+60*60*24*60);
                    $url = array_merge($_GET,array('from' => $res_region['PROPERTY_URL_VALUE']));
                    LocalRedirect('?'.http_build_query($url));
                }
                else {
                    if(empty($_SESSION['domain']) || $_SESSION['domain'] == null) {
                        $url = array_merge($_GET,array('from' => 'ekb'));
                        setcookie("region", 'ekb', time()+60*60*24*60);
                        LocalRedirect('?'.http_build_query($url));
                    }
                    else {
                        $url = array_merge($_GET,array('from' => $_SESSION['domain']));
                        setcookie("region", 'ekb', time()+60*60*24*60);
                        LocalRedirect('?'.http_build_query($url));
                    }
                }
            }
        }
    }
}
else {
    if(empty($_GET)){
//        if(!empty($_COOKIE['BITRIX_SM_REGION'])) {
//            $url = array_merge($_GET,array('from' => $_COOKIE['BITRIX_SM_REGION']));
//            LocalRedirect('?'.http_build_query($url));
//        }
        if(!empty($_COOKIE['region'])) {
            $url = array_merge($_GET,array('from' => $_COOKIE['region']));
            LocalRedirect('?'.http_build_query($url));
        }
        else {
            if(empty($_SESSION['domain']) || $_SESSION['domain'] == null) {
                $url = array_merge($_GET,array('from' => 'ekb'));
                LocalRedirect('?'.http_build_query($url));
            }
            else {
                $url = array_merge($_GET,array('from' => $_SESSION['domain']));
                LocalRedirect('?'.http_build_query($url));
            }
        }
    }
    else if(empty($_GET['region']) && empty($_GET['from'])) {
        if(!empty($_COOKIE['region'])) {
            $url = array_merge($_GET,array('from' => $_COOKIE['region']));
            LocalRedirect('?'.http_build_query($url));
        }
        else {
            if(empty($_SESSION['domain']) || $_SESSION['domain'] == null) {
                $url = array_merge($_GET,array('from' => 'ekb'));
                LocalRedirect('?'.http_build_query($url));
            }
            else {
                $url = array_merge($_GET,array('from' => $_SESSION['domain']));
                LocalRedirect('?'.http_build_query($url));
            }
        }
    }
    else {
        if(!empty($_GET['region']) && empty($_GET['from'])) {
            switch ($_GET['region']) {
                case 51:
                    $url = array_merge($_GET,array('from' => 'samara'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11131:
                    $url = array_merge($_GET,array('from' => 'samara'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 240:
                    $url = array_merge($_GET,array('from' => 'samara'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11139:
                    $url = array_merge($_GET,array('from' => 'samara'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11148:
                    $url = array_merge($_GET,array('from' => 'udm'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 44:
                    $url = array_merge($_GET,array('from' => 'udm'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11084:
                    $url = array_merge($_GET,array('from' => 'oren'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 48:
                    $url = array_merge($_GET,array('from' => 'oren'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 972:
                    $url = array_merge($_GET,array('from' => 'oren'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11070:
                    $url = array_merge($_GET,array('from' => 'kirov'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 46:
                    $url = array_merge($_GET,array('from' => 'kirov'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 10658:
                    $url = array_merge($_GET,array('from' => 'vladimir'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 192:
                    $url = array_merge($_GET,array('from' => 'vladimir'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 10656:
                    $url = array_merge($_GET,array('from' => 'vladimir'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 10661:
                    $url = array_merge($_GET,array('from' => 'vladimir'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 10668:
                    $url = array_merge($_GET,array('from' => 'vladimir'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11077:
                    $url = array_merge($_GET,array('from' => 'chuvashia'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 41:
                    $url = array_merge($_GET,array('from' => 'chuvashia'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11156:
                    $url = array_merge($_GET,array('from' => 'chuvashia'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 45:
                    $url = array_merge($_GET,array('from' => 'chuvashia'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11117:
                    $url = array_merge($_GET,array('from' => 'mordovia'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 42:
                    $url = array_merge($_GET,array('from' => 'mordovia'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11079:
                    $url = array_merge($_GET,array('from' => 'novgorod'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 47:
                    $url = array_merge($_GET,array('from' => 'novgorod'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11083:
                    $url = array_merge($_GET,array('from' => 'novgorod'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11095:
                    $url = array_merge($_GET,array('from' => 'penza'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 49:
                    $url = array_merge($_GET,array('from' => 'penza'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11108:
                    $url = array_merge($_GET,array('from' => 'perm'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 50:
                    $url = array_merge($_GET,array('from' => 'perm'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11146:
                    $url = array_merge($_GET,array('from' => 'saratov'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 194:
                    $url = array_merge($_GET,array('from' => 'saratov'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11132:
                    $url = array_merge($_GET,array('from' => 'saratov'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11143:
                    $url = array_merge($_GET,array('from' => 'saratov'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 11153:
                    $url = array_merge($_GET,array('from' => 'ulianovsk'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 195:
                    $url = array_merge($_GET,array('from' => 'ulianovsk'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 10687:
                    $url = array_merge($_GET,array('from' => 'ivanovo'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 5:
                    $url = array_merge($_GET,array('from' => 'ivanovo'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 10939:
                    $url = array_merge($_GET,array('from' => 'komi'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                case 19:
                    $url = array_merge($_GET,array('from' => 'komi'));
                    LocalRedirect('?'.http_build_query($url));
                    break;
                default:
                    $url = array_merge($_GET,array('from' => $_SESSION['domain']));
                    LocalRedirect('?'.http_build_query($url));
            }
        }
        else if(!empty($_GET['from'])) {
            if(\CModule::includeModule('iblock')) {
                $res_region = \CIBlockElement::GetList(array(), array("IBLOCK_ID"=> 6, "PROPERTY_URL" => $_GET['from']), false, false, array("IBLOCK_ID", "ID", "PROPERTY_URL", "PROPERTY_REGION"))->Fetch();
                if(!empty($res_region['PROPERTY_URL_VALUE'])) {
                    setcookie("region", $res_region['PROPERTY_URL_VALUE'], time()+60*60*24*60);
                    $url = array_merge($_GET,array('from' => $res_region['PROPERTY_URL_VALUE']));
                    //LocalRedirect('?'.http_build_query($url));
                }
                else {
                    if(empty($_SESSION['domain']) || $_SESSION['domain'] == null) {
                        $url = array_merge($_GET,array('from' => 'ekb'));
                        LocalRedirect('?'.http_build_query($url));
                    }
                    else {
                        $url = array_merge($_GET,array('from' => $_SESSION['domain']));
                        LocalRedirect('?'.http_build_query($url));
                    }
                }
            }
        }
    }
}
?>
<?
IncludeTemplateLangFile(__FILE__);

use \Bitrix\Main\Page\Asset,
    \OptimalGroup\Template,
    \OptimalGroup\Core,
    \OptimalGroup\SiteSection;
use DorrBitt\dbCity\DBCITY;
use  DorrBitt\dbapi\DGAPI;
use DorrBitt\ClassDebug\ClassDebug;
//print DGAPI::ses(); ea0a365e9ddd592fc640570cafeaf218
$dev = DGAPI::dev("ea0a365e9ddd592fc640570cafeaf218");
$resultDostuSc = DBCITY::resultDostup(0,"27 july 2019 20:00");
//print $resultDostuSc;
$OptimalGroup = Core::Settings();
// если не определена группа текущего региона
$OptimalGroup['GROUP'] = (empty($OptimalGroup['GROUP'])) ? 'all' : $OptimalGroup['GROUP'];
$OptimalGroup['SITE']['CODE'] = (empty($OptimalGroup['SITE']['CODE'])) ? 'home' : $OptimalGroup['SITE']['CODE'];

if($dev == 1){
    //ClassDebug::debug($OptimalGroup);
}
$IncludePath = INCLUDE_PATH . 'site/'.$OptimalGroup['SITE']['CODE'];
$ClientSection = "/clients/";
if ($OptimalGroup['SITE']['CODE'] == "business")
    $ClientSection = "/".$OptimalGroup['SITE']['CODE'].$ClientSection;

$arCssFiles = array(
    'landing/lib/grid',
    'landing/reset',
    'landing/base',
    'landing/style',
    'landing/responsive',
    "landing/style-form-mail",
);
$arCssForJs = array(
    'landing/js/lib/slick/slick.css',
    'landing/js/lib/chosen/chosen.css',
    'landing/js/lib/FontAwesome/font-awesome.css'
);
$arJsFiles = array(
    'landing/library',
    'landing/lib/jquery.matchHeight',
    'landing/lib/jquery.inputmask',
    'landing/lib/imask',
    'landing/lib/slick/slick.min',
    'landing/lib/jquery.md5',
    'landing/lib/chosen/chosen.jquery.min',
    'landing/lib/jquery.imagesloaded.min',
    'landing/optimalgroup',
    'landing/material',
    'landing/script',
    'landing/optimalgroup/form',
    'landing/optimalgroup/analytics',
);
if ($OptimalGroup['SITE']['CODE'] != "shop"){
    $arJsFiles[] = 'optimalgroup/mobile.menu';
}

Asset::getInstance()->addCss("//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&amp;subset=cyrillic");
Asset::getInstance()->addCss("//fonts.googleapis.com/css?family=Source+Sans+Pro&amp;subset=cyrillic");
foreach ($arCssForJs as $src)
    Asset::getInstance()->addCss(MEDIA_PATH . $src);
Core::AddCss($arCssFiles);
Core::AddJs($arJsFiles);

Asset::getInstance()->addJs(MEDIA_PATH."js/script_site.js");

CJSCore::Init(
    array(
        'ajax',
        'window',
        'fx'
    )
);
$cityListUrl = AJAX_PATH.'city-list.php';
if ($_SESSION['BXExtra']['SITE']['CODE'] == "shop"){
    $cityListUrl .= "?list=shop";
}

$promo = 'Y';

?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>" >
	<head>
		<script>
            var INLINE_SVG_REVISION = <?= filemtime($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . '/frontend/assets/icons.svg') ?>;
            var SITE_TEMPLATE_PATH = "<?= SITE_TEMPLATE_PATH ?>";
            var SITE_LANG = "<?= LANGUAGE_ID ?>";
		</script>
		<? $APPLICATION->ShowHead(); ?>
		<?
		//CSS
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/frontend/assets/main.css");

		//JS
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/frontend/assets/bundle.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/frontend/assets/custom.js");
        $APPLICATION->SetTitle($_SESSION['BXExtra']['REGION']['IBLOCK']['NAME'].' филиал');
		?>
		<title>Акция ЭнергосбыТ Плюс</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap&subset=cyrillic" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&display=swap&subset=cyrillic" rel="stylesheet">
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
        <meta name="description" content="АО &laquo;ЭнергосбыТ Плюс&raquo; – объединенная энергосбытовая компания Группы &laquo;Т Плюс&laquo; с филиальной сетью из 13 региональных филиалов на территории Российской Федерации." >
        <meta property="og:site_name" content="Акции ЭнергосбыТ Плюс" />
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112818786-17"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-112818786-17');
        </script>

	</head>
	<body>
        <div class="flow-container ">
            <main class="content">
	            <?= $APPLICATION->ShowPanel(); ?>
                <?if(!$_COOKIE['BITRIX_SM_REGION']  && !$_COOKIE["popup"]) {?>
                    <?$APPLICATION->IncludeFile(INCLUDE_PATH."/template/current-city-promo.php",array(),array("SHOW_BORDER"=>false));?>
                <? } ?>

                <section id="intro" class="section section--intro">
                    <div class="intro">
                        <header class="section__title container">
                            <div class="intro__head">
                                <div class="intro__head-logo">
                                    <div class="logo">
	                                        <?$APPLICATION->IncludeComponent(
		                                        'bitrix:main.include',
		                                        '',
		                                        array(
			                                        'AREA_FILE_SHOW' => 'file',
			                                        'PATH' => SITE_TEMPLATE_PATH . "/include/logo.php",
			                                        'COMPOSITE_FRAME_TYPE' => 'AUTO',
			                                        'COMPONENT_TEMPLATE' => '.default',
			                                        'COMPOSITE_FRAME_MODE' => 'A',
                                                    'DOMAIN' => $OptimalGroup['DOMAIN'],
		                                        ),
		                                        false
	                                        );?>
                                    </div>
                                </div>
                                <div class="intro__head-contacts">
                                    <div class="phones">
                                        <div class="phones__main">
                                            <?if(!empty($OptimalGroup['BRANCH']['PHONE_LANDING'])) {?>
                                                <?=$OptimalGroup['BRANCH']['PHONE_LANDING']?>
                                            <?} else {?>
                                            <?=$OptimalGroup['BRANCH']['PHONE']?>
                                            <? } ?>
                                        </div>
                                    </div>
                                    <div class="header-city">
                                        <a href="#" class="js-popUp" data-fancybox-type="ajax" data-fancybox-href="/local/include/ajax/city-list-promo.php">
                                            <span><?=$_SESSION['BXExtra']['REGION']['IBLOCK']['NAME'];?> филиал</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <div class="section__promo">
                            <div class="container">
                                <div class="section__promo-content">
                                        <div class="intro__main">
                                        <h1 class="section__promo-title"><?$APPLICATION->IncludeComponent(
                                                'bitrix:main.include',
                                                '',
                                                array(
                                                    'AREA_FILE_SHOW' => 'file',
                                                    'PATH' => SITE_TEMPLATE_PATH . "/include/h1.php",
                                                    'COMPOSITE_FRAME_TYPE' => 'AUTO',
                                                    'COMPONENT_TEMPLATE' => '.default',
                                                    'COMPOSITE_FRAME_MODE' => 'A',
                                                ),
                                                false
                                            );?></h1>
                                        <?$APPLICATION->IncludeComponent(
                                                'bitrix:main.include',
                                                '',
                                                array(
                                                    'AREA_FILE_SHOW' => 'file',
                                                    'PATH' => SITE_TEMPLATE_PATH . "/include/h1_desc.php",
                                                    'COMPOSITE_FRAME_TYPE' => 'AUTO',
                                                    'COMPONENT_TEMPLATE' => '.default',
                                                    'COMPOSITE_FRAME_MODE' => 'A',
                                                ),
                                                false
                                            );?>
                                            <a href="#popup-form-send" class="btn btn-orange w-170 popup-modal" data-js-btn>Участвовать</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
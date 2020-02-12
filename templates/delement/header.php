<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
unset($GLOBALS["strError"]);
if(empty($_GET)){
    LocalRedirect('?from=ekb');
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
		?>
		<title><? $APPLICATION->ShowTitle() ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap&subset=cyrillic" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&display=swap&subset=cyrillic" rel="stylesheet">
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	</head>
	<body>
        <div class="flow-container ">
            <main class="content">
	            <?= $APPLICATION->ShowPanel(); ?>
                <section id="intro" class="section section--intro">
                    <div class="intro">
                        <header class="section__title container">
                            <div class="intro__head">
                                <div class="intro__head-logo">
                                    <div class="logo">
                                        <a href="http://promo.esplus-test.2204535.ru/" class="logo__link">
	                                        <?$APPLICATION->IncludeComponent(
		                                        'bitrix:main.include',
		                                        '',
		                                        array(
			                                        'AREA_FILE_SHOW' => 'file',
			                                        'PATH' => SITE_TEMPLATE_PATH . "/include/logo.php",
			                                        'COMPOSITE_FRAME_TYPE' => 'AUTO',
			                                        'COMPONENT_TEMPLATE' => '.default',
			                                        'COMPOSITE_FRAME_MODE' => 'A',
		                                        ),
		                                        false
	                                        );?>
                                        </a>
                                    </div>
                                </div>
                                <div class="intro__head-contacts">
                                    <div class="phones">
                                        <div class="phones__main">
                                            <?=$OptimalGroup['BRANCH']['PHONE']?>
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
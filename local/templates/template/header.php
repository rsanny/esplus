<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);

use \Bitrix\Main\Page\Asset,
    \OptimalGroup\Template,
    \OptimalGroup\Core,
    \OptimalGroup\SiteSection;
use DorrBitt\dbCity\DBCITY;
$resultDostuSc = DBCITY::resultDostup(0,"27 july 2019 20:00");
//print $resultDostuSc;
$OptimalGroup = Core::Settings();
$IncludePath = INCLUDE_PATH . 'site/'.$OptimalGroup['SITE']['CODE'];
$ClientSection = "/clients/";
if ($OptimalGroup['SITE']['CODE'] == "business")
    $ClientSection = "/".$OptimalGroup['SITE']['CODE'].$ClientSection;

//pr($OptimalGroup);
$arCssFiles = array(
	'lib/grid',
    'reset',
    'base',
    'style',
    'responsive',
    "style-form-mail",
);
$arCssForJs = array(
    'js/lib/slick/slick.css',
    'js/lib/chosen/chosen.css',
    'js/lib/FontAwesome/font-awesome.css'
);
$arJsFiles = array(
	'library',
    'lib/jquery.matchHeight',
    'lib/jquery.inputmask',
    'lib/slick/slick.min',
    'lib/jquery.md5',
    'lib/chosen/chosen.jquery.min',
    'lib/jquery.imagesloaded.min',
    'optimalgroup',
    'material',
    'script',
    'optimalgroup/form',
    'optimalgroup/analytics',
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

CJSCore::Init(
    array(
        'ajax',
        'window',
        'fx'
    )
);
?>
<!DOCTYPE HTML>
<html class="no-js<? if (!$_SESSION['BXExtra']['REGION']['AGREED']):?> fancybox-lock<? endif;?>" lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
		<? if ($OptimalGroup['BRANCH']['YA_WEB_CODE']):?><meta name="yandex-verification" content="<?=$OptimalGroup['BRANCH']['YA_WEB_CODE'];?>">
        <? endif;?><? if ($OptimalGroup['BRANCH']['GG_WEB_CODE']):?><meta name="google-site-verification" content="<?=$OptimalGroup['BRANCH']['GG_WEB_CODE'];?>">
        <? endif;?><title><?$APPLICATION->ShowTitle()?></title>
        <link rel="shortcut icon" href="<?=MEDIA_PATH;?>favicon.ico" />
        <link href="<?=MEDIA_PATH;?>favicon.ico" rel="icon" type="image/x-icon" />

        <?php if($resultDostuSc == 1):?>
        <link href="/local/media/css/style-pop.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="/local/media/js/script_site.js" ></script>
        <?php endif;?>

        <? $APPLICATION->ShowHead(); ?>
		<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
			"AREA_FILE_SHOW" => "sect",
			"AREA_FILE_SUFFIX" => "header_analytics",
			"AREA_FILE_RECURSIVE" => "Y",
			"EDIT_TEMPLATE" => ""
			),
			false
		);?>
        <script data-skip-moving="true">
            window.dataLayer = window.dataLayer || [];
        </script>
        <? if ($OptimalGroup['BRANCH']['GTM_COUNTER']):?>
        <!-- Google Tag Manager -->
        <script data-skip-moving="true">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','<?=$OptimalGroup['BRANCH']['GTM_COUNTER'];?>');</script>
        <!-- End Google Tag Manager --><? endif;?>
        <?
        /*
        1. FOR WHAT WHAT HEAVY PLUGIN IN ALL PAGES! MOVE IT TO PAGE WHERE IT USED
        2. USE BITRIX API TO ICLUDE STYLES AND JS
        */
        ?>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	</head>
	<body>
    <?php if($resultDostuSc == 1):?>
    <div id="modals" ><div id="loader" ></div></div>
    <div id="mw_overlay"></div>

    <div class="foot-data-re-blok" id="foot-data-re" onclick="footDataRe()"  >
    <div class="foot-data-re" ></div>
    <div class="foot-data-re-2" id="foot-data-re-2"  ><mark></mark>Временно не доступны <span>онлайн-сервисы</span></div>
    </div>
    <?php endif;?>

        <? if ($OptimalGroup['BRANCH']['GTM_COUNTER']):?>
	    <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?=$OptimalGroup['BRANCH']['GTM_COUNTER'];?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <? endif;?>
		<div id="panel"><?$APPLICATION->ShowPanel();?></div>
        <div class="page">
            <? if ($OptimalGroup['DOMAIN'] == "oren"):?>
            <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/fixed-btn.php', Array(), Array("SHOW_BORDER"=> false));?>
            <? endif;?>
            <? $APPLICATION->ShowViewContent('section_top_banner'); //catalog/include/banner.php?>
            <?
            if (!$_SESSION['BXExtra']['REGION']['AGREED']){
                $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/current-city.php', Array(), Array("SHOW_BORDER"=> false));
            }?>
            <header class="top">
                <div class="header-top">
                    <div class="container">
                        <div class="row">
                            <div class="col col-4 hidden-lg-up header-mobile--links text-left no-padding">
                                <a href="#" class="mobile-menu--link js-MobileMenuToggle"><i><b></b></i></a>
                                <? if ($OptimalGroup['DOMAIN'] == "oren"):?>
                                <a href="#" class="mobile-header--link js-popUpData" data-fancybox-href="<?=AJAX_PATH;?>form/callback.php"><img src="<?=MEDIA_PATH;?>icons/icon-callback.png" alt=""></a>
                                <a href="#" class="mobile-header--link" rel="webim"><img src="<?=MEDIA_PATH;?>icons/icon-chat.png" alt=""></a>
                                <? endif;?>
                            </div>
                            <div class="col col-3 col-md-4 col-lg-5 hidden-md-down">
                            <? if ($OptimalGroup['GROUP'] != "hide_all"):?>
                                <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/site-type.php', Array(), Array("SHOW_BORDER"=> false));?>
                            <? else:?>
                                <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/site-type--static.php', Array(), Array("MODE"=> "html"));?>
                            <? endif;?>
                            </div>
                            <div class="col col-8 col-lg-7 text-right header-top--links">
                                <div class="header-city">
                                    <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/site-branch.php', Array(), Array("SHOW_BORDER"=> false));?>
                                </div>
                                <? if ($OptimalGroup['GROUP'] != "hide_all"):?>
                                <div class="header-address hidden-sm-down"><a href="/offices/" class="ink-reaction header-top--link js-ToMobileMenu">Офисы</a></div>
                                <div class="header-support hidden-md-down"><a href="<?=$ClientSection;?>" class="ink-reaction header-top--link js-ToMobileMenu">Помощь и поддержка</a></div>
                                <? endif;?>
                                <div class="header-search hidden-md-down" data-hover="search">
                                    <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/header-search.php', Array(), Array("MODE"=> "html"));?>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--/header top-->
                </div>
                <div class="header-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col col-5 col-md-8 col-lg-2"><a href="/" class="logo"><img src="<?=MEDIA_PATH;?>images/logo.png" alt="" class="img-responsive"></a></div>
                            <? if ($OptimalGroup['GROUP'] != "hide_all"):?>
                            <? require($_SERVER["DOCUMENT_ROOT"].$IncludePath.'/header/menu.php');?>
                            <? else:?>
                            <? require($_SERVER["DOCUMENT_ROOT"].$IncludePath.'/header/menu-hide_all.php');?>
                            <? endif;?>
                        </div>
                    </div>

                    <div class="header-menu--mobile none">
                        <a href="#" class="header-menu--mobile__close js-MobileMenuToggle"><b></b></a>
                        <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/site-type.php', array(), Array("MODE"=> "html"));?>

                        <menu class="mobile-menu no-list">
                            <?
                            if ($OptimalGroup['SITE']['CODE'] == "shop"){
                                require($_SERVER["DOCUMENT_ROOT"].$IncludePath.'/header/mobile-menu.php');
                            }
                            ?>
                        </menu>
                        <form class="mobile-search">
                            <button><i class="fa fa-search"></i></button>
                            <input type="search" class="form-control" value="" placeholder="Поиск по сайту">
                        </form>
                    </div>
                <!--/header bottom-->
                </div>
            </header>
            <? $APPLICATION->IncludeFile(INCLUDE_PATH.'/page/banner.php', Array(), Array("SHOW_BORDER"=> false));?>
            <?
            $HideTitleDir = $APPLICATION->GetProperty("hide-h1");
            $HideBreadDir = $APPLICATION->GetProperty("hide-breadcrumb");
            $FullWidthDir = $APPLICATION->GetProperty("full-width");
            if (ERROR_404 == "Y"){
                $FullWidthDir = "Y";
            }
            if (!Template::ShowFullWidth() && !$FullWidthDir):
            ?>
            <main class="content<? if (Template::GreyContentBg()):?> bg-grey<? endif;?>">
                <div class="container">
                    <? if (!Template::HideCrumb() && $HideBreadDir != "Y"):?>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        "",
                        Array(
                            "PATH" => Core::GetCurPage(),
                            "SITE_ID" => "s1",
                            "START_FROM" => "0"
                        )
                    );?>
                    <? else:?>
                    <div class="mt-20"></div>
                    <? endif;?>
                    <? if (!Template::HideTitle() && $HideTitleDir != "Y"):?>
                    <h1>

                        <?=$APPLICATION->ShowTitle(false);?>
                    </h1>
                    <? endif;?>
            <? endif;?>
<!DOCTYPE HTML>
<!--[if IE 7 ]> <html id="ie7" class="no-js"> <![endif]-->
<!--[if IE 8 ]> <html id="ie8" class="no-js"> <![endif]-->
<!--[if IE 9 ]> <html id="ie9" class="no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?$APPLICATION->ShowTitle()?></title>
<?$APPLICATION->ShowMeta("keywords")?>
<?$APPLICATION->ShowMeta("description")?>
<?=$APPLICATION->ShowHeadStrings();?>
<script src="/bitrix/media/js/jquery-1.8.2.min.js"></script>
<script src="/bitrix/media/js/jquery.carouFredSel-6.1.0-packed.js"></script>
<script src="/bitrix/media/js/jquery.mousewheel.min.js"></script>
<script src="/bitrix/media/js/jquery.touchSwipe.min.js"></script>
<script src="/bitrix/media/js/jquery.ba-throttle-debounce.min.js"></script>
<script src="/bitrix/media/js/jquery.fancybox.pack.js"></script>
<script src="/bitrix/media/js/jquery.customSelect.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link href="/bitrix/media/css/jquery.fancybox.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="/favicon.ico" />
<link href="/favicon.ico" rel="icon" type="image/x-icon" />
<link href="/bitrix/media/css/base.css" rel="stylesheet" type="text/css">
<link href="/bitrix/media/css/style.css" rel="stylesheet" type="text/css">
<!--[if IE]>
<script src="/bitrix/media/js/html5.js"></script>
<link href="/bitrix/media/css/base-ie.css" rel="stylesheet" type="text/css" >
<script src="/bitrix/media/js/PIE.js"></script>
<![endif]-->

<!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
<?=$APPLICATION->ShowHeadScripts();?>
<?=$APPLICATION->ShowCSS();?>
<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "header_analytics",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => ""
	),
	false
);?>
</head>
<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div class="page">
	<header>
		<div class="width-content clearfix">
			<div class="logo left">
			<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "sect",
						"AREA_FILE_SUFFIX" => "logo",
						"AREA_FILE_RECURSIVE" => "Y",
						"EDIT_TEMPLATE" => ""
						),
						false
					);?>
			</div>
			<div class="left menu-content">
				<div class="phone right"><span>(495)</span>    663-22-64</div>
				<div class="clear"></div>
				<menu class="no-list left-list">
					<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "sect",
						"AREA_FILE_SUFFIX" => "top_menu",
						"AREA_FILE_RECURSIVE" => "Y",
						"EDIT_TEMPLATE" => ""
						),
						false
					);?>
				</menu>
			</div>
		</div>
	</header>
	
			
	
	<div class="copyr width-content"><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "sect",
						"AREA_FILE_SUFFIX" => "copyr",
						"AREA_FILE_RECURSIVE" => "Y",
						"EDIT_TEMPLATE" => ""
						),
						false
					);?></div>
</div>
<script type="text/javascript" src="/bitrix/media/js/script.js"></script>
<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "counters",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => ""
	),
	false
);?>
</body>
</html>

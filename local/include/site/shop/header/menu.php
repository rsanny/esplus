<?
global $OptimalGroup;
?>
<div class="col col-lg-7 col-xl-8 hidden-md-down">
    <menu class="no-list main-menu">
        <li>
            <a href="#" class="main-menu--link js-MainMenu">Каталог</a>
            <div class="menu-container">
                <div class="row">
                    <div class="col col-12 col-md-3">
                        <div class="menu-container--title">Электротехнические товары</div>
                        <? $APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"header-catalog-menu", 
	array(
		"IS_OREN" => $OptimalGroup["DOMAIN"]=="oren",
		"FILTER_TYPE" => CATALOG_TYPE_PRODUCTS,
		"CHILD_DEPTH_LEVEL" => "1",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COUNT_ELEMENTS" => "Y",
		"IBLOCK_ID" => CATALOG_IBLOCK_ID,
		"IBLOCK_TYPE" => "1c_catalog",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID" => "",
		"SECTION_URL" => "/catalog/#SECTION_CODE#/",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "UF_*",
			2 => "",
		),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "5",
		"VIEW_MODE" => "LINE",
		"COMPONENT_TEMPLATE" => "header-catalog-menu"
	),
	false
);?>
                    <!--/Menu contaner left-->                                                    
                    </div>
                    <div class="col col-12 col-md-9">
                        <div class="row">
                            <div class="col col-12 col-md-4 col-xl-4">
                                <div class="menu-container--title">Услуги для дома</div>
                                <div class="menu-product">
                                    <a href="/electrical-work/" class="menu-product--img"><img src="<?=MEDIA_PATH;?>images/menu-banner--elect-install.png" alt="" class="img-responsive"></a>
                                </div>
                            </div>
                            <div class="col col-12 col-md-4 col-xl-4">
                                <div class="menu-container--title">Замена электросчетчиков</div>
                                <div class="menu-product">
                                    <a href="/electric-meter/" class="menu-product--img"><img src="<?=MEDIA_PATH;?>images/menu-banner--elect.png" alt="" class="img-responsive"></a>
                                </div>
                            </div>
                            <div class="col col-12 col-md-4 col-xl-4">
                                <div class="menu-container--title">Замена счетчиков воды</div>
                                <div class="menu-product">
                                    <a href="/water-meter/" class="menu-product--img"><img src="<?=MEDIA_PATH;?>images/menu-banner--water.png" alt="" class="img-responsive"></a>
                                </div>
                            </div>
                        </div>
                    <!--/Menu contaner right-->                                                                                                        
                    </div>
                </div>
            <!--/menu container-->
            </div>
        </li>
        <li><a href="/clients/sposoby-oplaty/" class="main-menu--link">Оплата</a></li>
        <li><a href="/clients/sposoby-dostavki/" class="main-menu--link">Доставка</a></li>
        <li><a href="/clients/garantiya-i-vozvrat/" class="main-menu--link">Гарантия и возврат</a></li>
        <li><a href="/clients/" class="main-menu--link">Информация</a></li>
    </menu>
</div>
<div class="col col-7 text-right col-md-4 col-lg-3 col-xl-2">
    <div class="header-shop">
        <!--<a href="#" class="btn btn-orange btn-square"><i class="fa fa-bar-chart"></i></a>-->
        <div class="js-BasketHeader header-shop--basket ib">
            <? $APPLICATION->IncludeFile(INCLUDE_PATH . 'template/header.basket.php', Array(), Array("SHOW_BORDER"=> "false"));;?>
        </div>
        <a href="/personal/" class="btn btn-orange btn-square"><i class="icon-key btn-icon"></i></a>
    </div>
</div>
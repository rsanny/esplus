<?
$APPLICATION->SetTitle("Интернет магазин ЭнергосбыТ Плюс");
global $globalFilter;
$globalFilter = \OptimalGroup\SiteSection::FilterOr();
\OptimalGroup\Core::AddCss(array("page/shop"));
?>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"index-slider",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("", ""),
		"FILTER_NAME" => "globalFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "info",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("BANNER_TITLE", ""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>


<section class="index-section bg-grey border-top-bottom">
    <div class="container">
        <div class="section-title text-center"><span>Комплексные услуги по выгодной цене</span></div>
        <? \Optimalgroup\Template::OfferBanners(array("arSettings" => array("NEWS_COUNT" => 2)));?>
    </div>
</section>

<section class="index-section">
    <div class="container">
        <div class="section-title text-center"><span>Каталог товаров</span></div>
        <? $APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"index-catalog-section", 
	array(
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
		"TOP_DEPTH" => "1",
		"VIEW_MODE" => "LINE",
		"COMPONENT_TEMPLATE" => "index-catalog-section"
	),
	false
);?>
    </div>
</section>
<section class="popular-products index-section">
    <div class="container">
        <div class="section-title text-center"><span>Хиты продаж</span></div>
        <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/site/shop/hit-list.php', Array(), Array("MODE"=> "html"));?>
        <div class="section--btn text-center"><a href="/catalog/" class="btn btn-transparent-border w-210">Интернет-магазин</a></div>
    </div>
</section>

<section class="index-section">
    <div class="container">
        <div class="section-title text-center"><span>Услуги</span></div>
        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list",
            "index-catalog-section",
            Array(
                "CHILD_DEPTH_LEVEL" => 2,
                "ADD_CLASS" => " service-slider--list",
                "FILTER_ID" => array(686),
                "ADD_SECTIONS_CHAIN" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "COUNT_ELEMENTS" => "Y",
                "IBLOCK_ID" => CATALOG_IBLOCK_ID,
                "IBLOCK_TYPE" => "1c_catalog",
                "SECTION_CODE" => "",
                "SECTION_FIELDS" => array("", ""),
                "SECTION_ID" => CATALOG_IBLOCK_SERVICE_SECTION,
                "SECTION_URL" => "/electrical-work/#SECTION_CODE#/",
                "SECTION_USER_FIELDS" => array("UF_*"),
                "SHOW_PARENT_NAME" => "Y",
                "TOP_DEPTH" => "2",
                "VIEW_MODE" => "LINE"
            )
        );?>
        
        <br>
        <div class="row mt-20 flex-vertical shop-bottom">
            <div class="col col-6 col-md-6 col-xl-3">
                <div class="flex flex-vertical">
                    <i class="mb-10 mb-md-0 mr-md-20"><img src="<?=MEDIA_PATH;?>icons/icon-shop--bottom.png" alt=""></i>
                    <b class="fs-18">Прозрачные<br>фиксированные<br>цены</b>
                </div>
            </div>
            <div class="col col-6 col-md-6 col-xl-3">
                <div class="flex flex-vertical">
                    <i class="mb-10 mb-md-0 mr-md-20"><img src="<?=MEDIA_PATH;?>icons/icon-shop--bottom-2.png" alt=""></i>
                    <b class="fs-18">Квалифицированные<br>мастера</b>
                </div>
            </div>
            <div class="col col-6 col-md-6 col-xl-3 mt-20 mt-xl-0">
                <div class="flex flex-vertical">
                    <i class="mb-10 mb-md-0 mr-md-20"><img src="<?=MEDIA_PATH;?>icons/icon-shop--bottom-4.png" alt=""></i>
                    <b class="fs-18">Пакетные предложения<br>с монтажом</b>
                </div>
            </div>
            <div class="col col-6 col-md-6 col-xl-3 mt-20 mt-xl-0">
                <div class="flex flex-vertical">
                    <i class="mb-10 mb-md-0 mr-md-20"><img src="<?=MEDIA_PATH;?>icons/icon-shop--bottom-5.png" alt=""></i>
                    <b class="fs-18">Гарантия<br>на товары и работы</b>
                </div>
            </div>
        </div>
    </div>        
</section>    
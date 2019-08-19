<?
global $OptimalGroup;
?>
<li>
    <a href="#" class="js-MainMenu">Товары<i class="fa fa-angle-right"></i></a>
    <? $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "catalog-menu--mobile",
        Array(
            "CHECK_ITEMS" => "Y",
            "BRANCH" => $OptimalGroup['DOMAIN'],
            "FILTER_TYPE" => CATALOG_TYPE_PRODUCTS,
            "CHILD_DEPTH_LEVEL" => 1,
            "CURRENT_SECTION" => "",
            "ADD_SECTIONS_CHAIN" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "COUNT_ELEMENTS" => "Y",
            "IBLOCK_ID" => CATALOG_IBLOCK_ID,
            "IBLOCK_TYPE" => "1c_catalog",
            "SECTION_CODE" => "",
            "SECTION_FIELDS" => array("", ""),
            "SECTION_ID" => "",
            "SECTION_URL" => "/catalog/#SECTION_CODE#/",
            "SECTION_USER_FIELDS" => array("UF_*"),
            "SHOW_PARENT_NAME" => "Y",
            "TOP_DEPTH" => "5",
            "VIEW_MODE" => "LINE"
        )
    );?>
</li>
<li>
    <a href="#" class="js-MainMenu">Услуги <i class="fa fa-angle-right"></i></a>
    <?$APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "catalog-menu--mobile",
        Array(
            "CURRENT_SECTION_CODE" => "",
            "CHILD_DEPTH_LEVEL" => 2,
            "FILTER_ID" => array(686),
            "ADD_SECTIONS_CHAIN" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "COUNT_ELEMENTS" => "N",
            "IBLOCK_ID" => CATALOG_IBLOCK_ID,
            "IBLOCK_TYPE" => "1c_catalog",
            "SECTION_CODE" => "",
            "SECTION_FIELDS" => array("", ""),
            "SECTION_ID" => CATALOG_IBLOCK_SERVICE_SECTION,
            "SECTION_URL" => "/electrical-work/#SECTION_CODE#/",
            "SECTION_USER_FIELDS" => array("UF_*"),
            "SHOW_PARENT_NAME" => "Y",
            "TOP_DEPTH" => "1",
            "VIEW_MODE" => "LINE"
        )
    );?>
</li>
<li>
    <a href="#" class="js-MainMenu">Пакетные предложения<i class="fa fa-angle-right"></i></a>
    <ul class="no-list second-level none">
        <li><a href="/electric-meter/">Установка электросчетчиков</a></li>
        <li><a href="/water-meter/">Установка счетчиков воды</a></li>
    </ul>
</li>
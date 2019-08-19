<?
global $OptimalGroup;
?>
<div class="catalog-section--title">Товары</div>
<? $APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"catalog-menu",
	Array(
        "CHECK_ITEMS" => "Y",
        "BRANCH" => $OptimalGroup['DOMAIN'],
        "FILTER_TYPE" => CATALOG_TYPE_PRODUCTS,
        "CHILD_DEPTH_LEVEL" => 1,
        "CURRENT_SECTION" => $arCurSection,
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
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
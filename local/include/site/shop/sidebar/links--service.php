<div class="catalog-section--title">Услуги</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"catalog-menu",
	Array(
        "CURRENT_SECTION_CODE" => $arCurSection,
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
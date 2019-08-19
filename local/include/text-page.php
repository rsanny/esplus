<?
$arSettings['CURRENT_URL'] = \OptimalGroup\Core::GetCurPage();
$SiteSection = OptimalGroup\SiteSection::Get();
if ($arSettings['LEFT_MENU'] == "Y"):?>
<div class="row">
    <div class="col col-12 col-md-4 col-lg-3">
        <?
        $APPLICATION->IncludeFile(
            INCLUDE_PATH . '/template/left-menu.php', 
            array("arSettings" => $arSettings), 
            array("SHOW_BORDER"=> false)
        );
        ?>
    </div>
    <div class="col col-12 col-md-8 col-lg-9">
<? endif;

global $simplePage;
$simplePage = array(
    array(
        "LOGIC" => "OR",
        array(
            "PROPERTY_TYPE" => $_SESSION['BXExtra']['SITE']['ID'],
            "PROPERTY_BRANCH" => $_SESSION['BXExtra']['REGION']['IBLOCK']['ID'],
            "PROPERTY_PAGE_URL" => $arSettings['CURRENT_URL']
        ),
        array(
            "PROPERTY_BRANCH" => false,
            "PROPERTY_TYPE" => $_SESSION['BXExtra']['SITE']['ID'],
            "PROPERTY_PAGE_URL" => $arSettings['CURRENT_URL']
        ),
    )      
);
?>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"simple-page", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "DETAIL_TEXT",
			1 => "",
		),
		"FILTER_NAME" => "simplePage",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "info",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "1",
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
		"PROPERTY_CODE" => array(
			0 => "PAGE_TITLE",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "simple-page"
	),
	false
);?>
<? if ($arSettings['LEFT_MENU'] == "Y"):?>
    </div>
</div>
<? endif;?>
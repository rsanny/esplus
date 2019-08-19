<?
if ($_REQUEST['loadMore']){
    define("STOP_STATISTICS", true);
    require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
}
global $contactsFilter;
$contactsFilter = array("PROPERTY_BRANCH" => $_SESSION['BXExtra']['REGION']['IBLOCK']['ID']);
if ($_REQUEST['is_filter']){
    if ($_REQUEST['city']) {
        $contactsFilter[] = array(
            "LOGIC" => "OR",
            array('%NAME' => $_REQUEST['city']),
            array('%PROPERTY_CITY' => $_REQUEST['city'])
        );
    }
    if ($_REQUEST['contacts_type']){
        $contactsFilter['PROPERTY_TYPE'] = $_REQUEST['contacts_type'];
    }
    if ($_REQUEST['contacts_service']){
        foreach ($_REQUEST['contacts_service'] as $IconId){
            $contactsFilter[] = array("ID" => CIBlockElement::SubQuery("ID", array("IBLOCK_ID" => 7, "PROPERTY_ICONS" => $IconId)));
        }
        $contactsFilter[] = $Logic;
    }
}
$loadMore = false;
if ($_REQUEST['loadMore'])
    $loadMore = true;
?>
<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "contacts",
    Array(
        "SELECTED_ICONS"=>$_REQUEST['contacts_type'],
        "LOAD_MORE"=>$loadMore,
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
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array("", ""),
        "FILTER_NAME" => "contactsFilter",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "7",
        "IBLOCK_TYPE" => "contacts",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "10",
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
        "PROPERTY_CODE" => array("PHONE", ""),
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
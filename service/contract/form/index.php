<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Смена собственника");
require($_SERVER["DOCUMENT_ROOT"]."/service/header.php");
$DetailUrl = "/service/contract/";
if ($OptimalGroup['SITE']['CODE'] == "business"){
    $DetailUrl = "/business".$DetailUrl;
}
?>
<div class="service-form service-tabs">
    <?
    global $arContractSection;
    $arContractSection = array(
        'PROPERTY_TYPE' => $_SESSION['BXExtra']['SITE']['ID'],
        'CODE' => $_REQUEST['ELEMENT_CODE'],
        'PROPERTY_BRANCH' => $_SESSION['BXExtra']['REGION']['IBLOCK']['ID']
    );
    ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "contract-detail",
        Array(
            "UF_BRANCH" => $OptimalGroup['BRANCH']['ID'],
            "ACTIVE_DATE_FORMAT" => "d F Y г.",
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
            "DETAIL_URL" => $DetailUrl."#SECTION_CODE#/#ELEMENT_CODE#/",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "N",
            "DISPLAY_PREVIEW_TEXT" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array("", ""),
            "FILTER_NAME" => "arContractSection",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "31",
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
            "PARENT_SECTION_CODE" => $_REQUEST['SECTION_CODE'],
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array("TYPE", ""),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
        )
    );?>
    
    
</div>    
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
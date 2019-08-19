<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Анонсирование закупок");
?>

<div class="row">
    <div class="col col-12 col-md-4 col-lg-3">
        <?
        $APPLICATION->IncludeFile(
            INCLUDE_PATH . '/template/left-menu.php', 
            array("arSettings" => array("CACHE_SELECTED_ITEMS"=>"Y")), 
            array("SHOW_BORDER"=> false)
        );
        ?>
    </div>
    <div class="col col-12 col-md-8 col-lg-9">
        <?
        if (empty($_REQUEST['SECTION_CODE'])){
            global $NoSection;
            $NoSection['SECTION_ID'] = false;
        }
        ?>
        <div class="news-filter">
            <span>Показать:</span>
            <a href="/about/purchase/announcement/archive/"<? if ($_REQUEST['SECTION_CODE']):?> class="is-selected"<? endif;?>>Архив</a>
       </div>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list", 
            "file-list--small", 
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
                "FILTER_NAME" => "NoSection",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "22",
                "IBLOCK_TYPE" => "purchase",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "N",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "100",
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
                "PROPERTY_CODE" => array(
                    0 => "FILE",
                    1 => "",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "Y",
                "COMPONENT_TEMPLATE" => "file-list--small"
            ),
            false
        );?>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
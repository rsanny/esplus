<?
$tariffLink = "/tariffs/".$OptimalGroup['DOMAIN']."/ur/";
$ZhkuDomains = array(
    "ekb",
    "kirov",
    "oren",
    "novgorod",
    "chuvashia",
    "vladimir",
    "udm"
);
$MenuPath = INCLUDE_PATH.'site/'.$OptimalGroup['SITE']['CODE'].'/header/menu-'.$OptimalGroup['GROUP'].'.php';
?>
<div class="col col-8 hidden-md-down">
    <menu class="no-list main-menu">
        
        <? require($_SERVER["DOCUMENT_ROOT"].$MenuPath);?>
        <li><a href="/business/clients/par/" class="main-menu--link">Пар</a></li>
        <? if (in_array($OptimalGroup['DOMAIN'],$ZhkuDomains)):?>
        <li><a href="/zhku/" class="main-menu--link">ЖКУ</a></li>
        <? endif;?>
        <li>
            <a href="/services/" class="main-menu--link js-MainMenu">Услуги</a>
            <div class="menu-container">
                <div class="row">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "menu-services",
                        Array(
                            "IN_ROW"=>4,
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
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
                            "FILTER_NAME" => "arFilterBySection",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "26",
                            "IBLOCK_TYPE" => "info",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "200",
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
                            "PROPERTY_CODE" => array("ICON"),
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
                            "SORT_ORDER2" => "ASC"
                        )
                    );?>
                </div>
            </div>
        </li>
    </menu>
</div>
<div class="col col-7 text-right col-md-4 col-lg-2">
    <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/header-auth.php', Array(), Array("MODE"=> "html"));?>
</div>
<?
global $OptimalGroup;
use DorrBitt\seo\SEO;
$objSEO = new SEO();
$subDomenData = explode(".",$_SERVER["SERVER_NAME"])[0];
$filialName = $objSEO->seoTitle($subDomenData);
//$IndexTitle = $OptimalGroup['BRANCH']['NAME']." филиал ЭнергосбыТ Плюс";
$IndexTitle = $filialName." филиал ЭнергосбыТ Плюс";
$APPLICATION->SetTitle($IndexTitle);
$APPLICATION->SetPageProperty('description', 'АО "ЭнергосбыТ Плюс" – объединенная энергосбытовая компания Группы "Т Плюс" с филиальной сетью из 13 региональных филиалов на территории Российской Федерации.');
global $globalFilter;
$globalFilter = \OptimalGroup\SiteSection::FilterOr();
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
<? 
$IndexPath = INCLUDE_PATH . 'site/'.$OptimalGroup['SITE']['CODE'].'/index_'.$OptimalGroup['GROUP'].'.php';
if ($OptimalGroup['BRANCH']['URL'] == "vladimir")
    $IndexPath = INCLUDE_PATH . 'site/'.$OptimalGroup['SITE']['CODE'].'/index_vladimir.php';
if ($OptimalGroup['BRANCH']['URL'] == "chuvashia")
    $IndexPath = INCLUDE_PATH . 'site/'.$OptimalGroup['SITE']['CODE'].'/index_chuvashia.php';
if ($OptimalGroup['BRANCH']['URL'] == "saratov")
    $IndexPath = INCLUDE_PATH . 'site/'.$OptimalGroup['SITE']['CODE'].'/index_saratov.php';
if ($OptimalGroup['BRANCH']['URL'] == "kirov")
    $IndexPath = INCLUDE_PATH . 'site/'.$OptimalGroup['SITE']['CODE'].'/index_kirov.php';

if ($OptimalGroup['BRANCH']['URL'] == "samara")
    $IndexPath = INCLUDE_PATH . 'site/'.$OptimalGroup['SITE']['CODE'].'/index_samara.php';

//if ():?>

<? $APPLICATION->IncludeFile($IndexPath, array(), Array("SHOW_BORDER"=> false));?>

<section class="index-news index-section">
    <div class="container">
        <div class="section-title text-center"><span>Новости</span></div>
        <?
        \Bitrix\Main\Page\Asset::getInstance()->addJs("//yastatic.net/share2/share.js");
        ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "news",
            Array(
                "COLS"=>4,
                "ACTIVE_DATE_FORMAT" => "d F Y г.",
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
                "FIELD_CODE" => array("TAGS", ""),
                "FILTER_NAME" => "globalFilter",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "3",
                "IBLOCK_TYPE" => "info",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "4",
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
                "PROPERTY_CODE" => array("BRANCH", ""),
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

        <div class="section--btn text-center"><a href="/news/" class="btn btn-transparent-border w-210">Еще новости</a></div>
    </div>
</section>
<?
global $TestVideo;
if ($OptimalGroup['DOMAIN'] == "perm" && $_REQUEST['video'] == "y"){
    $TestVideo['ID'] = [253087,312957];
}
else {
    $TestVideo = $globalFilter;
}
?>
<section class="index-banners hidden-sm-down">
    <div class="container">
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "banners-footer",
            Array(
                "ACTIVE_DATE_FORMAT" => "d F Y г.",
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
                "FIELD_CODE" => array("BRANCH", ""),
                "FILTER_NAME" => "TestVideo",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "49",
                "IBLOCK_TYPE" => "info",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "2",
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
                "PROPERTY_CODE" => array("BRANCH", ""),
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
                "STRICT_SECTION_CHECK" => "N"
            )
        );?>
    </div>
</section>
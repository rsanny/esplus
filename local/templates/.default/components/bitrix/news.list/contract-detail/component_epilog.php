<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION, $OptimalGroup;
$EmailSend = $OptimalGroup['BRANCH']['E_CONTRACT_INDV'];
$Analytics = array(
    "ga" => array(
        "category" => "dom-about",
        "action" => "dog-fiz"
    ),
    "ym" => "dog-fiz"
);
if ($OptimalGroup['SITE']['CODE'] == "business"){
    $EmailSend = $OptimalGroup['BRANCH']['E_CONTRACT_LEGAL'];
    $Analytics = array(
        "ga" => array(
            "category" => "busin-service",
            "action" => "dog-biz"
        ),
        "ym" => "dog-biz"
    );
}
    
$arTemplate = $arResult['arResult'];
$Title = $arTemplate['ITEM']['PROPERTIES']['TITLE']['VALUE'];
$TitleH1 = $Title;
if ($arTemplate['ITEM']['PROPERTIES']['H1_TITLE']['VALUE']){
    $TitleH1 = $arTemplate['ITEM']['PROPERTIES']['H1_TITLE']['VALUE'];
}
$APPLICATION->SetTitle($TitleH1);
$APPLICATION->AddChainItem($TitleH1,$arTemplate['ITEM']['DETAIL_PAGE_URL']);
?>
<div class="form-group--title text-left text-md-center"><?=$Title;?></div>
<div class="row">
    <div class="col col-12 col-md-12 col-lg-3">
        <?
        global $arContractTabs;
        //$arContractTabs['PROPERTY_TYPE'] = $_SESSION['BXExtra']['SITE']['ID'];
        $arContractTabs = array(
            "PROPERTY_TYPE" => $_SESSION['BXExtra']['SITE']['ID'],
            "PROPERTY_BRANCH" => $_SESSION['BXExtra']['REGION']['IBLOCK']['ID']
        );
        ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "contract-sections--tabs",
            Array(
                "UF_BRANCH" => $arParams['UF_BRANCH'],
                "CURRENT"=>array(
                    "SECTION" => $arParams['PARENT_SECTION_CODE'],
                    "ELEMENT" => $arTemplate['ITEM']['CODE']
                ),
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
                "DETAIL_URL" => $arParams['DETAIL_URL'],
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array("", ""),
                "FILTER_NAME" => "arContractTabs",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "31",
                "IBLOCK_TYPE" => "info",
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
        <div class="form-description bg-message bg-info fs-15 mt-20 mb-20">
            <div class="mb-10 color-orange"><b>Информация</b><i class="icon-info--orange"></i></div>
            <?=$arTemplate['ITEM']['PREVIEW_TEXT'];?>
        </div>
    </div>
    <div class="col col-12 col-md-10 col-lg-9">
        <? if ($arTemplate['ITEM']['DETAIL_TEXT']):?>
        <div class="popup-form--text"><?=$arTemplate['ITEM']['DETAIL_TEXT'];?></div>
        <? endif;?>
        <? $APPLICATION->IncludeComponent("bitrix:form.result.new", "contract", Array(
            "ANALYTICS" => $Analytics,
            "EMAIL_SEND" => $EmailSend,
            "HIDE_TITLE" => "Y",
            "WEB_FORM_ID" => $arTemplate['ITEM']['PROPERTIES']['FORM']['VALUE'],	// ID веб-формы
            "IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
            "USE_EXTENDED_ERRORS" => "Y",	// Использовать расширенный вывод сообщений об ошибках
            "SEF_MODE" => "N",	// Включить поддержку ЧПУ
            "VARIABLE_ALIASES" => array(
                "WEB_FORM_ID" => "WEB_FORM_ID",
                "RESULT_ID" => "RESULT_ID",
            ),
            "CACHE_TYPE" => "N",	// Тип кеширования
            "CACHE_TIME" => "3600",	// Время кеширования (сек.)
            "LIST_URL" => "",	// Страница со списком результатов
            "EDIT_URL" => "",	// Страница редактирования результата
            "SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
            "CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
            "CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
            "AJAX_MODE" => "Y",
            "AJAX_OPTION_JUMP" => "Y",
        ),
        false
        );?>
    </div>
</div>
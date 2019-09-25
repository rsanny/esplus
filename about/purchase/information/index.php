<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Информация о закупках");
?>
<div class="row">
    <div class="col col-12 col-md-4 col-lg-3">
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "left",
            Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "section",
                "DELAY" => "N",
                "MAX_LEVEL" => "2",
                "MENU_CACHE_GET_VARS" => array(""),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "left",
                "USE_EXT" => "N"
            )
        );?>
    </div>
    <div class="col col-12 col-md-8 col-lg-9">
        <div class="service-tabs mb-40">
            <div class="section-title text-center"><span>Подписка на извещения о закупках</span></div>
            <div class="row">
                <div class="col col-12 offset-md-0 col-lg-11 offset-lg-0 col-xl-9 offset-xl-1">
                <? $APPLICATION->IncludeComponent(
                    "dorrbitt:form.result.new",
                    "",
                    Array(
                        "EMAIL_SEND" => $_SESSION['BXExtra']['REGION']['IBLOCK']['E_PURCHASE'],              
                        "ANALYTICS" => array(
                            "ga" => array(
                                "category" => "dom-about",
                                "action" => "zakup-pod"
                            ),
                            "ym" => "zakup-pod"
                        ),
                        "SUBSCRIBE_ID" => SUBSCRIBE_PURCHASE,
                        "HIDE_TITLE" => "Y",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "CACHE_TIME" => "3600",
                        "CACHE_TYPE" => "N",
                        "CHAIN_ITEM_LINK" => "",
                        "CHAIN_ITEM_TEXT" => "",
                        "EDIT_URL" => "",
                        "IGNORE_CUSTOM_TEMPLATE" => "N",
                        "LIST_URL" => "",
                        "SEF_MODE" => "N",
                        "SUCCESS_URL" => "",
                        "USE_EXTENDED_ERRORS" => "Y",
                        "VARIABLE_ALIASES" => array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID",),
                        "WEB_FORM_ID" => 2
                    )
                );?>
                </div>
            </div>
        </div>
        <?
        if ($_REQUEST['q']){
            global $arPurchase;
            $arPurchase[] = array(
                "LOGIC" => "OR",
                array('%NAME' => $_REQUEST['q']),
                array('%PROPERTY_SOURCE' =>  $_REQUEST['q'])
            );
        }
        if ($_REQUEST['date']){
            global $arPurchase;

            $arPurchase['>=PROPERTY_DATE_POST'] = $DB->FormatDate($_REQUEST['date']['FROM'],"DD.MM.YYYY","YYYY-MM-DD HH:MI:SS");
            if ($_REQUEST['date']['TILL']){
                $arPurchase['<=PROPERTY_DATE_POST'] = $DB->FormatDate($_REQUEST['date']['TILL'],"DD.MM.YYYY","YYYY-MM-DD HH:MI:SS");
            }
        }
        if ($arPurchase){
            foreach($arPurchase as $k=>$rule)
                if (empty($rule)) unset($arPurchase[$k]);
        }
        ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list", 
            "purchase-list", 
            array(
                "Q" => $_REQUEST['q'],
                "TILL" => $_REQUEST['date']['TILL'],
                "FROM" => $_REQUEST['date']['FROM'],
                "SEARCH_URL"=>$APPLICATION->GetCurPage(),
                "ACTIVE_DATE_FORMAT" => "j F Y",
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
                "FIELD_CODE" => array(
                    0 => "DETAIL_TEXT",
                    1 => "",
                ),
                "FILTER_NAME" => "arPurchase",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "23",
                "IBLOCK_TYPE" => "purchase",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "1000",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => $_REQUEST['SECTION_ID'],
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "LOT",
                    1 => "",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "PROPERTY_DATE_POST",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC"
            ),
            false
            );?>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
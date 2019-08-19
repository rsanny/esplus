<?
define("STOP_STATISTICS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
CJSCore::Init(array('ajax', 'window')) ;
?>
<div class="popup-form overflow">
    <?$APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        "",
        Array(
            "EMAIL_SEND" => $_SESSION['BXExtra']['REGION']['IBLOCK']['E_ODPU'],
            "IN_COLUMN" => true,
            "TITLE" => $_REQUEST['title'],
            "URL" => $_REQUEST['url'],
            "BRANCH_HIDDEN"=>true,
            "AJAX_MODE" => "Y",
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
            "WEB_FORM_ID" => 29
        )
    );?>
</div>
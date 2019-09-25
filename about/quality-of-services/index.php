<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оценить качество услуг");
$FORM_ID = 4;
$EmailSend = $_SESSION['BXExtra']['REGION']['IBLOCK']['E_OCENKA'];
$Analytics = array(
    "ga" => array(
        "category" => "dom-about",
        "action" => "quality-fiz"
    ),
    "ym" => "quality-fiz"
);
if ($_SESSION['BXExtra']['SITE']['CODE'] == "business") {
    $FORM_ID = 5;
    $EmailSend = $_SESSION['BXExtra']['REGION']['IBLOCK']['E_OCENKA_LEGAL'];
    $Analytics = array(
        "ga" => array(
            "category" => "busin-form",
            "action" => "quality-biz"
        ),
        "ym" => "quality-biz"
    );
}
if (empty($EmailSend)) $EmailSend = "#DEFAULT_EMAIL_FROM#";
?>
<div class="service-form content-container">
    <?$APPLICATION->IncludeComponent(
        "dorrbitt:form.result.new",
        "quality-of-services",
        Array(  
            "ANALYTICS" => $Analytics,
            "EMAIL_SEND" => $EmailSend,
            "BRANCH_HIDDEN"=>true,
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
            "WEB_FORM_ID" => $FORM_ID
        )
    );?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
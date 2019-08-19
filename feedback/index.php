<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обратная связь");
$Analytics = array(
    "ga" => array(
        "category" => "dom-about",
        "action" => "feedback-fiz"
    ),
    "ym" => "feedback-fiz"
);
if ($OptimalGroup['SITE']['CODE'] == "business"){
    $Analytics = array(
        "ga" => array(
            "category" => "busin-form",
            "action" => "feedback-biz"
        ),
        "ym" => "feedback-biz"
    );
}
?>
<div class="index-section">
    <div class="container">
        <div class="row">
            <div class="col col-12 col-lg-8 offset-lg-2">
                <div class="form-content">
                    <div class="row">
                        <div class="col col-12 col-lg-10 offset-lg-1">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:form.result.new",
                                "",
                                Array(
                                    "EMAIL_SEND" => $_SESSION['BXExtra']['REGION']['IBLOCK']['E_FEEDBACK'],
                                    "ANALYTICS" => $Analytics,
                                    "FORM_TITLE" => "Обратная связь",
                                    "TITLE"=>"Обратная связь",
                                    "URL"=>$APPLICATION->GetCurPage(),
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
                                    "WEB_FORM_ID" => 24
                                )
                            );?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
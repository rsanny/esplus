<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оставить заявку на установку ОДПУ");
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
                                    "EMAIL_SEND" => $_SESSION['BXExtra']['REGION']['IBLOCK']['E_ODPU'],
                                    "FORM_TITLE" => "Оставить заявку на установку ОДПУ",
                                    "TITLE"=>"Оставить заявку на установку ОДПУ",
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
                                    "WEB_FORM_ID" => 29
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
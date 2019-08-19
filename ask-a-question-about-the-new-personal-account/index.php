<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Вопросы и предложения по новому личному кабинету");
$APPLICATION->SetTitle("");
?><div class="index-section">
    <div class="container">
        <div class="row">
            <div class="col col-12 col-lg-10 offset-lg-1">
                <div class="form-content">
<!--                    <pre>-->
<!--                        --><?//= var_dump($_SESSION["BXExtra"]["REGION"]["IBLOCK"])?>
<!--                    </pre>-->
                            <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"questions_lk",
	Array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"ANALYTICS" => $Analytics,
        "IN_COLUMN" => true,
		"BRANCH_HIDDEN" => true,
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "N",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"EDIT_URL" => "",
		"EMAIL_SEND" => $_SESSION["BXExtra"]["REGION"]["IBLOCK"]["E_QUESTIONS_LK"],
		"FORM_TITLE" => "Вопросы и предложения по новому личному кабинету",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"TITLE" => "Вопросы и предложения по новому личному кабинету",
		"URL" => $APPLICATION->GetCurPage(),
		"USE_EXTENDED_ERRORS" => "Y",
		"VARIABLE_ALIASES" => array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID",),
		"WEB_FORM_ID" => "33"
	)
);?>
                </div>
            </div>
        </div>
    </div>        
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
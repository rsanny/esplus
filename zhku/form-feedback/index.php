<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Задать вопрос");
?>
<div class="row">
    <div class="col col-12 col-sm-3">
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "left",
            Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "section",
                "DELAY" => "N",
                "MAX_LEVEL" => 2,
                "MENU_CACHE_GET_VARS" => array(""),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "section",
                "USE_EXT" => "N"
            )
        );?>
    </div>
    <div class="col col-12 col-sm-9">
        <div class="form-content">
            <div class="row">
                <div class="col col-12 col-lg-10 offset-lg-1">
                    <?$APPLICATION->IncludeComponent(
                        "dorrbitt:form.result.new",
                        "",
                        Array(
                            "ANALYTICS" => array(
                                "ga" => array(
                                    "category" => "busin-zhku",
                                    "action" => "zhku-feed"
                                ),
                                "ym" => "zhku-feed"
                            ),
                            "EMAIL_SEND" => $_SESSION['BXExtra']['REGION']['IBLOCK']['EMAIL_ZHKU'],
                            "FORM_TITLE"=>"Задать вопрос ЖКУ",
                            "URL"=>$APPLICATION->GetCurPage(),
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
                            "WEB_FORM_ID" => 31
                        )
                    );?>
                </div>
            </div>
        </div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
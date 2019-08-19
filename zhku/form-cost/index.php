<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявка на расчет стоимости");
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
        <?$APPLICATION->IncludeComponent(
            "bitrix:form.result.new",
            "zhku",
            Array(
                "ANALYTICS" => array(
                    "ga" => array(
                        "category" => "busin-zhku",
                        "action" => "zhku-cost"
                    ),
                    "ym" => "zhku-cost"
                ),
                "EMAIL_SEND" => $_SESSION['BXExtra']['REGION']['IBLOCK']['EMAIL_ZHKU'],
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
                "WEB_FORM_ID" => 7
            )
        );?>

<p class="mt-40"><b>Стоимость и оформление заявки на оказание Агентских услуг зависит от:</b></p>

<ul>
<li>Перечня оказываемых услуг;</li>
<li>Видов ЖКУ, приходящихся на 1 лицевой счет, по которым заказчик является поставщиком;</li>
<li>Количества лицевых счетов;</li>
<li>Среднемесячного потока денежных средств (начисления).</li>
</ul>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
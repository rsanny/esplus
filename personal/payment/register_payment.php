<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
?>
<?$APPLICATION->IncludeComponent("bitrix:sale.order.payment.receive","",Array(
        "PAY_SYSTEM_ID_NEW" => "4",
        "TYPE" => "REGISTER"
    )
);?>
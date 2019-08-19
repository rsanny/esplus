<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><?

$psTitle = 'СПЭК';
$psDescription = 'Эквайринг Газпромбанк';

$arPSCorrespondence = array(
      "ACTION" => array(
            "NAME" =>'Адрес шлюза',
            "DESCR" => "",
            "VALUE" => "",
            "TYPE" => ""
         ),
      "MERCHANT" => array(
            "NAME" => 'Merchant ID',
            "DESCR" => "",
            "VALUE" => "",
            "TYPE" => ""
         ),
      "BACK_URL_S" => array(
            "NAME" => 'Адрес успешного платежа',
            "DESCR" => '',
            "VALUE" => "",
            "TYPE" => ""
         ),
      "BACK_URL_F" => array(
            "NAME" => 'Адрес ошибки платежа',
            "DESCR" => "",
            "VALUE" => "",
            "TYPE" => ""
         ),
      "ORDER_ID" => array(
            "NAME" => 'Номер заказа',
            "DESCR" => "",
            "VALUE" => "ID",
            "TYPE" => "ORDER"
         ),
      "AMOUNT" => array(
            "NAME" => 'Сумма к оплате',
            "DESCR" => "",
            "VALUE" => "SHOULD_PAY",
            "TYPE" => "ORDER"
         ),
      "CURRENCY" => array(
            "NAME" => 'Валюта',
            "DESCR" => '643 - рубль (iso4217)',
            "VALUE" => "643",
            "TYPE" => ""
         )
);
?>
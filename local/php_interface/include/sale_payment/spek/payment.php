<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) 
  die();

$actionUrl = CSalePaySystemAction::GetParamValue("ACTION");

$arData = array(
    'lang' => 'RU',
    'merch_id' => CSalePaySystemAction::GetParamValue("MERCHANT"),
    'back_url_s' => CSalePaySystemAction::GetParamValue("BACK_URL_S"),
    'back_url_f' => CSalePaySystemAction::GetParamValue("BACK_URL_F"),
    'o.order_id' => CSalePaySystemAction::GetParamValue("ORDER_ID"),
    //'o.order_id' => $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["ID"]
);
$url = $actionUrl.'?'.http_build_query($arData);
/*pr($actionUrl);
pr($arData);*/
?>
<a href="<?=$url?>" class="btn btn-orange">Перейти к оплате</a>
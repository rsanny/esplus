<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><?

$order_id = $_GET['o_order_id'];

if ($order_id <= 0)
  $error = 'Ошибка запроса';
elseif (!($arOrder = CSaleOrder::GetByID($order_id)))
  $error = 'Такой заказ не существует';
elseif ($arOrder["PAYED"] == "Y")
  $error = 'Заказ уже оплачен';

if(!empty($arOrder))
{
  CSalePaySystemAction::InitParamArrays($arOrder, $arOrder["ID"]);
}

if($arParams['TYPE'] == 'CHECK_AVAIL')
{
  if(!!$error){
    ?>
<payment-avail-response>
  <result>
     <code>2</code>     
     <desc><?=$error?></desc>
  </result>
</payment-avail-response>
    <?
    return;
  }

  $arFields = array(
    "PS_STATUS_DESCRIPTION" => $_REQUEST['trx_id'],
    "PS_RESPONSE_DATE" => date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG))),
  );
  CSaleOrder::Update($arOrder["ID"], $arFields);
  $currency = CSalePaySystemAction::GetParamValue("CURRENCY");
  $amount = CSalePaySystemAction::GetParamValue("AMOUNT")*100;
?>
<payment-avail-response>
    <result>
        <code>1</code>
        <desc>OK</desc>
    </result>
    <merchant-trx>trx<?=$order_id?></merchant-trx>
    <purchase>
        <shortDesc>Заказ №<?=$order_id?></shortDesc>
        <longDesc>Заказ №<?=$order_id?></longDesc>
        <account-amount>
            <amount><?=$amount?></amount>
            <currency><?=$currency?></currency>
            <exponent>2</exponent>
        </account-amount>
    </purchase>
</payment-avail-response>
<?
}
else
{   
  if(!!$error || $_REQUEST['result_code']!=1){
    ?>
<register-payment-response>
  <result>
     <code>2</code>     
     <desc><?=$error?:'Temporary unavailable'?></desc>
  </result>
</register-payment-response>
    <?
    return;
  }
  $arFields = array(
    "PS_STATUS" => "Y",
    "PS_STATUS_CODE" => $_REQUEST['result_code'],
    "PS_STATUS_DESCRIPTION" => $_REQUEST['trx_id'],
    "PS_SUM" => $_REQUEST['amount']/100,
    "PS_CURRENCY" => $arOrder['CURRENCY'],
    "PS_RESPONSE_DATE" => date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG))),
  );

  CSaleOrder::PayOrder($arOrder["ID"], "Y");
  CSaleOrder::Update($arOrder["ID"], $arFields);
  CAtollApi::registerOrderPayment($arOrder["ID"]);
?>
<register-payment-response>
  <result>
    <code>1</code>
    <desc>OK</desc>
  </result>
</register-payment-response>
<?
}
?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$arResult = array();

if(!check_bitrix_sessid())
{
  $arResult['error'] = 'Ошибка запроса';
}

if(empty($arResult['error']))
{
  $api = new esplusApi(array(
    'appid' => '40',
    'uid' => 'c4abe6bf-7a57-4e82-8484-c0ca39ca0dc9',
    'key' => 'VyyD|$XVwGdlrh$u#mNDwQxTuSKHaYrQ',
    'channel' => '40',
  ));

  $abonentInfo = $api->GetAbonentInfo($_POST['nlsid']);
  if(!!$abonentInfo['Code'])
  {
    $arResult['error'] = $abonentInfo['Message'];
  }
  else
  {
    $arBillState = $api->GetBillState($_POST['nlsid']);

    if(!!$arBillState['Code'])
    {
      $arResult['error'] = $arBillState['Message'];
    }
    else
    {
      $arResult['message'] = $arBillState['Bill'];
    }
  }
}

echo json_encode($arResult);
?>
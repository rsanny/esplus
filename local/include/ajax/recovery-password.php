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

  $result = $api->RecoveryPassword(trim($_POST['login']));
  $arResult['result'] = $result;

  if(!!$result['Code'])
  {
    $arResult['error'] = $result['Message'];
  }
  else
  {
    $arResult['message'] = $result['Message'];
  }
}

echo json_encode($arResult);
?>
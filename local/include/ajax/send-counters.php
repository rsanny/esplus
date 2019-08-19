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

  $arCounters = $api->GetCountersInfo($_POST['nlsid']);

  if(!!$arCounters['Code'])
  {
    $arResult['error'] = $arCounters['Message'];
  }
  elseif(!empty($arCounters['Counters']))
  {
    foreach($arCounters['Counters'] as $arCounter)
    {
      if($arCounter['Serial'] == $_POST['serial'])
      {
        $id = $arCounter['Id'];
        break;
      }
    }
  }
}

if(!!$id)
{
  $SendRounds = $api->SendRounds($_POST['nlsid'], $id, $_POST['serial'], floatval($_POST['sh1']), floatval($_POST['sh2']));

  if(!!$SendRounds['Code'])
  {
    $arResult['error'] = $SendRounds['Message'];
  }
}
elseif(empty($arResult['error']))
{
  $arResult['error'] = 'Данные счетчика не найдены';
}

if(empty($arResult['error']))
{
  $arResult['message'] = 'Показания успешно переданы';
}

echo json_encode($arResult);
?>
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

  $arBillState = $api->GetBillState(trim($_POST['nlsid']));
  $abonentInfo = $api->GetAbonentInfo(trim($_POST['nlsid']));

  if(!!$abonentInfo['Code'])
  {
    $arResult['error'] = $abonentInfo['Message'];
  }
  elseif(!!$arBillState['Code'])
  {
    $arResult['error'] = $arBillState['Message'];
  }
  elseif(CModule::IncludeModule('iblock'))
  {
    $el = new CIBlockElement();

    $arFields = array(
        'IBLOCK_ID' => 32,
        'ACTIVE' => 'Y',
        'NAME' => 'Онлайн оплата по л/с '.trim($_POST['nlsid']).' от '.date('d.m.Y'),
        'PROPERTY_VALUES' => array(
            'NLSID' => trim($_POST['nlsid']),
            'PHONE' => trim($_POST['phone']),
            'EMAIL' => trim($_POST['email']),
            'SUMMA' => $_POST['summa']
        )
    );

    $BILL_ID = $el->Add($arFields);

    $arPayment = $api->MakePayment(trim($_POST['nlsid']),$_POST['summa']*100,$BILL_ID,trim($_POST['email']),trim($_POST['phone']));

    if(!!$arPayment['Code'])
    {
      $arResult['error'] = $arPayment['Message'];
    }
    else
    {
      $arResult['bill_id'] = $BILL_ID;
      $arResult['url'] = $arPayment['RedirectUrl'];
    }
  }
}

echo json_encode($arResult);
?>
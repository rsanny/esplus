<?
// используем класс для определения региона
use OptimalGroup\Core;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$arResult = array();

// определяем текущий регион
$OptimalGroup = Core::Settings();
// запрет на использование метода
$allowMethod = false;
// список доменов разрешенные для метода
$availableDomains = array('kirov', 'oren');

// если не получилось инициировать определение поддоменов
if (empty($OptimalGroup)) {

    // обрезаем из адреса поддомен
    $domain = explode('.', $_SERVER['HTTP_HOST'])[0];

    if (in_array($domain, $availableDomains)) {
        $allowMethod = true;
    }

} // проверяем по определенному поддомену
else {

    if (in_array($OptimalGroup['DOMAIN'], $availableDomains)) {
        $allowMethod = true;
    }

}

if (!check_bitrix_sessid()) {
    $arResult['error'] = 'Ошибка запроса';
}

if (empty($arResult['error'])) {
    $api = new esplusApi(array(
        'appid' => '40',
        'uid' => 'c4abe6bf-7a57-4e82-8484-c0ca39ca0dc9',
        'key' => 'VyyD|$XVwGdlrh$u#mNDwQxTuSKHaYrQ',
        'channel' => '40',
    ));

    $arResult['arBillState'] = $arBillState = $api->GetBillState(trim($_POST['nlsid']));
    $arResult['abonentInfo'] = $abonentInfo = $api->GetAbonentInfo(trim($_POST['nlsid']));

    // проверка для вывода метода на филиалах
    if ($allowMethod) {
        $arResult['list_payment'] = $api->GetListPaymentSplitter(trim($_POST['nlsid']));
    }

    if (isset($_POST['STEP1'])) {
        if (!!$abonentInfo['Code']) {
            $arResult['error'] = $abonentInfo['Message'];
        } elseif (!!$arBillState['Code']) {
            $arResult['error'] = $arBillState['Message'];
        }
        exit(json_encode($arResult));
    }

    if (!!$abonentInfo['Code']) {
        $arResult['error'] = $abonentInfo['Message'];
    } elseif (!!$arBillState['Code']) {
        $arResult['error'] = $arBillState['Message'];
    } elseif (CModule::IncludeModule('iblock')) {
        $el = new CIBlockElement();

        $arFields = array(
            'IBLOCK_ID' => 32,
            'ACTIVE' => 'Y',
            'NAME' => 'Онлайн оплата по л/с ' . trim($_POST['nlsid']) . ' от ' . date('d.m.Y'),
            'PROPERTY_VALUES' => array(
                'NLSID' => trim($_POST['nlsid']),
                'PHONE' => trim($_POST['phone']),
                'EMAIL' => trim($_POST['email']),
                'SUMMA' => $_POST['summa']
            )
        );

        $BILL_ID = $el->Add($arFields);

        if (isset($_POST['STEP1']) || $_POST['MakePaymentSplitter']) {
            $arPayment = $api->MakePaymentSplitter(trim($_POST['nlsid']), $_POST['summa'] * 100, $BILL_ID, trim($_POST['email']), trim($_POST['phone']), $_POST['jsonMakePaymentSplitter']);
            $arResult['voooooot'] = $arPayment;
        } else {
            $arPayment = $api->MakePayment(trim($_POST['nlsid']), $_POST['summa'] * 100, $BILL_ID, trim($_POST['email']), trim($_POST['phone']));
        }

        if (!!$arPayment['Code']) {
            $arResult['error'] = $arPayment['Message'];
        } else {
            $arResult['bill_id'] = $BILL_ID;
            $arResult['url'] = $arPayment['RedirectUrl'];
        }
    }
}

echo json_encode($arResult);
?>
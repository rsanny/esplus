<?
ini_set('max_execution_time', 30);
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$arResult = array();

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

    $abonentInfo = $api->GetAbonentInfo(trim($_POST['nlsid']));
    if (!!$abonentInfo['Code']) {
        $arResult['error'] = $abonentInfo['Message'];
    } else {
        $arCounters = $api->GetCountersInfo(trim($_POST['nlsid']));

        if (empty($arCounters['Counters'])) {
            $arResult['error'] = "По данному лицевому счету нет приборов учета";
        }

        if (!!$arCounters['Code']) {
            $arResult['error'] = $arCounters['Message'];
        } elseif (!empty($arCounters['Counters'])) {
            if ($_POST['get_counters'] == 'Y') {
                $arResult['counters'] = $arCounters['Counters'];
                $arResult['message'] = 'Введите показания счетчиков';
            }

            foreach ($arCounters['Counters'] as $arCounter) {
                $counterIds[$arCounter['Serial']] = $arCounter['Id'];
                /*if($arCounter['Serial'] == $_POST['serial'])
                {
                  $id = $arCounter['Id'];
                  break;
                }*/
            }
        }
    }
}

if (!!($_POST['counter'])) {
    foreach ($_POST['counters'] as $serial => $counter) {
        if ($serial != $_POST['counter']) {
            continue;
        }

        $arResult['counter'] = $_POST['counter'];

        $SendRounds = $api->SendRounds(trim($_POST['nlsid']), $counterIds[$serial], $serial, floatval($counter['Sh1']), floatval($counter['Sh2']));

        if (!!$SendRounds['Code']) {
            $arResult['error'] = $SendRounds['Message'];
        }
    }

    if (empty($arResult['error'])) {
        $arResult['message'] = 'Показания успешно переданы';
    }
}

echo json_encode($arResult);
?>

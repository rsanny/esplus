<?
$_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__).'/../../');

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

CModule::IncludeModule('sale');

$rs = CSaleOrder::GetList(
    array(
        'ID' => 'DESC',
    ),
    array(
        'PAY_SYSTEM_ID' => 4,
        '!PS_STATUS_DESCRIPTION' => false,
        //'PS_STATUS' => '',
        //'!PAYED' => 'Y'
    ),
    false,
    false,
    array(
        'NAME',
        'PS_STATUS_DESCRIPTION',
        'PS_STATUS',
        'PS_STATUS_CODE',
        'PS_RESPONSE_DATE',
        'PAYED',
    )
);

while ($ar = $rs->Fetch()) {
    $trx_id = $ar['PS_STATUS_DESCRIPTION'];

    $url = 'https://www.pps.gazprombank.ru/merchantapi/reconciliation';

    $data = array(
        'merch_id' => '7D8EB98FED4BC3C7CF3B7B25DF33DEBD',
        'merchant_transactions' => array(
            array(
                'trx_id' => $trx_id
            )
        )
    );
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data)
        )
    );
    $context  = stream_context_create($options);

    echo "<pre>";
    echo($result);
    echo "</pre>";
    die();
}

/*
use Bitrix\Main\Loader;
use Bitrix\Sale\Order;

Loader::includeModule('sale');

$rs = Order::getList(array(
    'filter' => array(
        'PAY_SYSTEM_ID' => 4
    ),
    'select' => array(
        '*',
        'PS_STATUS_DESCRIPTION'
    )
));


while($ar = $rs->fetch())
{
    echo "<pre>";
    print_r($ar);
    echo "</pre>";
}*/
?>
<?
class CAtollApi
{
    private static $login = 'esplus-ru';
    private static $pass = 'ytFUu6GET';
    private static $group_code = 'esplus-ru_3897';
    private static $api_version = 'v4';
    private static $inn = '5612042824';
    private static $token = '';
    private static $payment_address = 'esplus.ru';
    
    /*TEST WORK*/
    /*
    private static $login = 'v3-online-atol-ru';
    private static $pass = 'ejc5iyl4g';
    private static $group_code = 'v3-online-atol-ru_4178';
    private static $api_version = 'v3';
    private static $inn = '5544332219';
    private static $token = '';
    private static $payment_address = 'shop.esplus.ru';
    */
    /**/
    /*private static $login = 'atoltest1';
    private static $pass = 'IOtiThGTL';
    private static $group_code = 'ATOL-ProdTest-1';
    private static $api_version = 'v3';
    private static $inn = '112233445573';
    private static $token = '';
    private static $payment_address = 'shop.esplus.ru';*/

    private function getToken()
    {
        $arToken = self::makeRequest('getToken', array(
            'login' => self::$login,
            'pass' => self::$pass
        ));

        self::$token = $arToken['token'];
    }

    private function makeRequest($method,$data)
    {
        $url = 'https://online.atol.ru/possystem/'.self::$api_version.'/'.$method;
//        $url = 'https://testonline.atol.ru/possystem/'.self::$api_version.'/'.$method;

        $myCurl = curl_init();
        curl_setopt_array($myCurl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data)
        ));
        $result = curl_exec($myCurl);
        curl_close($myCurl);

        return json_decode($result, true);
    }

    function register($operation, $data)
    {
        self::getToken();
        $method = self::$group_code.'/'.$operation.'?tokenid='.self::$token;
        $arResult = self::makeRequest($method, $data);
        return $arResult;
    }

    function registerOrderPayment($orderID)
    {
        \Bitrix\Main\Loader::includeModule("sale");

        $order = \Bitrix\Sale\Order::load($orderID);

        if($order->isPaid())
        {
            $propertyCollection = $order->getPropertyCollection();
            $basket = $order->getBasket();

            $arItems = array();

            foreach ($basket as $basketItem) {
                $arItems[] = array(
                    'name' => $basketItem->getField('NAME'),
                    'price' => round($basketItem->getPrice(),2),
                    'quantity' => $basketItem->getQuantity(),
                    'sum' => round($basketItem->getFinalPrice(),2),
                    'tax' => 'vat18',
                    //'tax_sum' => 0
                );
            }

            $arOperation = array(
                'external_id' => 'order_'.$orderID,
                'receipt' => array(
                    'attributes' => array(
                        'email' => $propertyCollection->getUserEmail()->getValue(),
                        //'phone' => '',
                        'sno' => 'osn'
                    ),
                    'items' => $arItems,
                    'payments' => array(
                        array(
                            'sum' => round($order->getSumPaid(),2),
                            'type' => 1
                        )
                    ),
                    'total' => round($order->getPrice(),2)
                ),
                'service' => array(
                    'callback_url' => 'https://shop.esplus.ru/test/atol_callback.php',
                    'inn' => self::$inn,
                    'payment_address' => self::$payment_address
                ),
                'timestamp' => $order->getField('DATE_PAYED')->format('d.m.Y H:i:s')
            );

            $res = self::register('sell', $arOperation);

            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/upload/log_atol.txt', date('d.m.Y H:i:s')."\n".print_r($res, true)."\n", FILE_APPEND);

            return $res;
        }
    }

    function checkOperation($operationID)
    {
        self::getToken();
        $method = self::$group_code.'/report/'.$operationID.'?tokenid='.self::$token;
        //$url = 'https://online.atol.ru/possystem/'.self::$api_version.'/'.$method;
        $url = 'https://testonline.atol.ru/possystem/'.self::$api_version.'/'.$method;
        $res = file_get_contents($url);
        return json_decode($res, true);
    }

    private function registerPayment($paymentID)
    {
        \Bitrix\Main\Loader::includeModule("sale");

        $arPayment = \Bitrix\Sale\Payment::getList(array(
            'filter' => array('ID' => $paymentID)
        ))->fetch();

        if($arPayment['PAID'] == 'Y')
        {
            $order = \Bitrix\Sale\Order::load($arPayment['ORDER_ID']);
            $propertyCollection = $order->getPropertyCollection();
            $basket = $order->getBasket();

            $arItems = array();

            foreach ($basket as $basketItem) {
                $arItems[] = array(
                    'name' => $basketItem->getField('NAME'),
                    'price' => round($basketItem->getPrice(),2),
                    'quantity' => $basketItem->getQuantity(),
                    'sum' => round($basketItem->getFinalPrice(),2),
                    'tax' => 'vat18',
                    //'tax_sum' => 0
                );
            }

            $arOperation = array(
                'external_id' => $paymentID,
                'receipt' => array(
                    'attributes' => array(
                        'email' => $propertyCollection->getUserEmail()->getValue(),
                        //'phone' => '',
                        'sno' => 'osn'
                    ),
                    'items' => $arItems,
                    'payments' => array(
                        array(
                            'sum' => round($arPayment['SUM'],2),
                            'type' => 1
                        )
                    ),
                    'total' => round($order->getPrice(),2)
                ),
                'service' => array(
                    'callback_url' => 'https://shop.esplus.ru/test/atol_callback.php',
                    'inn' => self::$inn,
                    'payment_address' => self::$payment_address
                ),
                'timestamp' => $arPayment['DATE_PAID']->format('d.m.Y H:i:s')
            );

            $res = self::register('sell', $arOperation);
/*
            echo "<pre>";
            print_r($arOperation);
            echo "</pre>";*/
        }
    }
}
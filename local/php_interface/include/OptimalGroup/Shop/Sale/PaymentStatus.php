<?
namespace OptimalGroup;
global $eventManager;
$eventManager->AddEventHandler("sale", "OnOrderStatusSendEmail", "\OptimalGroup\PaymentStatus::Changed");
class PaymentStatus {
    function getOrderInfo($id){
        $order = \Bitrix\Sale\Order::load($id);
        $propertyCollection = $order->getPropertyCollection();
        $arOrderProps = $propertyCollection->getArray();
        $arMoreFields = array(
            'USER_ID' => $order->getUserId(),
            'DESCRIPTION' => $order->getField("USER_DESCRIPTION"),
            'USER_NAME' => $propertyCollection->getPayerName()->getValue(),
            'USER_EMAIL' => $propertyCollection->getUserEmail()->getValue(),
            'USER_PHONE' => $propertyCollection->getPhone()->getValue(),
            'STORE_ID' => $order->getField('STORE_ID'),
            'PRICE' => $order->getPrice() .' руб.'

        );
        $shipmentCollection = $order->getShipmentCollection();
        foreach ($shipmentCollection as $shipment)
        {
            if (!$shipment->isSystem()){
                $arMoreFields['DELIVERY_NAME'] = $shipment->getDeliveryName();
                $arMoreFields['STORE_ID'] = $shipment->getStoreId();
                $dbList = \CCatalogStore::GetList(array(), array("ACTIVE" => "Y", "ID" => $shipment->getStoreId()), false, false,array("ID", "TITLE"));
                while ($arStoreTmp = $dbList->Fetch())
                {
                    $arMoreFields['STORE_NAME'] = $arStoreTmp['TITLE'];
                }
                break;
            }
        }
        $paymentCollection = $order->getPaymentCollection();
        foreach ($paymentCollection as $payment) {
            $psName = $payment->getPaymentSystemName();
            $arMoreFields['PAYMENT_NAME'] = $psName;
        }
        \CModule::IncludeModule("iblock");
        foreach ($arOrderProps['properties'] as $arOrderProp){
            if ($arOrderProp['CODE'] == "REGION"){
                $arSelect = Array("ID", "NAME", "IBLOCK_ID","PROPERTY_E_SHOP");
                $arFilter = Array("IBLOCK_ID" => BRANCH_IBLOCK, "ACTIVE"=>"Y", "PROPERTY_REGION" => reset($arOrderProp['VALUE']));
                $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
                while ($rsResult = $res->GetNext()) {
                    $arMoreFields['EMAIL_SEND'] = $rsResult['PROPERTY_E_SHOP_VALUE'];
                }
            }
        }

        $arMoreFields['ORDER_LIST'] = [];
        $basket = $order->getBasket();
        $basketItems = $basket->getBasketItems();
        foreach ($basketItems as $item){
            $arMoreFields['ORDER_LIST'][] = $item->getField('NAME') . ' - '. $item->getQuantity() . ' шт. x '. $item->getPrice().' руб.';
        }
        $arMoreFields['ORDER_LIST'] = implode('<br>',$arMoreFields['ORDER_LIST']);
        return $arMoreFields;
    }
    function Changed($ID, &$eventName, &$arFields, $val){
        global $USER;
        if ($val == "CH"){
            \CModule::IncludeModule("sale");
            $orderObj = \Bitrix\Sale\Order::load($ID);
            $paymentCollection = $orderObj->getPaymentCollection();
            $payment = $paymentCollection[0];
            $service = \Bitrix\Sale\PaySystem\Manager::getObjectById($payment->getPaymentSystemId());
            $initResult = $service->initiatePay($payment, null, \Bitrix\Sale\PaySystem\BaseServiceHandler::STRING);
            
            $arFields['PAY_LINK'] = str_replace('class="btn btn-orange"','class="btn"',$initResult->getTemplate());
            $arMoreFields = self::getOrderInfo($ID);
            $arFields = array_merge($arMoreFields,$arFields);
        }
        if ($val == "OK"){
            $arMoreFields = self::getOrderInfo($ID);
            $arFields = array_merge($arMoreFields,$arFields);
        }
    }
}
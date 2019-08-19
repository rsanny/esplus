<?
$eventManager->addEventHandler("sale", "OnOrderNewSendEmail", array("OrderMail","updateFieldsForMail"));
$eventManager->addEventHandler("sale", "OnOrderPaySendEmail", array("OrderMail","updateFieldsForMail"));
$eventManager->addEventHandler("sale", "OnOrderCancelSendEmail", array("OrderMail","updateFieldsForMail"));
$eventManager->addEventHandler("sale", "OnOrderStatusSendEmail", array("OrderMail","updateFieldForStatus"));
AddEventHandler('main', 'OnBeforeMailSend', Array("OrderMail", "makeStyleInline"));
class OrderMail {
    public function parseCss($css){
        preg_match_all( '/(?ims)([a-z0-9\s\.\:#_\-@,]+)\{([^\}]*)\}/', $css, $arr);
        $result = array();
        foreach ($arr[0] as $i => $x){
            $selector = trim($arr[1][$i]);
            $rules = explode(';', trim($arr[2][$i]));
            $rules_arr = [];
            $rulseText = "";
            foreach ($rules as $strRule){
                if (!empty($strRule)){
                    $rule = explode(":", $strRule);
                    $rules_arr[trim($rule[0])] = trim($rule[1]);
                    $rulseText .= trim($rule[0]).":".trim($rule[1]).";";
                }
            }

            $selectors = explode(',', trim($selector));
            foreach ($selectors as $strSel){
                $result[$strSel] = $rulseText;
            }
        }
        return $result;
    }
    public function makeStyleInline($arTemplate)
    {   
        global $USER;
        $document = $arTemplate['BODY'];
        $html = "";
        preg_match("'<style type=\"text/css\">(.*?)</style>'si", $document, $matches);
        if ($matches[1]){
            $style = self::parseCss($matches[1]);
            foreach ($style as $class => $styles){
                $isClass = explode('.',$class);
                if ($isClass[0] == 0){
                    preg_match_all("<.*class=\"".$isClass[1]."\".*style=\"(.*)\".*>", $document, $matchByClassWithAttr);// 
                    $class = 'class="'.$isClass[1].'"';
                    if (!empty($matchByClassWithAttr[0])){
                        foreach ($matchByClassWithAttr[0] as $k => $matchByClassWithAttr){
                            $changedAttr = str_replace(['class="'.$isClass[1].'"', 'style="'], ['','style="'.$styles.';'], $matchByClassWithAttr);
                         //$matchesClass   
                            $document = str_replace($matchByClassWithAttr, $changedAttr, $document);
                        }
                        $document = str_replace($class, 'style="'.$styles.'"', $document);
                    }
                    else {
                        $document = str_replace($class, 'style="'.$styles.'"', $document);
                    }
                }
            }
            $arTemplate['BODY'] = $document;
            //echo $arTemplate['BODY'];
        }
        //die();
        return $arTemplate;
    }
    public function GetMoreFields($orderID){
        global $USER;
        $order = \Bitrix\Sale\Order::load($orderID);
        $propertyCollection = $order->getPropertyCollection();
        $arProperty = $propertyCollection->getArray();
        $basket = $order->getBasket();
        $basketItems = $basket->getBasketItems();
        $serverName = $_SERVER['HTTP_ORIGIN'];


        $arMoreFields = array(
            'USER_ID' => $order->getUserId(),
            'DESCRIPTION' => $order->getField("USER_DESCRIPTION"),
            'EMAIL' => $propertyCollection->getUserEmail()->getValue(),
            'PHONE' => $propertyCollection->getPhone()->getValue(),
            'STORE_ID' => $order->getField('STORE_ID'),
            'PRICE' => $order->getPrice(),
            'USER_NAME' => $propertyCollection->getPayerName()->getValue(),
            'ORDER_USER' => $propertyCollection->getPayerName()->getValue()

        );
        $arOrderProp =
        $arOrderItems =
        $arProductId = [];

        foreach ($basketItems as $basketItem) {
            $arBasketItem = $basketItem->getFieldValues();
            $arProductId[] = $arBasketItem['PRODUCT_ID'];
            $arOrderItems[$arBasketItem['PRODUCT_ID']] = [
                'ID' => $arBasketItem['ID'],
                'NAME' => $arBasketItem['NAME'],
                'DETAIL_PAGE_URL' => $arBasketItem['DETAIL_PAGE_URL'],
                'QUANTITY' => number_format($arBasketItem['QUANTITY'], 0, "",""),
                'PRODUCT_ID' => $arBasketItem['PRODUCT_ID'],
                'PRICE' => $arBasketItem['QUANTITY'] * $arBasketItem['PRICE'],
                'MEASURE' => $arBasketItem['MEASURE_NAME'],

            ];
        }

        if ($arProductId){
            $arItems = \OptimalGroup\Catalog::GetItemsForBasket($arProductId, $serverName);
            $arMoreFields['USER_ORDER_LIST'] = '<table cellpadding="0" cellspacing="0" border="0" width="500">';
            foreach ($arItems as $arItem){
                $basketItem = $arOrderItems[$arItem['ID']];
                $arMoreFields['USER_ORDER_LIST'] .= '<tr valign="middle">
                    <td style="padding: 10px 0 10px; border-bottom: 1px solid #f15922; text-align:center;" width="120" nowrap><img src="'.$arItem['IMAGE'].'" alt="'.$arItem['NAME'].'" height="90"></td>
                    <td style="padding: 10px 15px 10px; border-bottom: 1px solid #f15922;" width="100%">'.$arItem['NAME'].'</td>
                    <td style="padding: 10px 15px 10px; border-bottom: 1px solid #f15922; font-size: 12px;" nowrap>'.$basketItem['QUANTITY'].' '.$basketItem['MEASURE'].'</td>
                    <td style="padding: 10px 0 10px 15px; border-bottom: 1px solid #f15922; font-size: 16px;" nowrap>'. number_format($basketItem['PRICE'], 2, '.', ' ') . ' руб.</td>
                </tr>';
            }
            $arMoreFields['USER_ORDER_LIST'] .= '</table>';
        }

        $shipmentCollection = $order->getShipmentCollection();
        foreach ($shipmentCollection as $shipment)
        {
            if (!$shipment->isSystem()){
                $arResult['STOCKS'] = \OptimalGroup\Catalog::GetStock("all");
                $arMoreFields['DELIVERY_NAME'] = $shipment->getDeliveryName();
                $arMoreFields['STORE_ID'] = $shipment->getStoreId();
                $dbList = CCatalogStore::GetList(array(), array("ACTIVE" => "Y", "ID" => $shipment->getStoreId()), false, false,array("ID", "TITLE", "UF_CONTACTS"));
                while ($arStoreTmp = $dbList->Fetch())
                {                
                    $arFilter = Array("IBLOCK_ID"=>OFFICE_IBLOCK, "ACTIVE"=>"Y", "ID" => $arStoreTmp['UF_CONTACTS']);
                    $rs = \CIBlockElement::GetList([], $arFilter, false, false, ['ID', 'CODE', 'PROPERTY_ADDRESS']);
                    while ($rsResult = $rs->GetNext()) { 
                        $arMoreFields['STORE_ADDRESS'] = $rsResult['PROPERTY_ADDRESS_VALUE'];
                    }
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
        $arMoreFields['NO_IN_STORE_THEME'] = "!";
        $arMoreFields['NO_IN_STORE'] = "";
        $arMoreFields['BRANCH_EMAIL'] = $_SESSION['BXExtra']['REGION']['IBLOCK']['E_SHOP'];
        $arMoreFields['BRANCH'] = $_SESSION['BXExtra']['REGION']['IBLOCK']['NAME'];
        $arMoreFields['BRANCH_THEME'] = $_SESSION['BXExtra']['REGION']['IBLOCK']['REGION'];
        if ($arMoreFields['STORE_ID'] == 0){
            $arMoreFields['NO_IN_STORE_THEME'] = "!НЕТ В НАЛИЧИИ!";
            $arMoreFields['NO_IN_STORE'] = '<div style="color:#f05b25; font-size:20px; padding:20px 0;">!!!НЕ ВСЕ ТОВАРЫ ЕСТЬ В НАЛИЧИИ!!!</div>';
        }

        foreach ($arProperty['properties'] as $property){
            $value = reset($property['VALUE']);
            if ($value && $value != "-"){
                $arOrderProp[$property['CODE']] = [
                    'NAME' => $property['NAME'],
                    'VALUE' => $value
                ];
                $arMoreFields[$property['CODE']] = $value;
            }
        }
        if ($arMoreFields['REGION']){
            $arSelect = Array("ID", "NAME", "IBLOCK_ID","PROPERTY_E_SHOP");
            $arFilter = Array("IBLOCK_ID" => BRANCH_IBLOCK, "ACTIVE"=>"Y", "PROPERTY_REGION" => $arMoreFields['REGION']);
            $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
            while ($rsResult = $res->GetNext()) {
                $arMoreFields['BRANCH_EMAIL'] = $rsResult['PROPERTY_E_SHOP_VALUE'];
                $arMoreFields['BRANCH'] = $rsResult['NAME'];
                $arMoreFields['BRANCH_THEME'] = $arMoreFields['REGION'];
            }
        };
        
        $mailPropTable = '<table cellpadding="0" cellspacing="0" border="0">';
        $mailPropTable .= '<tr valign="top">
            <td style="padding:0 10px 20px 0; color:#f15922" width="170">Получатель</td>
            <td style="padding-bottom:10px">'.$arOrderProp['NAME']['VALUE'].'<br><a href="mailto:'.$arOrderProp['EMAIL']['VALUE'].'" class="color-orange">'.$arOrderProp['EMAIL']['VALUE'].'</a><br>'.$arOrderProp['PHONE']['VALUE'].'</td>
        </tr>';
        if ($arOrderProp['ADDRESS']['VALUE'])
            $mailPropTable .= '<tr valign="top"><td style="padding:0 10px 10px 0; color:#f15922" width="170">Адрес получателя</td><td style="padding-bottom:10px">'.$arOrderProp['ADDRESS']['VALUE'].'</td></tr>';
        if ($arOrderProp['PERSONAL']['VALUE'])
            $mailPropTable .= '<tr valign="top"><td style="padding:0 10px 10px 0; color:#f15922" width="170">Лицевой счет</td><td style="padding-bottom:10px">'.$arOrderProp['PERSONAL']['VALUE'].'</td></tr>';
        if ($arOrderProp['REGION']['VALUE'])
            $mailPropTable .= '<tr valign="top"><td style="padding:0 10px 10px 0; color:#f15922" width="170">Регион</td><td style="padding-bottom:10px">'.$arOrderProp['REGION']['VALUE'].'</td></tr>';

        $mailPropTable .= '<tr valign="top">
            <td style="padding:0 10px 10px 0; color:#f15922" width="170">Ближайший офис<br>самовывоза и/или<br>приема платежей</td><td style="padding-bottom:10px">Офис ЭнергосбыТ Плюс:<br>'.$arMoreFields['STORE_ADDRESS'].'<br><a href="'.$serverName.'/offices/" class="color-orange">Часы работы и как добраться</a></td>
        </tr>';
        if ($arMoreFields['PAYMENT_NAME'])
            $mailPropTable .= '<tr valign="top"><td style="padding:0 10px 10px 0; color:#f15922" width="170">Способ оплаты</td><td style="padding-bottom:10px">'.$arMoreFields['PAYMENT_NAME'].'</td></tr>';

        if ($arMoreFields['DESCRIPTION'])
            $mailPropTable .= '<tr valign="top"><td style="padding:0 10px 20px 0; color:#f15922" width="170">Комментарий к заказу</td><td style="padding-bottom:20px">'.$arMoreFields['DESCRIPTION'].'</td></tr>';

        $mailPropTable .= '<tr valign=""middle>
            <td style="padding:0 10px 10px 0; color:#f15922" width="170">К оплате</td><td style="padding-bottom:10px"><div style="font-size: 30px;color:#f15922">' . $arMoreFields['PRICE'] . ' руб.</div></td>
        </tr>    
        </table>';

        $arMoreFields['USER_PROPS'] = $mailPropTable;
        
        return $arMoreFields;
    }
    public function updateFieldForStatus($orderID, &$eventName, &$arFields, $val){
        global $APPLICATION, $USER;
        $APPLICATION->RestartBuffer(); 
        if (!$orderID)
            $orderID = $arFields['ORDER_ID'];
        $arMoreFields = self::GetMoreFields($orderID);
        $arFields = array_merge($arMoreFields,$arFields);
        /*if ($USER->GetID() == 1){
            pr($arFields);
            die();
        }*/
        
    }
    public function updateFieldsForMail($orderID, &$eventName, &$arFields){
        global $APPLICATION, $USER;
        $APPLICATION->RestartBuffer();    
        
        $arMoreFields = self::GetMoreFields($orderID);
        
        $arFields = array_merge($arMoreFields,$arFields);
        /*if ($USER->GetID() == 1){
            pr($arFields);
            die();
        }*/
    }
}
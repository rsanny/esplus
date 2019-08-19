<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);
if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}

}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
        echo FormatHelper::Error(implode("<br>",$arResult['ERRORS']['NONFATAL']));
	}
	if (!count($arResult['ORDERS']))
	{
		?>
        <div class="z3">Текущие заказы не найдены</div>
		<div class="row col-md-12 col-sm-12">
			<a href="<?=htmlspecialcharsbx($arParams['PATH_TO_CATALOG'])?>" class="sale-order-history-link">Перейти в каталог</a>
		</div>
		<?
	} 
    else{
    ?>
    <div class="table-overflow">
        <table class="table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Дата</th>
                    <th>Статус</th>
                    <th>Сумма</th>
                    <th>Доставка</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <? 
            foreach ($arResult['ORDERS'] as $key => $order):
            $payment = reset($order['PAYMENT']);
            $shipment = reset($order['SHIPMENT']);      
            $arItem = $order['ORDER'];

            if(!empty($arItem['PAY_SYSTEM_ID'])){
                if (intval($payment["PAY_SYSTEM_ID"]))
                {
                    $payment["PAY_SYSTEM"] = \Bitrix\Sale\PaySystem\Manager::getById($payment["PAY_SYSTEM_ID"]);
                    $payment["PAY_SYSTEM"]['NAME'] = htmlspecialcharsbx($payment["PAY_SYSTEM"]['NAME']);
                }
                if ($arItem['PAYED'] == 'N' && $arItem['CANCELED'] == 'N')
                {
                    $payment['BUFFERED_OUTPUT'] = '';
                    $payment['ERROR'] = '';
                    $service = new \Bitrix\Sale\PaySystem\Service($payment["PAY_SYSTEM"]);
                    if ($service)
                    {
                        $payment["CAN_REPAY"] = "Y";
                        if ($service->getField("NEW_WINDOW") == "Y")
                        {
                            $payment["PAY_SYSTEM"]["PSA_ACTION_FILE"] = htmlspecialcharsbx("PATH_TO_PAYMENT").'?ORDER_ID='.urlencode(urlencode($arItem['ACCOUNT_NUMBER'])).'&PAYMENT_ID='.$payment['ID'];
                        }
                        else
                        {
                            CSalePaySystemAction::InitParamArrays($arItem, $arItem["ID"], '', array(), $payment);
 
                            $handlerFolder = \Bitrix\Sale\PaySystem\Manager::getPathToHandlerFolder($service->getField('ACTION_FILE'));
                            $pathToAction = \Bitrix\Main\Application::getDocumentRoot().$handlerFolder;
                            $pathToAction = str_replace("\\", "/", $pathToAction);
                            while (substr($pathToAction, strlen($pathToAction) - 1, 1) == "/")
                                $pathToAction = substr($pathToAction, 0, strlen($pathToAction) - 1);
                            if (file_exists($pathToAction))
                            {
                                if (is_dir($pathToAction) && file_exists($pathToAction."/payment.php"))
                                    $pathToAction .= "/payment.php";
                                $payment["PAY_SYSTEM"]["PSA_ACTION_FILE"] = $pathToAction;
                            }
 
                            $encoding = $service->getField("ENCODING");
                            if (strlen($encoding) > 0)
                            {
                                define("BX_SALE_ENCODING", $encoding);
                                AddEventHandler("main", "OnEndBufferContent", array($this, "changeBodyEncoding"));
                            }
                            /** @var \Bitrix\Sale\Order $order */
                            $oborder = \Bitrix\Sale\Order::load($arItem["ID"]);
 
                            if ($oborder)
                            {
                                /** @var \Bitrix\Sale\PaymentCollection $paymentCollection */
                                $paymentCollection = $oborder->getPaymentCollection();
                                if ($paymentCollection)
                                {
                                    /** @var \Bitrix\Sale\Payment $paymentItem */
                                    $paymentItem = $paymentCollection->getItemById($payment['ID']);
                                    if ($paymentItem)
                                    {
                                        $initResult = $service->initiatePay($paymentItem, null, \Bitrix\Sale\PaySystem\BaseServiceHandler::STRING);
                                        if ($initResult->isSuccess())
                                            $payment['BUFFERED_OUTPUT'] = $initResult->getTemplate();
                                        else
                                            $payment['ERROR'] = implode('\n', $initResult->getErrorMessages());
                                    }
                                }
                            }
                        }
                    }
                }
                $arResult['PAYMENT_SYSTEM'][$arItem['ID']][] = $payment;
            }

            if(!!$payment['BUFFERED_OUTPUT'] && $payment['PAY_SYSTEM_ID']==4)
            {
                if(preg_match('/href="([^"]+)"/', $payment['BUFFERED_OUTPUT'], $match))
                {
                    $payment['URL_TO_PAY'] = $match[1];
                }
            }
            ?>
                <tr>
                    <td valign="middle"><?=$order['ORDER']['ACCOUNT_NUMBER'];?></td>
                    <td valign="middle"><?=$order['ORDER']['DATE_INSERT']->format($arParams['ACTIVE_DATE_FORMAT'])?></td>
                    <td valign="middle">
                    <?
                    if ($payment['PAID'] === 'Y')
                    {
                        ?>
                        <span class="sale-order-list-status-success">Оплачен</span>
                        <?
                    } elseif ($order['ORDER']['STATUS_ID'] == 'CA')
                    {
                        ?>
                        <span class="sale-order-list-status-restricted">Отменен</span>
                        <?
                    }
                    elseif ($order['ORDER']['STATUS_ID'] == 'CH')
                    {
                        ?>
                        <span class="sale-order-list-status-restricted">Ожидание оплаты</span>
                        <?
                    }
                    else
                    {
                        ?>
                        <span class="sale-order-list-status-alert">Принят, ожидается оплата</span>
                        <?
                    }
                    ?></td>
                    <td valign="middle"><?=$order['ORDER']['FORMATED_PRICE']?></td>
                    <td valign="middle">
                        <img src="<?=MEDIA_PATH;?>icons/icon-location.png" alt=""> <?=$shipment['DELIVERY_NAME'];?>
                    </td>
                    <td valign="middle">
                        <? if($order['ORDER']['PAYED'] == 'N' && $order['ORDER']['STATUS_ID'] != 'CA'):?>
                        <? if ($payment['PAY_SYSTEM']['ID'] == 4 && $USER->IsAdmin() && $order['ORDER']['STATUS_ID'] == 'CH'):?>
                        <a href="<?=$payment['URL_TO_PAY']?:$order['PAYMENT'][0]['PSA_ACTION_FILE']?>" class="btn btn-orange btn-small block">Оплатить</a>
                        <? endif;?>
                        <a href="<?=$order['ORDER']['URL_TO_CANCEL']?>" class="btn btn-grey btn-small block">Отменить</a>
                        <? endif?>
                    </td>
                </tr>
            <? endforeach;?>
            </tbody>
        </table>
    </div>
	<?
	echo $arResult["NAV_STRING"];
    }
}
?>

<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc,
    Bitrix\Sale;

/**
 * @var array $arParams
 * @var array $arResult
 * @var $APPLICATION CMain
 */
$order = Sale\Order::loadByAccountNumber($arResult['ORDER_ID']);
$basket = $order->getBasket();
$basketItems = $basket->getBasketItems();
$arSectionId =
$arOrderItems = 
$arProductId = 
$arImages = 
$arService = [];
foreach ($basketItems as $basketItem) {
    $arBasketItem = $basketItem->getFieldValues();
    $arProductId[] = $arBasketItem['PRODUCT_ID'];
    $arOrderItems[$arBasketItem['PRODUCT_ID']] = [
        'ID' => $arBasketItem['ID'],
        'NAME' => $arBasketItem['NAME'],
        'DETAIL_PAGE_URL' => $arBasketItem['DETAIL_PAGE_URL'],
        'QUANTITY' => $arBasketItem['QUANTITY'],
        'PRODUCT_ID' => $arBasketItem['PRODUCT_ID'],
        'PRICE' => $arBasketItem['QUANTITY'] * $arBasketItem['PRICE'],
        'MEASURE' => $arBasketItem['MEASURE_NAME'],
        
    ];
}
if ($arProductId){
    \Bitrix\Main\Loader::includeModule('iblock');    
    $rs = \CIBlockElement::GetList([], ['ID' => $arProductId], false, false, ['ID', 'NAME', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'IBLOCK_SECTION_ID', 'PROPERTY_CML2_MANUFACTURER']);
    while ($rsResult = $rs->GetNext()) {
        $isService = false;
        $nav = CIBlockSection::GetNavChain(false, $rsResult['IBLOCK_SECTION_ID']);
        while($ar_group = $nav->GetNext()){
            if ($ar_group['ID'] == CATALOG_IBLOCK_SERVICE_SECTION)
                $isService = true;
        }
        $img = "";
        if ($rsResult['PREVIEW_PICTURE'])
           $img = $rsResult['PREVIEW_PICTURE'];
        if ($rsResult['DETAIL_PICTURE'])
           $img = $rsResult['DETAIL_PICTURE'];
        
        if ($img)            
            $img = CFile::ResizeImageGet($img, array('width'=>125, 'height'=>125), BX_RESIZE_IMAGE_PROPORTIONAL, false)['src'];
        elseif ($isService)
            $img = MEDIA_PATH . "icons/icon-service-no-photo.jpg";
        else
            $img = MEDIA_PATH . "images/no_image.jpg";
            
        $arImages[$rsResult['ID']] = $img;
        if ($isService)
            $arService[$rsResult['ID']] = $isService;
        
        $arItems[] = $rsResult;
        $arSectionId[] = $rsResult['IBLOCK_SECTION_ID'];        
    }
    $arSectionId = array_unique($arSectionId);
    $arFilter = ['IBLOCK_ID' => $arParams['IBLOCK_ID'], "ID" => $arSectionId];
    $rsSect = CIBlockSection::GetList([],$arFilter);
    while ($arSect = $rsSect->GetNext())
    {
        $arSections[$arSect['ID']] = $arSect['NAME'];
    }
    foreach ($arItems as $k=>$arItem){
        $json[] = [
            "id" => $arItem['ID'],
            "name" => $arItem['NAME'],
            "price" => $arOrderItems[$arItem['ID']]['PRICE'],
            "brand" => $arItem['PROPERTY_CML2_MANUFACTURER_VALUE'],
            "category" => $arSections[$arItem['IBLOCK_SECTION_ID']],
            "quantity" => $arOrderItems[$arItem['ID']]['QUANTITY'],
        ];
    }
}
if ($arParams["SET_TITLE"] == "Y")
{
	$APPLICATION->SetTitle("Спасибо за заказ!");
}
$arPaySystem = reset($arResult['PAY_SYSTEM_LIST']);
?>
<? if (!empty($arResult["ORDER"])): ?>
    <script>
        dataLayer.push({
            "ecommerce": {
                "currencyCode": "RUB",
                "purchase": {
                    "actionField": {
                        "id" : "<?=$arResult["ORDER"]["ACCOUNT_NUMBER"];?>"
                    },
                    "products": <?=json_encode($json);?>
                }
            },
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': 'Purchase',
        });
    </script>
    <div class="fs-24 color-green mb-40"><i class="fa fa-check fs-20"></i>  Ваш заказ оформлен и ожидает подтверждения</div>
    <div class="row">
        <div class="col col-12 col-lg-6 col-md-8">
            <div class="row fs-14 mb-20">
                <div class="col col-12 col-md-4 fs-16 fw-normal">Номер заказа</div>
                <div class="col col-12 col-md-8">
                    <div class="fs-18 color-orange fw-normal">№ <?=$arResult["ORDER"]["ACCOUNT_NUMBER"];?></div>
                </div>
            </div>
            <? if ($arOrderItems):?>
            <div class="order-basket mb-20">
                <? 
                foreach ($arOrderItems as $arItem):
                    $sUrl = $arService[$arItem['PRODUCT_ID']]?'':'href="'.$arItem['DETAIL_PAGE_URL'].'"';
                    $sImg = $arImages[$arItem['PRODUCT_ID']];
                ?>
                <div class="cart-item pl-0">
                    <a <?=$sUrl;?> class="cart-item--img loading-bg"><img src="<?=$sImg;?>" alt="<?=$arItem['NAME'];?>" class="img-responsive"></a>
                    <a <?=$sUrl;?> class="cart-item--name width"><?=$arItem['NAME'];?></a>
                    <div class="cart-item--quantity text-center fs-12"><?=number_format($arItem['QUANTITY'], 0, '', '');?> <?=$arItem['MEASURE'];?></div>
                    <div class="cart-item--price"><div><?=number_format($arItem['PRICE'], 0, '', ' ');?> руб.</div></div>
                </div>
                <? endforeach;?>
            </div>
            <? endif;?>
            <? 
            if ($arResult['ORDER']['ORDER_STORE_ID'] && !$arService):
                $storeId = $arResult['ORDER']['ORDER_STORE_ID'];
                $SelectedStore = $arResult['ORDER']['STORE_LIST'][$storeId];
            ?>
            <div class="row fs-14 mb-20">
                <div class="col col-12 col-md-4 fs-16 fw-normal">Адрес доставки</div>
                <div class="col col-12 col-md-8">
                    Самовывоз: <?=$SelectedStore['CONTACTS']['ADDRESS'];?>
                    <div class="mb-10">
                        <a href="/offices/" target="_blank" class="color-orange">Часы работы и как добраться</a>
                    </div>
                </div>
            </div>
            <? endif;?>
            <? if ($arResult['ORDER']['ORDER_PROPS']):?>
            <div class="row fs-14 mb-20">
                <div class="col col-12 col-md-4 fs-16 fw-normal">Получатель</div>
                <div class="col col-12 col-md-8 lh-24">
                    <? 
                    foreach ($arResult['ORDER']['ORDER_PROPS']['properties'] as $code => $prop):
                        if (
                            reset($prop['VALUE']) == "-" || 
                            empty(reset($prop['VALUE'])) ||
                            $prop['CODE'] == "REGION"
                        )
                            continue;
                        if ($prop['CODE'] == 'PERSONAL') echo 'л/с ';
                        echo reset($prop['VALUE']).'<br>';
                    endforeach;?>
                </div>
            </div>
            <? endif?>
            <div class="row fs-14 mb-40"> 
                <div class="col col-12 col-md-4 fs-16 fw-normal">Способ оплаты</div>
                <div class="col col-12 col-md-8 lh-24"><?=$arPaySystem['PSA_NAME'];?></div>
            </div>
            <hr>
            <div class="row flex-vertical">
                <? if ($arPaySystem == 4):?>
                <div class="col col-12 col-md-4 fw-normal">
                    Оплата онлайн
                </div>
                <? endif;?>
                <? if ($arPaySystem['PAY_SYSTEM_ID'] != 4):?>
                <div class="col col-12 col-md-4 text-right">
                    <?=$arPaySystem["BUFFERED_OUTPUT"]?>
                </div>
                <? else:?>
                <div class="col col-12">
                    <div class="popup-form--text bg-info bg-message">
                        <div class="mb-10 color-orange"><b>Информация</b><i class="icon-info--orange"></i></div>
                        Оплата онлайн будет доступна после подтверждения менеджером.<br>По факту подтверждения Вам будет отправлен e-mail со ссылкой на оплату.
                    </div>
                </div>
                <? endif;?>
            </div>
        </div>
        <div class="col col-12 col-lg-6 col-md-4">
            <div class="row flex-vertical">
                <div class="col col-6 fs-16 fw-normal">К оплате</div>
                <div class="col col-6 text-right">
                    <div class="fs-18 color-orange fw-normal"><?=number_format($arResult['ORDER']['TOTAL_PRICE'],0,'',' ');?> руб</div>
                </div>
                <div class="col col-12 mt-20">
                    <div class="bg-info bg-message">
                        <p>В течение 1 рабочего дня мы позвоним по указанному Вами номеру телефона для подтверждения заказа.</p>
                        <p>Если Вы пропустили звонок: </p>
                        <ul>
                            <li>перезвоните нам <a href="/offices/" class="link-orange--dashed">по телефону</a></li>
                            <li>или оставьте сообщение через <a href="/feedback/" class="link-orange--dashed">форму обратной связи</a>.</li>
                        </ul>
                        <p>Следите за статусом заказа в <a href="/personal/" class="link-orange--dashed">личном кабинете</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
	<? if ($_REQUEST['shop_banner']):?>
    <div class="section-title text-center"><span>Выгодные предложения</span></div>
    <? \Optimalgroup\Template::OfferBanners(array("arSettings" => array("NEWS_COUNT" => 3, "IBLOCK_ID" => 51)));?>
    <? endif;?>
<? else: ?>

	<b><?=Loc::getMessage("SOA_ERROR_ORDER")?></b>
	<br /><br />

	<table class="sale_order_full_table">
		<tr>
			<td>
				<?=Loc::getMessage("SOA_ERROR_ORDER_LOST", array("#ORDER_ID#" => $arResult["ACCOUNT_NUMBER"]))?>
				<?=Loc::getMessage("SOA_ERROR_ORDER_LOST1")?>
			</td>
		</tr>
	</table>

<? endif ?>
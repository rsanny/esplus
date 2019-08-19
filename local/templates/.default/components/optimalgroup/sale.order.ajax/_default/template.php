<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->addExternalCss(MEDIA_PATH."css/page/cart.css");
use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
    \Bitrix\Main\Page\Asset;

/**
 * @var array $arParams
 * @var array $arResult
 * @var $APPLICATION CMain
 * @var $USER CUser
 * @var $component SaleOrderAjax
 */
//pr($arResult);
$context = Main\Application::getInstance()->getContext();
$request = $context->getRequest();
$server = $context->getServer();
$scheme = $request->isHttps() ? 'https' : 'http';
\Bitrix\Sale\PropertyValueCollection::initJs();
if (strlen($request->get('ORDER_ID')) > 0)
{
	include($server->getDocumentRoot().$templateFolder.'/confirm.php');
}
elseif ($arParams['DISABLE_BASKET_REDIRECT'] === 'Y' && $arResult['SHOW_EMPTY_BASKET'])
{
	include($server->getDocumentRoot().$templateFolder.'/empty.php');
}
else
{	
    $this->addExternalJs($templateFolder.'/order_view.js');
    $this->addExternalJs(MEDIA_PATH ."js/optimalgroup/basket.action.js");
    $this->addExternalJs("//api-maps.yandex.ru/2.1/?lang=ru_RU");
    //GetBranchList
    $OptimalGroupCity = new \OptimalGroup\City;
    $arBranchList = $OptimalGroupCity->GetBranchList();
    //pr($arResult,true);
    $lastOrderData = $arResult['USER_VALS']['LAST_ORDER_DATA'];
    $PersonType = $lastOrderData['PERSON_TYPE_ID'];
    $DeliveryId = $lastOrderData['DELIVERY_ID'];
    $PayId = $lastOrderData['PAY_SYSTEM_ID'];
    $FirstStore = reset($arResult['STORE_LIST']);
    $StoreId = $arResult['BUYER_STORE'];
    //pr($arResult);
    if (!$lastOrderData){
        $PersonType = $arResult['USER_VALS']['PERSON_TYPE_ID'];
        $DeliveryId = $arResult['USER_VALS']['DELIVERY_ID'];
        $PayId = $arResult['USER_VALS']['PAY_SYSTEM_ID'];
    }
    if (!$StoreId && $arResult['USER_VALS']['BUYER_STORE'])
        $StoreId = $arResult['USER_VALS']['BUYER_STORE'];
        
    if (empty($PayId)) $PayId = $arResult['USER_VALS']['PAY_SYSTEM_ID'];
    ?>
    <div class="bg-message order-errors bg-danger none"></div>
    <form action="<?=$APPLICATION->GetCurPage();?>" method="POST" name="ORDER_FORM" id="bx-ajax-order" enctype="multipart/form-data">
        <?
        echo bitrix_sessid_post();

        if (strlen($arResult['PREPAY_ADIT_FIELDS']) > 0)
        {
            echo $arResult['PREPAY_ADIT_FIELDS'];
        }
        ?>
        <input type="hidden" name="PERSON_TYPE_ID" value="<?=$PersonType?>">
        <input type="hidden" name="<?=$arParams['ACTION_VARIABLE']?>" value="saveOrderAjax">
        <input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$StoreId?>">
        <div class="cart-page row is-loading">
            <div class="col col-12 col-lg-8 col-xl-6 offset-lg-2 offset-xl-0">
                <div class="cart">
                    <div class="basket-border">
                        <div class="form-legend text-uppercase">Состав заказа</div>
                        <div class="cart-list basket_list">
                            <!--here js-->
                        </div>
                        <div class="cart-total text-right">
                            <span></span>
                            <div><!--here js--></div>
                        </div>
                    <!--/Baset border-->
                    </div>
                <!--/Cart-->
                </div>
                <!--<div class="cart-service--title">Хотите заказать усановку счетчиков в комплекте?</div>
                <div class="cart-service">
                    <div class="cart-list basket-border">

                    </div>
                </div>-->

            </div>
            <div class="col col-12 col-lg-8 col-xl-6 offset-lg-2 offset-xl-0">
                <div class="cart-order">
                    <div class="basket-border">
                        <div class="form-legend clearfix text-uppercase">Оформление заказа</div>
                        <div class="form-group--label">Получатель</div>
                        <?
                        $arFields = array();
                        foreach($arResult['ORDER_PROP']['USER_PROPS_Y'] as $arField){
                            if ($arField['FIELD_ID'] == "ORDER_PROP_NAME") $arFields['NAME'] = $arField;
                            if ($arField['FIELD_ID'] == "ORDER_PROP_EMAIL") $arFields['EMAIL'] = $arField;
                            if ($arField['FIELD_ID'] == "ORDER_PROP_PHONE") $arFields['PHONE'] = $arField;
                            if ($arField['FIELD_ID'] == "ORDER_PROP_REGION") $arFields['REGION'] = $arField;
                            if ($arField['FIELD_ID'] == "ORDER_PROP_ADDRESS") $arFields['ADDRESS'] = $arField;
                        }
                        foreach($arResult['ORDER_PROP']['USER_PROPS_N'] as $arField){
                            $fieldCode = str_replace("ORDER_PROP_", "", $arField['FIELD_ID']);
                            $arFields[$fieldCode] = $arField;
                        }
                        ?>
                        <div class="form-group">
                            <label class="form-label mb-10" for="ORDER_FIELD_<?=$arFields['NAME']['ID'];?>">Имя Фамилия <span class="color-orange">*</span></label>
                            <input type="text" name="<?=$arFields['NAME']['FIELD_NAME'];?>" value="<?=$arFields['NAME']['VALUE'];?>" class="form-control" id="ORDER_FIELD_<?=$arFields['NAME']['ID'];?>">
                        </div>
                        <div class="row">
                            <div class="col col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="form-label mb-10" for="ORDER_FIELD_<?=$arFields['EMAIL']['ID'];?>">Электронная почта <span class="color-orange">*</span></label>
                                    <input type="text" name="<?=$arFields['EMAIL']['FIELD_NAME'];?>" value="<?=$arFields['EMAIL']['VALUE'];?>" class="form-control js-Email" id="ORDER_FIELD_<?=$arFields['EMAIL']['ID'];?>">
                                </div>
                            </div>
                            <div class="col col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="form-label mb-10" for="ORDER_FIELD_<?=$arFields['PHONE']['ID'];?>">Телефон <span class="color-orange">*</span></label>
                                    <input type="text" name="<?=$arFields['PHONE']['FIELD_NAME'];?>" value="<?=$arFields['PHONE']['VALUE'];?>" class="form-control js-InputMask" data-inputmask="'mask': '+7 999 999 99 99','placeholder':'Х'" id="ORDER_FIELD_<?=$arFields['PHONE']['ID'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label mb-10">Регион <span class="color-orange">*</span></label>
                            <?
                            //$BranchSelected = $arFields['REGION']['VALUE'];
                            if (empty($BranchSelected)){
                                $BranchSelected = $_SESSION['BXExtra']['REGION']['IBLOCK']['REGION'];
                            }
                            ?>
                            <div class="form-select js-select">
                                <select id="ORDER_FIELD_<?=$arFields['REGION']['ID'];?>" name="<?=$arFields['REGION']['FIELD_NAME'];?>" class="js-ChangeBranch" data-method="reload">
                                <? foreach ($arBranchList as $arBranch):?>
                                    <option 
                                        value="<?=$arBranch['REGION'];?>" 
                                        <? if ($BranchSelected == $arBranch['REGION']):?> selected<? endif;?>
                                        data-id="<?=$arBranch['ID'];?>"
                                    ><?=$arBranch['REGION'];?></option>
                                <? endforeach;?>
                                </select>
                                <i class="fa fa-chevron-down"></i>
                            </div>
                        </div>             
                        <div class="form-group">
                            <label class="form-label mb-10" for="ORDER_FIELD_<?=$arFields['PERSONAL']['ID'];?>">Лицевой счет «ЭнергосбыТ Плюс»</label>
                            <input type="text" name="<?=$arFields['PERSONAL']['FIELD_NAME'];?>" value="<?=$arFields['PERSONAL']['VALUE'];?>" class="form-control" id="ORDER_FIELD_<?=$arFields['PERSONAL']['ID'];?>">
                        </div>
                        <? if ($arResult['HAS_SERVICE']):?>
                        <div class="form-group">
                            <label class="form-label mb-10" for="ORDER_FIELD_<?=$arFields['ADDRESS']['ID'];?>">Адрес <span class="color-orange">*</span></label>
                            <textarea id="ORDER_FIELD_<?=$arFields['ADDRESS']['ID'];?>" class="form-control like-input" name="<?=$arFields['ADDRESS']['FIELD_NAME'];?>" placeholder=""><?=$arFields['ADDRESS']['VALUE'];?></textarea>
                        </div>
                        <? else:?>
                        <input type="hidden" name="<?=$arFields['ADDRESS']['FIELD_NAME'];?>" value="-">
                        <? endif;?>
                        <div class="cart-group--delivery cart-group">
                            <div class="form-group--label">Ближайший офис самовывоза и/или приема платежей</div>
                            <div class="form-group">
                                <ul class="item-list delivery-list">
                                    <!--here dilivery list by js-->
                                </ul>
                            </div>
                        </div>
                        <div class="cart-group--pay cart-group">
                            <div class="form-group--label">Оплата</div>
                            <div class="form-group">
                                <ul class="item-list pay-list">
                                <!--here pay list by js-->
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-group--label mb-10">Комментарии к заказу</label>
                            <input type="text" name="ORDER_DESCRIPTION" value="" class="form-control">
                        </div>
                        <div class="cart-order--total clearfix cart-group--total cart-group none">
                            <div class="cart-order--total__table pull-left">
                                <table width="100%">
                                    <tr><td>Итого к оплате</td><td class="text-right"><span class="color-orange order-total"><!--here total by js--></span></td></tr>
                                </table>
                            </div>
                            <button class="btn btn-grey w-200 pull-right"><span class="fa-angle-btn">Подтвердить заказ</span></button>
                        </div>
                    </div>
                    <div class="form-annotation">
                        <div class="form-group">
                            <div class="checkbox for-rules">
                                <label>
                                    <input type="checkbox" checked name="RULE_FOR_PAY" value="Y">
                                    <i class=""></i><span>Согласен с <a href="/clients/" target="_blank">условиями продажи</a></span>
                                </label>
                            </div>
                        </div>
                        <div class="checkbox for-rules">
                            <label>
                                <input type="checkbox" checked name="RULE_FOR_DATA" value="Y">
                                <i class=""></i>
                                Нажимая кнопку «Подтвердить заказ», я предоставляю персональные данные и соглашаюсь с обработкой моих персональных данных ОАО «ЭнергосбыТ Плюс» в соответствии с <a href="/privacy/" target="_blank">Политикой обработки персональных данных</a>.
                            </label>
                        </div>
                    </div>
                <!--/Cart order-->
                </div>
            </div>
        </div>
    </form>
	<?
}
?>
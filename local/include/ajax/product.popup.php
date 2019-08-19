<?
define("STOP_STATISTICS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$imageSrc = $request['image'];
?>
<div class="popup-form">
    <div class="section-title text-center mb-20"><span>Товар добавлен в корзину</span></div>
    <div class="overflow">
        <div class="popup-added">
            <div class="row">
                <? if ($imageSrc):?>
                <div class="col col-12 text-center">
                    <div class="popup-added--image">
                        <img src="<?=$imageSrc;?>" alt="">
                    </div>
                </div>
                <? endif;?>
                <div class="col col-12 col-md-6 text-center mb-20">
                    <a href="javascript:$.fancybox.close();" class="btn btn-grey w-200">Продолжить покупки</a>
                </div>
                <div class="col col-12 col-md-6 text-center mb-20">
                    <a href="/cart/" class="btn w-200 btn-orange">Оформить заказ</a>
                </div>
            </div>
        </div>
    </div>
</div>
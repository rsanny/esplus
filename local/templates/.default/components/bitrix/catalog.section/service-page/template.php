<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */
$this->setFrameMode(true);
?>
<div class="services-page">
    <div class="service-total text-right js-fixInContainer none">
        <div class="mr-20 fs-18 ib">Итого: <span class="fs-24 color-orange js-ServiceTotal">0 руб.</span></div>
        <a href="#" class="btn btn-orange ib w-200 js-ServiceBuy" data-location="/cart/"><span class="fa-angle-btn">Оформить заказ</span></a>
    </div>
    <? 
    foreach ($arResult['SECTIONS'] as $arSection):
        if (empty($arSection['CHILDREN']) && empty($arSection['ITEMS'])) continue;
    ?>
    <div class="service-item<? if ($arSection['SELECTED'] == "Y"):?> js-ScrolToHere<? endif;?> js-SectionItem">
        <div class="service-item__head row-vertical js-SlideToggle<? if ($arSection['OPENED']):?> is-selected<? endif;?>" data-href="#service-<?=$arSection['CODE'];?>">
            <div class="service-item__head--img mr-30">
                <? 
                $img = MEDIA_PATH.'images/service-list--img.jpg';
                if ($arSection['PICTURE']){
                    $img = CFile::GetPath($arSection['PICTURE']);
                }
                ?>
                <img src="<?=$img;?>" alt="<?=$arSection['OPENED']['NAME'];?>">
                
            </div>
            <div class="service-item__name fs-18"><?=$arSection['NAME'];?></div>
            <div class="service-item__head--price text-right fs-18 color-black ml-20 js-SectionPrice">&nbsp;</div>
        </div>
        <div class="service-item__content<? if (!$arSection['OPENED']):?> none<? endif;?>" id="service-<?=$arSection['CODE'];?>">
            <? 
            if ($arSection['CHILDREN']):
                foreach ($arSection['CHILDREN'] as $arChildren):
                    //Temp Rule
                    if (!$arChildren['ITEMS']) continue;
                ?>
                <div class="item__content--title color-grey fs-18 mt-20<? if ($arChildren['SELECTED'] == "Y"):?> js-ScrolToHere<? endif;?>"><?=$arChildren['NAME'];?></div>
                <div class="item__content--services">
                    <? foreach ($arChildren['ITEMS'] as $arItem):
                    $CurPrice = reset($arItem['ITEM_PRICES']);
                    ?>
                    <div class="item__content--service">
                        <div class="row row-vertical fs-16">
                            <div class="col col-8 col-md-6 color-black"><?=$arItem['NAME'];?></div>
                            <div class="col col-4 col-md-2 text-right">
                                <input 
                                    type="text" 
                                    class="form-control is-middle w-60 text-center ib js-ServiceInput" 
                                    value="0"
                                    data-name="<?=$arItem['NAME'];?>"
                                    data-price="<?=$CurPrice['RATIO_PRICE'];?>"
                                    data-price-type-id="<?=$CurPrice['PRICE_TYPE_ID'];?>"
                                    data-price-id="<?=$CurPrice['ID'];?>"
                                    data-id="<?=$arItem['ID'];?>"
                                >
                            </div>
                            <div class="col col-6 offset-6 offset-md-0 col-md-2 fs-14 mt-10 mt-md-0 text-right text-md-left"><?=$arItem['ITEM_MEASURE']['TITLE'];?>  х  <?=$CurPrice['PRINT_PRICE'];?></div>
                            <div class="col col-6 hidden-sm-down col-md-2 text-right color-orange service-input--price mt-10 mt-md-0">&nbsp;</div>
                        </div>
                    </div>
                    <? endforeach;?>                                
                </div>
                <? endforeach;?>
            <? else:?>
                <div class="item__content--services mt-20">
                    <? foreach ($arSection['ITEMS'] as $arItem):
                    $CurPrice = reset($arItem['ITEM_PRICES']);
                    ?>
                    <div class="item__content--service">
                        <div class="row row-vertical fs-16">
                            <div class="col col-8 col-md-6 color-black"><?=$arItem['NAME'];?></div>
                            <div class="col col-4 col-md-2 text-right">
                                <input 
                                    type="text" 
                                    class="form-control is-middle w-60 text-center ib js-ServiceInput" 
                                    value="0"
                                    data-name="<?=$arItem['NAME'];?>"
                                    data-price="<?=$CurPrice['RATIO_PRICE'];?>"
                                    data-price-type-id="<?=$CurPrice['PRICE_TYPE_ID'];?>"
                                    data-price-id="<?=$CurPrice['ID'];?>"
                                    data-id="<?=$arItem['ID'];?>"
                                >
                            </div>
                            <div class="col col-6 offset-6 offset-md-0 col-md-2 fs-14 mt-10 mt-md-0 text-right text-md-left"><?=$arItem['ITEM_MEASURE']['TITLE'];?>  х  <?=$CurPrice['PRINT_PRICE'];?></div>
                            <div class="col col-6 hidden-sm-down col-md-2 text-right color-orange service-input--price mt-10 mt-md-0">&nbsp;</div>
                            
                        </div>
                    </div>
                    <? endforeach;?>                                
                </div>
            <? endif;?>
        </div>
    <!--/service list item-->
    </div>
    <? endforeach;?>
</div>

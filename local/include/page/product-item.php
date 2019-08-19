<?
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\DGAPI;
use DorrBitt\catalogPriceType\CatalogPriceType;
//print DGAPI::ses();
//$dev = DGAPI::dev("b3610fdad09a4e64ba1cfd3e9f1791eb");
//print $dev;

$product_picture_id = false;
if ($arItem['DETAIL_PICTURE'])
    $product_picture_id = $arItem['DETAIL_PICTURE'];
elseif ($arItem['PREVIEW_PICTURE'])
    $product_picture_id = $arItem['PREVIEW_PICTURE'];
elseif($arItem['PROPERTIES']['MORE_PHOTO']['VALUE'])
    $product_picture_id = reset($arItem['PROPERTIES']['MORE_PHOTO']['VALUE']);

$product_picture['src'] = MEDIA_PATH."images/no_image.jpg";

if ($product_picture_id){
    $product_picture = CFile::ResizeImageGet($product_picture_id, array('width'=>210, 'height'=>147), BX_RESIZE_IMAGE_PROPORTIONAL, true);
}
$countInCart = $arSettings['IN_CART'][$arItem['ID']];
if (!$countInCart) $countInCart = 0;
$link = $arItem['DETAIL_PAGE_URL'];
if ($arSettings['LINK_TO_STORE']){
    $link = OptimalGroup\Url::Shop($arItem['DETAIL_PAGE_URL']);
}
$CurPrice = reset($arItem['ITEM_PRICES']);

if(is_array($arItem['ITEM_PRICES']) && empty($arItem['ITEM_PRICES'])){
    $arrPrice = CatalogPriceType::priceElement($arItem["ID"], $_SESSION['BXExtra']["PRICE"]["ID"]);
    $arItem['ITEM_PRICES'] = $arrPrice;
    $CurPrice['PRINT_PRICE'] = FormatHelper::price($arItem['ITEM_PRICES']['PRICE']);
    $rub = ($arItem['ITEM_PRICES']["CURRENCY"] == "RUB") ? "руб." : "";
    $CurPrice['PRINT_PRICE'] = $CurPrice['PRINT_PRICE']." ".$rub;
    }
    
?>
<div class="product-item product-to-basket" id="<?=$arItem['AREA_ID'];?>">
    <a href="<?=$link;?>" class="product-item--link clearfix">
        <? 
        if ($arItem['PROPERTIES']['PRICE_OLD']['VALUE']):
        $PriceDiff = $arItem['PROPERTIES']['PRICE_OLD']['VALUE'] - $CurPrice['PRICE'];
        $ProcentPrice = $PriceDiff*100/$arItem['PROPERTIES']['PRICE_OLD']['VALUE'];
        ?>
        
        <span class="product-item--label is-discount">-<?=ceil($ProcentPrice);?>%</span>
        <? endif;?>
        <? if ($arItem['PROPERTIES']['IS_ACTION']['VALUE']):?>
        <span class="product-item--label is-sale">Акция</span>
        <? endif;?>
        <? if ($arItem['PROPERTIES']['IS_NEW']['VALUE']):?>
        <span class="product-item--label is-new">Новинка</span>
        <? endif;?>
        <span class="product-item--img loading-bg product-to-basket--img"><img src="<?=$product_picture['src'];?>" alt="<?=$arItem['NAME'];?>" class="fadeImg" data-id="<?=$product_picture_id;?>"></span>
        <span class="product-item--middle">
            <span class="product-item--name"><span><?=$arItem['NAME'];?></span></span>
            <span class="product-item--text"><?=$arItem['PREVIEW_TEXT'];?></span>
            <? if ($arItem['PROPERTIES']['CML2_ARTICLE']['VALUE']):?>
            <span class="product-item--number">Артикул: <?=$arItem['PROPERTIES']['CML2_ARTICLE']['VALUE'];?></span>
            <? endif;?>
        </span>                          
        <span class="product-item--right">                      
            <span class="clearfix product-item--discount">
                <? if ($arItem['PROPERTIES']['PRICE_OLD']['VALUE']):?>
                <span class="product-item--price__old pull-right"><?=number_format($arItem['PROPERTIES']['PRICE_OLD']['VALUE'],0,""," ");?> руб.</span>
                <? endif;?>
                <span class="product-item--price pull-left"><?=$CurPrice['PRINT_PRICE'];?></span>
            </span>
            <? if ($arItem['STOCK_AVAILABILITY']):?>
            <span class="product-item--availability is-avaiable">
                <i class="fa fa-check-circle-o"></i>
                Наличие: 
                <? for($i=1; $i<=5; $i++):?>
                <b<? if ($i<=$arItem['STOCK_AVAILABILITY']):?> class="is-selected"<? endif;?>></b>
                <? endfor;?>
            </span>
            <? else:?>
            <span class="product-item--availability"><i class="fa fa-minus-circle"></i>Нет в наличии</span>
            <? endif;?>
        </span>
    </a>
    <div class="product-item--form text-right">
        <span class="product-item--form__input js-itemQuantity">
            <i data-type="less">-</i>
            <input type="text" value="1">
            <i data-type="more">+</i>
        </span>
        <a class="btn btn-grey btn-small w-130 js-AddToCart">В корзину</a>
        <a class="btn btn-orange btn-small w-44 js-AddToCart"><i class="fa fa-shopping-cart"></i></a>
    </div>
    <? if ($arItem['STOCK_AVAILABILITY']):?>
    <div class="product-item--action<? if ($countInCart):?> is-in_cart<? endif;?>">
        <a href="/cart/" class="product-item--cart btn-orange btn"><span>В корзине <small><?=$countInCart;?></small> шт.<br><b>Перейти</b> <i class="fa fa-angle-right"></i></a>
        <a href="#" class="product-item--buy btn btn-grey js-AddToCart"><? if ($countInCart):?>+1<? else:?>В корзину<? endif;?></a>
    </div>
    <? else:?>
    <div class="product-item--action">
        <a href="#" class="product-item--buy btn btn-orange js-popUpData" data-fancybox-href="<?=AJAX_PATH;?>form/product-order.php" data-url="<?=$arItem['DETAIL_PAGE_URL']?>" data-product="<?=$arItem['NAME'];?>">Заказать</a>
    </div>
    <? endif;?>
    <div
        class="product-item--basket"
        data-image="<?=$product_picture_id['ID'];?>"
        data-url="<?=$arItem['DETAIL_PAGE_URL'];?>"
        data-id="<?=$arItem['ID'];?>"
        data-price-id="<?=$CurPrice['ID'];?>"
        data-price-type-id="<?=$CurPrice['PRICE_TYPE_ID'];?>"
        data-price="<?=$CurPrice['PRICE'];?>"
        data-name="<?=$arItem['NAME'];?>"
        data-brand="<?=$arItem['PROPERTIES']['CML2_MANUFACTURER']['VALUE'];?>"
        data-category="<?=$arItem['SECTION'];?>"
        data-quantity="1"
        <? if ($arItem['PROPERTIES']['PRICE_OLD']['VALUE']):?>        
        data-price-old="<?=$arItem['PROPERTIES']['PRICE_OLD']['VALUE'];?>"
        <? endif;?>
    ></div>
</div>
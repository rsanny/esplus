<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\abvCity\abvCityParse;
use DorrBitt\catalogPriceType\CatalogPriceType;
use DorrBitt\dbapi\DGAPI;
/*use DorrBitt\CategoryTovarsShop\CategoryTovarsShop;
$arrs = [
    "IBLOCK_SECTION_ID"=>623,
    "UF_REGION"=>$_SESSION['BXExtra']['REGION']['IBLOCK']['ID'],
];
$devArr = CategoryTovarsShop::cTovars($arrs);
if($dev = 1){
   ClassDebug::debug($devArr); 
}*/
//print DGAPI::ses();
$dev = DGAPI::dev("7a413a42284fc993285acd9ca964518f");

//DGAPI::stringValuta($args)
$this->setFrameMode(true);
//$CurPrice = reset($arResult['ITEM_PRICES']);
$addBtn = "js-AddToCartPopUp";

if(is_array($arResult['ITEM_PRICES']) && empty($arResult['ITEM_PRICES'])){
    $arrPrice = CatalogPriceType::priceElement($arResult["ID"], $_SESSION['BXExtra']["PRICE"]["ID"]);
    $arResult['ITEM_PRICES'] = $arrPrice;
    $CurPrice['PRINT_PRICE'] = FormatHelper::price($arResult['ITEM_PRICES']['PRICE']);
    }

$rub = ($arResult['ITEM_PRICES']["CURRENCY"] == "RUB") ? "руб." : "";
?>

<div class="product-detail--header">
    <div class="row">
        <div class="col col-12 col-md-4 order-sm-1">
            <div class="product-detail--photo">
                <? 
                $firstPhoto = reset($arResult['MORE_PHOTO']);
                if (empty($firstPhoto)):
                    $firstPhoto['SRC'] = MEDIA_PATH."images/no_image.jpg";
                ?>
                <div class="product-detail--photo__main text-center product-to-basket--img"><img src="<?=$firstPhoto['SRC'];?>" alt="<?=$arResult['NAME'];?>" class="img-responsive ib"></div>
                <? else:?>
                <div class="product-detail--photo__main text-center product-to-basket--img" >
                    <a href="<?=$firstPhoto['SRC'];?>" class="js-popUp" rel="detail-photo">
                        <img src="<?=$firstPhoto['SRC'];?>" alt="<?=$arResult['NAME'];?>" class="img-responsive ib" data-id="<?=$firstPhoto;?>">
                    </a>
                </div>
                <? if (count($arResult['MORE_PHOTO'])>1):?>
                <div class="product-detail--photo__list">
                <? foreach ($arResult['MORE_PHOTO'] as $k=>$previewPhoto):?>
                <a href="<?=$previewPhoto['SRC'];?>" class="js-popUp<? if($k==0):?> is-selected<? endif;?>" rel="detail-photo">
                    <img src="<?=$previewPhoto['SRC'];?>" alt="">
                </a>
                <? endforeach;?>
                </div>
                <? endif; //count more 1?>
                <? endif;?>
            </div>
        </div>
        <div class="col col-12 col-md-4 order-sm-3 order-md-2 mt-md-0 mt-20">
            <div class="product-detail--tech">
                <table width="100%">
                    <? foreach ($arResult['DISPLAY_PROPERTIES'] as $arProp):?>
                    <tr>
                        <td><?=$arProp['NAME'];?></td>
                        <td><?=$arProp['VALUE'];?></td>
                    </tr>
                    <? endforeach;?>
                </table>
            </div>
        </div>
        <div class="col col-12 col-md-4 order-sm-2 order-md-3" id="price-scroll">
            <div class="product-detail--offer row hidden-md-up">
                <div class="col col-12 col-lg-6">
                    <div class="product-detail--price"><?=$CurPrice['PRINT_PRICE'];?></div>
                    <div class="product-detail--warranty none">Гаранатия:<i></i><span>3 года</span></div>
                </div>
                <div class="col col-12 col-lg-6 mt-10 mt-md-20 mt-lg-0">
                    <a href="#" class="btn btn-orange block <?=$addBtn;?>">Купить</a>
                    <div class="product-detail--delivery">Самовывоз из <a href="#product-tabs" data-tab="#tab-stock" class="dotted js-ScrollToTab">офиса продаж</a></div>
                </div>
            </div>
            <? /*
            <div class="product-detail--action clearfix">
                <div class="pull-left">
                    <a href="#" class="btn btn-empty btn-small"><i class="fa fa-bar-chart btn-fa"></i>Сравнить</a>
                </div>
                <div class="pull-right">
                    <a href="#" class="btn btn-empty btn-small"><i class="fa fa-print btn-fa is-selected"></i> Печать</a>
                </div>
            </div>*/
            ?>
            <div class="product-detail--availability row">
                <div class="col col-12 col-md-6">
                    <? if ($arResult['PROPERTIES']['PRICE_OLD']['VALUE']):?>
                    <div class="product-item--price__old ib"><?=number_format($arResult['PROPERTIES']['PRICE_OLD']['VALUE'],0,' ',' ');?> руб.</div>
                    <? endif;?>
                </div>
                <div class="col col-12 col-lg-6 text-right mt-10 mt-sm-0">
                    <? if ($arResult['STOCK_AVAILABILITY']):?>
                    <div class="product-item--availability is-avaiable">
                        <i class="fa fa-check-circle-o"></i>
                        Наличие: 
                        <? for($i=1; $i<=5; $i++):?>
                        <b<? if ($i<=$arResult['STOCK_AVAILABILITY']):?> class="is-selected"<? endif;?>></b>
                        <? endfor;?>
                    </div>
                    <? else:?>
                    <div class="product-item--availability"><i class="fa fa-minus-circle"></i>Нет в наличии</div>
                    <? endif;?>
                </div>
            </div>
            <div class="product-detail--offer row hidden-sm-down">
                <div class="col col-12 col-lg-6">
                    <div class="product-detail--price"><?=$CurPrice['PRINT_PRICE'];?> <?=$rub?></div>
                    <div class="product-detail--warranty none">Гаранатия:<i></i><span>3 года</span></div>
                </div>
                <? if ($arResult['STOCK_AVAILABILITY']):?>
                <div class="col col-12 col-lg-6 mt-20 mt-lg-0">
                    <a href="#" class="btn btn-orange block <?=$addBtn;?>">Купить</a>
                    <div class="product-detail--delivery">Самовывоз из <a href="#product-tabs" data-tab="#tab-stock" class="dotted js-ScrollToTab">офиса продаж</a></div>
                </div>
                <? else:?>
                <div class="col col-12 col-lg-6 mt-20 mt-lg-0">
                    <a href="#" class="btn btn-orange block js-popUpData" data-fancybox-href="<?=AJAX_PATH;?>form/product-order.php" data-url="<?=$arResult['DETAIL_PAGE_URL']?>" data-product="<?=$arResult['NAME'];?>">Заказать</a>
                </div>
                
                <? endif;?>
            </div>
            <? 
            if ($arResult['SERVICE_BANNER']):
                $BannerPrice = $CurPrice['PRICE'];
                if ($arResult['SERVICE_BANNER']['SERVICE']['PRICE'])
                    $BannerPrice += $arResult['SERVICE_BANNER']['SERVICE']['PRICE'];
                if ($arResult['SERVICE_BANNER']['PROPERTIES']['DISCOUNT']['VALUE'] && $arResult['SERVICE_BANNER']['PROPERTIES']['SERVICE']['VALUE']){
                    $discount = $BannerPrice*($arResult['SERVICE_BANNER']['PROPERTIES']['DISCOUNT']['VALUE']/100);
                }
            ?>
            <div class="product-detail--banner text-center">
                <? if ($arResult['SERVICE_BANNER']['PROPERTIES']['TITLE']['VALUE']):?>
                <div class="product-detail--banner__title"><?=$arResult['SERVICE_BANNER']['PROPERTIES']['TITLE']['VALUE'];?></div>
                <? endif;?>
                <div class="product-detail--banner__content" style="background-image: url(<?=CFile::GetPath($arResult['SERVICE_BANNER']['PREVIEW_PICTURE']);?>">
                    <div class="product-detail--banner__text"><?=$arResult['SERVICE_BANNER']['PROPERTIES']['TEXT']['~VALUE']['TEXT'];?></div>
                    <div class="product-detail--banner__price">
                        
                    <?if ($discount):?>
                        <div>всего <b class="color-orange"><?=number_format($BannerPrice,'0','',' ');?></b> руб.</div>
                        Ваша скидка <?=number_format($discount,'0','',' ');?> руб.
                    <? endif;?>
                    </div>
                    <? if ($arResult['SERVICE_BANNER']['PROPERTIES']['LINK']['VALUE']):?>
                    <a href="<?=$arResult['SERVICE_BANNER']['PROPERTIES']['LINK']['VALUE'];?>" class="btn btn-orange"><?=$arResult['SERVICE_BANNER']['PROPERTIES']['LINK']['DESCRIPTION']?$arResult['SERVICE_BANNER']['PROPERTIES']['LINK']['DESCRIPTION']:'Купить с установкой';?></a>
                    <? endif;?>
                </div>
            </div>
            <? endif;?>
        </div>
    </div>
    <div
        class="product-item--basket"
        data-image="<?=$firstPhoto['ID'];?>"
        data-url="<?=$arResult['DETAIL_PAGE_URL'];?>"
        data-id="<?=$arResult['ID'];?>"
        data-price-type-id="<?=$CurPrice['PRICE_TYPE_ID'];?>"
        data-price-id="<?=$CurPrice['ID'];?>"
        data-price="<?=$CurPrice['PRICE'];?>"
        data-name="<?=$arResult['NAME'];?>"
        data-quantity="1"         
        data-brand="<?=$arResult['PROPERTIES']['CML2_MANUFACTURER']['VALUE'];?>"
        data-category="<?=$arResult['SECTION']['NAME'];?>"
    ></div>
</div>
<div class="product-detail--tabs__selectors js-Tabs" data-container=".product-detail--tab" id="product-tabs">
    <a href="#tab-preview-text" class="is-selected">Описание</a>
    <!--<a href="#tab-review">Отзывы</a>-->
    <? if ($arResult['STOCK']):?>
    <a href="#tab-stock">Наличие в офисах</a>
    <? endif;?>
</div>
<div class="product-detail--tabs">
    <div class="product-detail--tab" id="tab-preview-text">
        
        <?php $resultText = (!empty($arResult['DETAIL_TEXT'])) ? trim($arResult['DETAIL_TEXT']) : trim($arResult['PREVIEW_TEXT']); ?>
        <?php 
        if(!empty($resultText )){
            $expDT = explode("\n",$resultText );
        }
        ?>

        <?php if(is_array($expDT) && !empty($expDT)):?>
          <ul class="class-ul" >
          <?php foreach($expDT as $test_detail):?>
            <?php $test_detail = strip_tags($test_detail);?>
             <?php if(!empty($test_detail)):?>
             <?php $its++;?>
             <li><?=$test_detail?></li>
             <?php endif;?>
          <?php endforeach;?>
          </ul>
        <?php endif;?>
        <!--<?=$arResult['DETAIL_TEXT']?$arResult['DETAIL_TEXT']:$arResult['PREVIEW_TEXT'];?>-->
    </div>
    <div class="product-detail--tab none" id="tab-review"></div>
    <div class="product-detail--tab none" id="tab-stock">
        <div class="row product-detail--stock__filter">
            <div class="col col-12 col-md-4">
                <div class="form-select js-select">
                    <select class="js-SearchStock">
                        <option value="">Выбор города</option>
                        <? foreach ($arResult['STOCK_CITIES'] as $arStock):?>
                        <option value='<?=json_encode($arStock['ID']);?>'>г. <?=$arStock['NAME'];?></option>
                        <? endforeach;?>
                    </select>
                    <i class="fa fa-angle-down"></i>
                </div>
            </div>
            <div class="col col-12 col-md-8 js-Tabs product-detail--stock__selectors" data-container=".product-detail--stock">
                <a href="#stock-table" class="btn is-selected"><i class="section-mode--view__grid btn-fa"></i>Список</a>
                <a href="#stock-map" class="btn"><i class="fa fa-map-marker btn-fa"></i>На карте</a>
            </div>
        </div>
        <?php 
        // TITLE UF_CONTACTS ACTIVE
            //if($dev == 1) ClassDebug::debug($arResult['STOCK']);
            //if($dev == 1) ClassDebug::debug($arResult['STOCK_ADDRESS']);
        ?>
        <? if ($arResult['STOCK']):?>
        <div class="product-detail--stock__table product-detail--stock" id="stock-table">
            <table width="100%">
                <tr>
                    <th class="hidden-md-down">Город</th>
                    <th>Адрес</th>
                    <th>Наличие</th>
                    <th colspan="2">Режим работы</th>
                </tr>
                <? 
                $MapPlacmarks = array();
                foreach($arResult['STOCK'] as $arStock):
                    $office = $arResult['STOCK_ADDRESS'][$arStock['UF_CONTACTS']];
                    $act_while = (is_array($office) && !empty($office) && $arStock['ACTIVE'] == "Y") ? 1 : 0;
                ?>
                <?php if($act_while == 1):?>

                <tr id="stock-<?=$office['ID'];?>" class="stock-tr">
                    <td class="hidden-md-down">
                        <? 
                        //if($arParams['IS_ADMIN'] && !$office){ echo $arStock['TITLE'].'['.$arStock['ID'].']';}
                        ?>
                        <?php $abCity = abvCityParse::initResult($office['PROPERTIES']['CITY']['VALUE']);?>
                        <?=$abCity?> <?=$office['PROPERTIES']['CITY']['VALUE'];?>  
                    </td>
                    <td><?=$office['PROPERTIES']['ADDRESS']['VALUE'];?></td>
                    <td>
                    <? 
                        $inStock = \OptimalGroup\Catalog::GetStockView($arStock['PRODUCT_AMOUNT']);
                        $InStockJs = $InStockHtml = '<div class="product-item--availability is-avaiable">';
                        $InStockJs .= '<i class="fa fa-check-circle-o"></i> Наличие: ';
                        for($i=1; $i<=5; $i++){
                            $class = "";
                            if ($i<=$inStock)
                                $class = ' class="is-selected"';
                            $InStockHtml .= '<b'.$class.'></b>';
                            $InStockJs .= '<b'.$class.'></b>';
                        }
                        $InStockJs  .=  '</div>';
                        $InStockHtml .=  '</div>';
                        
                    ?>
                        <?=$InStockHtml;?>
                    </td>
                    <td>
                        <? if ($office['PROPERTIES']['TIME_INDIVIDUALS']['VALUE']):?>
                        <?
                        $arTimeInd = '<table class="no-padding" width="100%">';
                        foreach ($office['PROPERTIES']['TIME_INDIVIDUALS']['VALUE'] as $k=>$day):
                            $time = $office['PROPERTIES']['TIME_INDIVIDUALS']['DESCRIPTION'][$k];
                            $arTimeInd .= '<tr><td nowrap>'.$day.'</td><td nowrap>'.$time.'</td></tr>';
                        endforeach;
                        $arTimeInd .= "</table>";   
                        ?>
                        <?=$arTimeInd;?>
                        <br>
                        <? endif;?>
                    </td>
                    <td><a href="#" class="btn btn-small btn-grey w-130 <?=$addBtn;?> js-setPrimaryStore" data-id="<?=$arStock['ID'];?>">Выбрать</a></td>
                </tr>
                <?php endif;?>
                <? 
                
                $coord = explode(',',$office['PROPERTIES']['COORDS']['VALUE']);
                $MapPlacmarks[] = array(
                    'CENTER'=>array($coord[0],$coord[1]),
                    "ID"=>$office['ID'],
                    "REGION"=>$office['PROPERTIES']['REGION']['VALUE'],
                    "CONTENT"=>array(
                        "IN_STOCK"=>$InStockJs,
                        "ADDRESS" => $office['PROPERTIES']['INDEX']['VALUE'].", ".$office['PROPERTIES']['ADDRESS']['VALUE'],
                        "PHONE" => implode(",<br>",$office['PROPERTIES']['PHONE']['VALUE']),
                        "TIME" => $arTimeInd,
                        "TEXT" => $office['PREVIEW_TEXT']
                    ),
                    "TEMPLATE"=>"product",
                    "STOCK" => $arStock['ID']
                );
                endforeach;?>
            </table>
        </div>
        <div class="product-detail--stock product-detail--stock__map none" id="stock-map">
            <script>
                ContactsPlaceMarksList = <?=json_encode($MapPlacmarks);?>;
            </script>
            <div class="contacts-map" id="map"></div>
        </div>
        <? endif;?>
    </div>
    
</div>
<script>
    dataLayer.push({
        "ecommerce": {
            "currencyCode": "RUB",
            "detail": {       
                "actionField": {"list": "Детальная продукта"},
                "products": [
                    {
                        "id": "<?=$arResult['ID'];?>",
                        "name" : "<?=$arResult['NAME'];?>",
                        "price": <?=$CurPrice['PRICE'];?>,
                        "brand": "<?=$arResult['PROPERTIES']['CML2_MANUFACTURER']['VALUE'];?>",
                        "category": "<?=$arResult['SECTION']['NAME'];?>",
                    }
                ]            
            }
        },
        'event': 'gtm-ee-event',
        'gtm-ee-event-category': 'Enhanced Ecommerce',
        'gtm-ee-event-action': 'Product Details',
    });
</script>
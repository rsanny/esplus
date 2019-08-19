<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//pr($arResult);
$VisibleSection = 0;
$arGridName = array(
    1 => "Один счетчик",
    2 => "Два счетчика",
    3 => "Три счетчика",
    4 => "Четыре счетчика"
);
$arQuant = array(
    1 => array(1,0),
    2 => array(1,1),
    3 => array(2,1),
    4 => array(2,2),
);
?>
<div class="row mb-30">
    <div class="col col-12 col-sm-6 col-lg-4 offset-lg-4">
        <div class="one-radio js-Tabs" data-container=".water-tab">
        <? 
        $SelectCount = 0;
        foreach ($arResult['SECTIONS'] as $arSection):
            $selected = false;
            if ($SelectCount == 1){
                $VisibleSection = $arSection['ID'];
                $selected = true;
            }
        ?>           
            <a href="#tab-water-<?=$arSection['ID'];?>"<? if ($selected):?> class="is-selected"<? endif;?>><i></i><?=$arSection['NAME'];?></a>
        <? 
        $SelectCount++;
        endforeach;?>
            <span class="is-selected-1"></span>
        </div>
    </div>
</div> 
<? foreach ($arResult['GRID']['ROW'] as $SectionID=>$arGrid):?>
<div class="water-tab<? if ($VisibleSection != $SectionID):?> none<? endif;?>" id="tab-water-<?=$SectionID;?>">
    <div class="row">
    <? 
    foreach ($arGrid as $k=>$grid):
        $arItem = reset($grid);
    ?>
        <div class="col col-12 col-md-6 col-lg-4 col-xl-3 mt-40 mt-md-0">
            <div class="product-item water-product">
                <div class="product-item--link">
                    <div class="product-item--count"><i><?=$k;?></i><span class="text-center"><?=$arGridName[$k];?></span></div>
                    <span class="product-item--img"><img src="<?=$arItem['IMAGE'];?>" alt="<?=$arItem['COUNTER_NAME'];?>" class="fadeImg"></span>
                    <span class="product-item--name"><?=$arItem['NAME'];?></span>
                    <div class="text-center">
                        <div class="dropdown by-click">
                            <span class="dropdown--label fs-14"><span>Выбрать другой</span><i class="fa-angle-down fa"></i></span>
                            <div class="dropdown-list js-SwitchCounter">
                            <? 
                            foreach ($grid as $item):
                                $arJsItems[$item['ID']] = $item;
                            ?>
                            <a href="#" class="btn<? if ($arItem['BRAND'] == $item['BRAND']):?> is-selected<? endif;?>" data-product="<?=$item['ID'];?>"><?=$item['BRAND'];?></a>             
                            <? endforeach;?>
                            </div>
                        </div>
                    </div>
                    <div class="product-item--quantity__title text-left mt-10">Количество счетчиков:</div>
                    <div class="fs-14 mt-20 mb-20 js-WaterSumm" data-summ="<?=$k;?>">
                        <div class="product-item--quantity">
                            <div class="product-item--quantity__name">холодной воды</div>
                            <div class="form-control--container js-itemQuantity">
                                <div class="form-control--quantity">
                                    <i data-type="more">+</i>
                                    <i data-type="less">-</i>
                                </div>
                                <input type="text" name="COUNTER_AMOUT" value="<?=$arQuant[$k][0];?>" class="form-control" data-min="0">
                            </div>
                        </div>
                        <div class="product-item--quantity mt-10">
                            <div class="product-item--quantity__name">горячей воды</div>
                            <div class="form-control--container js-itemQuantity">
                                <div class="form-control--quantity">
                                    <i data-type="more">+</i>
                                    <i data-type="less">-</i>
                                </div>
                                <input type="text" name="COUNTER_COLD_AMOUT" value="<?=$arQuant[$k][1];?>" class="form-control" data-min="0">
                            </div>
                        </div>
                    </div>
                    <span class="product-item--right mt-30">
                        <span class="product-item--price text-center">   
                            <? if ($arItem['PRICE']['OLD'] != $arItem['PRICE']['NEW']):?>                     
                            <?
                            /*<div class="product-item--price__old">
                            <?=number_format($arItem['PRICE']['OLD'],0," "," ");?> руб.
                            </div>*/
                            ?>
                            <? endif;?>
                            <span><?=number_format($arItem['PRICE']['NEW'],0,""," ");?> руб.</span>
                        </span>

                    </span>
                    <span class="clear"></span>
                </div>
                <div class="product-item--action">
                    <a href="#" class="product-item--buy btn btn-orange js-WaterBuy" data-product="<?=$arItem['ID'];?>"><span class="fa-angle-btn">Заказать</span></a>
                </div>
            </div>
        </div>    
    <? endforeach;?>
    </div>
</div>
<?
endforeach;
?>
<script>
WaterItems = <?=CUtil::PhpToJSObject($arJsItems)?>
</script>
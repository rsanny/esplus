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
$c = 0;
$t = count($arResult['SECTIONS']);
if ($t == 2){
    $class = "col-md-6 col-lg-5";
}
?>
<div class="row text-center">
<? foreach ($arResult['SECTIONS'] as $arSection):
    if ($t == 3 && $c==1)
        $class = "col-md-4 col-lg-4";
    else if($t == 3)
        $class = "col-md-4  col-lg-3";
        
?>
    <div class="col col-12 col-md-4 mb-20 <?=$class;?> <? if ($c == 0):?>offset-lg-1<? endif;?>">
        <div class="mlra round-105 text-center mb-20">
            <img src="<?=CFile::GetPath($arSection['PICTURE']);?>" alt="<?=$arSection['NAME'];?>">
        </div>
        <? if ($arSection['DESCRIPTION']):?>
        <div class="mb-20">
            <b class="color-orange fs-24 text-uppercase block"><?=$arSection['NAME'];?></b>
            <?=$arSection['DESCRIPTION'];?>
        </div>
        <? else:?>
        <div class="mb-40">
            <b class="color-orange fs-24 text-uppercase block"><?=$arSection['NAME'];?></b>
        </div>
        <? endif;?>
        <div>
        <? 
        foreach ($arSection['ITEMS'] as $arItem):
            $btnName = $arItem['PROPERTIES']['TITLE']['VALUE'];
            if ($arItem['PROPERTIES']['BTN_NAME']['VALUE'])
                $btnName = $arItem['PROPERTIES']['BTN_NAME']['VALUE'];
        ?>
            <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="btn btn-grey-light btn-middle w-300 block mlra"><span class="fa-angle-btn"><?=$btnName;?></span></a>
        <? endforeach;?>
        </div>
    </div>
<? 
$c++;
endforeach;?>
</div>
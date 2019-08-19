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
?>
<div class="row mb-50">
    <div class="col col-12 col-sm-6 col-lg-4">
        <div class="guide-item" id="<?=$this->GetEditAreaId($arResult['ID']);?>">
            <img src="<?=$arResult['PREVIEW_PICTURE']['SRC'];?>" alt="<?=$arResult['NAME'];?>" class="img-responsive">
            <span><?=$arResult['NAME'];?></span>
            <b><?=$arResult['PROPERTIES']['POSITION']['~VALUE'];?></b>
        </div>
    </div>
</div>
<? if($arResult["NAV_RESULT"]):?>
    <?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
    <?echo $arResult["NAV_TEXT"];?>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
<? elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
    <?echo $arResult["DETAIL_TEXT"];?>
<? else:?>
    <?echo $arResult["PREVIEW_TEXT"];?>
<? endif?>

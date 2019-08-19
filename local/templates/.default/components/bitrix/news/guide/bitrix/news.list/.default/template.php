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
<? if ($arResult['HEAD']):?>
<div class="row mb-50">
    <? foreach ($arResult['HEAD'] as $arItem):?>
    <div class="col col-12 col-sm-6 col-lg-4 mb-20">
        <a class="guide-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="<?=$arItem['NAME'];?>" class="img-responsive">
            <span><?=$arItem['NAME'];?></span>
            <b><?=$arItem['PROPERTIES']['POSITION']['~VALUE'];?></b>
        </a>
    </div>
    <? endforeach;?>
</div>
<? endif;?>
<div class="row">
<? foreach ($arResult['ALL'] as $k=>$arPerson):
    $this->AddEditAction($arPerson['ID'], $arPerson['EDIT_LINK'], CIBlock::GetArrayByID($arPerson["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arPerson['ID'], $arPerson['DELETE_LINK'], CIBlock::GetArrayByID($arPerson["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
    <div class="col col-12 col-sm-6 col-lg-4 mb-20">
        <a class="guide-item" id="<?=$this->GetEditAreaId($arPerson['ID']);?>">
            <img src="<?=$arPerson['PREVIEW_PICTURE']['SRC'];?>" alt="<?=$arPerson['NAME'];?>" class="img-responsive">
            <span><?=$arPerson['NAME'];?></span>
            <b><?=$arPerson['PROPERTIES']['POSITION']['~VALUE'];?></b>
        </a>
    </div>
<? endforeach;?>
</div>
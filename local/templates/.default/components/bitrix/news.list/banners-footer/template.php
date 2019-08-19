<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<div class="row">
    <? foreach($arResult["ITEMS"] as $k=>$arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="col col-12 col-md-6">
            <div class="small-banner--link" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE'];?>" class="btn w-210 btn-orange<? if($arItem['PROPERTIES']['VIDEO']['VALUE']):?> js-popUp fancybox.iframe<? endif;?>"><?=$arItem['PROPERTIES']['LINK']['DESCRIPTION']?$arItem['PROPERTIES']['LINK']['DESCRIPTION']:'Узнать больше';?></a>
                <? if($arItem['PROPERTIES']['VIDEO']['VALUE']):?>
                <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE'];?>" class="small-banner--play js-popUp fancybox.iframe hidden-md-down"></a>
                <? endif;?>
                <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="" class="img-responsive">
            </div>
        </div>
    <? endforeach;?>
</div>

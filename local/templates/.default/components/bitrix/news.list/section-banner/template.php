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
if (count($arResult['ITEMS'])):
    foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $arProp = $arItem['PROPERTIES'];
    $pcClass = $tabletClass = $mobileClass = "";
    $pcClass = 'img-responsive';
    if ($arProp['PREVIEW_PICTURE_TALBET']['VALUE']) {
        $pcClass .= " hidden-md-down";
        $tabletClass .= "img-responsive hidden-lg-up";
    }
    if ($arProp['PREVIEW_PICTURE_PHONE']['VALUE']) {
        $pcClass .= " hidden-sm-down";
        if ($tabletClass){
            $tabletClass .= " hidden-sm-down";
        }
        $mobileClass .= "img-responsive hidden-md-up";        
    }
	?>
    <div class="section-banner banner-<?=$arParams['BANNER_POSITION'];?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <? if ($arProp['LINK']['VALUE']):?><a href="<?=$arProp['LINK']['VALUE'];?>"><? endif;?>
        <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="" class="<?=$pcClass;?>">
        <? if ($tabletClass):?><img src="<?=CFile::GetPath($arProp['PREVIEW_PICTURE_TALBET']['VALUE']);?>" alt="" class="<?=$tabletClass;?>"><? endif;?>
        <? if ($mobileClass):?><img src="<?=CFile::GetPath($arProp['PREVIEW_PICTURE_PHONE']['VALUE']);?>" alt="" class="<?=$mobileClass;?>"><? endif;?>
        <? if ($arProp['LINK']['VALUE']):?></a><? endif;?>
    </div>
<? 
    endforeach;
endif;?>
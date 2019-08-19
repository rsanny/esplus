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
<? if (count($arResult["ITEMS"])):?>
<div class="faq-list">
<? foreach($arResult["ITEMS"] as $k=>$arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <div class="faq-item<? if ($k == 1):?> is-opened<? endif;?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="faq-item--name"><i></i><span><?=$arItem['NAME'];?></span></div>
        <div class="faq-item--text<? if ($k != 1):?> none<? endif;?>"><?=$arItem['PREVIEW_TEXT']?$arItem['PREVIEW_TEXT']:$arItem['DETAIL_TEXT'];?></div>
    </div>
<? endforeach;?>
</div>
<? endif;?>
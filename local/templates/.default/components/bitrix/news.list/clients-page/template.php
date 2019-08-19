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
?>

<?
$this->AddEditAction($arResult['ITEM']['ID'], $arResult['ITEM']['EDIT_LINK'], CIBlock::GetArrayByID($arResult['ITEM']["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arResult['ITEM']['ID'], $arResult['ITEM']['DELETE_LINK'], CIBlock::GetArrayByID($arResult['ITEM']["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<div class="client-page mb-30" id="<?=$this->GetEditAreaId($arResult['ITEM']['ID']);?>">
    <?=$arResult['ITEM']['DETAIL_TEXT'];?>
    <? if ($arResult['ITEM']['FAQ']):?>
    <div class="mt-30">
        <div class="fs-18 color-orange"><b>Популярные вопросы</b></div>
        <div class="faq-list mt-30">
        <? foreach ($arResult['ITEM']['FAQ'] as $faq):?>
        <div class="faq-item">
            <div class="faq-item--name"><i></i><span><?=$faq['NAME'];?></span></div>
            <div class="faq-item--text none"><?=$faq['~PREVIEW_TEXT'];?></div>
        </div>
        <? endforeach;?>
        </div>
    </div>
    <? endif;?>
</div>
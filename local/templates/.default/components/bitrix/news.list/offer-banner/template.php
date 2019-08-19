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
//<div class="col col-12 col-md-6 col-lg-4 offset-md-3 offset-lg-0 service-list--item">
?>
<? if (count($arResult['ITEMS'])):?>
<div class="service-list row">
    <? foreach ($arResult['ITEMS'] as $arItem):?>
    <?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $PageLink = $arItem['PROPERTIES']['URL']['VALUE'];
    if ($arItem['PROPERTIES']['SHOP']['VALUE'] && $arParams['SITE'] != "shop")
        $PageLink = OptimalGroup\Url::Shop($arItem['PROPERTIES']['URL']['VALUE']);
    ?>
    <div class="col col-12 col-md-6<? if ($arParams['NEWS_COUNT'] == 3):?> col-lg-4<? endif;?> service-list--item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a class="service-list--item__link" href="<?=$PageLink;?>">
            <? if ($arItem['PROPERTIES']['PRICE']['VALUE']):?>
            <span class="service-list--item__link--price">от <?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'],0,' ',' ');?> руб</span>
            <? endif;?>
            <span class="service-list--item__link--btn">Заказать</span>
            <span class="service-list--item__link--text"><?=$arItem['PREVIEW_TEXT'];?></span>
            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="" class="service-list--item__image">
        </a>
    </div>
    <? endforeach;?>
</div>
<? endif;?>
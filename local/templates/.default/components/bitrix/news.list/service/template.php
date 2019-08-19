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
<div class="row">
<? foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    //if ($arItem['IBLOCK_SECTION_ID'] == SERVICE_EXCLUDE_SECTION) continue;
	?>
	<div class="col col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
        <div class="business-service--item js-matchHeight" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="business-service--item__hover" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC'];?>);"></div>
            <div class="business-service--item__head" data-mh="service-name"><?=$arItem['NAME'];?></div>
            <? if ($arItem['PROPERTIES']['RULE']['VALUE']):?>
            <div class="business-service--item__rules" data-mh="service-text"><?=$arItem['PROPERTIES']['RULE']['VALUE'];?></div>
            <? endif;?>
            <div class="business-service--item__btn">
                <div class="mb-10"><a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="btn btn-grey btn-small">Подробно об услуге</a></div>
                <div><a href="#" class="btn btn-orange btn-small js-popUpData" data-url="<?=$arItem['DETAIL_PAGE_URL'];?>" data-title="<?=$arItem['NAME'];?>" data-fancybox-href="<?=AJAX_PATH;?>form/service-order.php">Задать вопрос</a></div>
            </div>
        </div>
    </div>
<? endforeach;?>
</div>
<? endif;?>
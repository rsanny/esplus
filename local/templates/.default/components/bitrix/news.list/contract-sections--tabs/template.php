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
<div class="row mb-20 text-center">
<? 
foreach ($arResult['SECTIONS'] as $arSection):
    $firstItem = reset($arSection['ITEMS']);
?>
    <div class="col col-4">
        <a href="<?=$firstItem['DETAIL_PAGE_URL'];?>" class="round-img mlra mt-10 mb-10 wh-60 text-center contract-section--link<? if($arSection['CODE'] == $arParams['CURRENT']['SECTION']):?> is-selected<? endif;?>">
            <img src="<?=CFile::GetPath($arSection['PICTURE']);?>" alt="" class="is-normal">
            <img src="<?=CFile::GetPath($arSection['UF_ICON_WHITE']);?>" alt="" class="is-white">
        </a>
    </div>
<? endforeach;?>
</div>
<? foreach ($arResult['SECTIONS'] as $arSection):?>
<div class="<? if($arSection['CODE'] != $arParams['CURRENT']['SECTION']):?>none <? endif;?> contract-section--tab" id="<?=$arSection['CODE'];?>">
    <? 
    foreach ($arSection['ITEMS'] as $arItem):
    $btnName = $arItem['PROPERTIES']['TITLE']['VALUE'];
    if ($arItem['PROPERTIES']['BTN_NAME']['VALUE'])
        $btnName = $arItem['PROPERTIES']['BTN_NAME']['VALUE'];
    ?>
    <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="btn<? 
    if($arParams['CURRENT']['ELEMENT'] == $arItem['CODE'] && $arSection['CODE'] == $arParams['CURRENT']['SECTION']):
    ?> btn-orange<? 
    else:
    ?> btn-grey-light<?
    endif;?> btn-middle block w-270 mlra"><span class="fa-angle-btn"><?=$btnName;?></span></a>
    <? endforeach;?>
</div>
<? endforeach;?>
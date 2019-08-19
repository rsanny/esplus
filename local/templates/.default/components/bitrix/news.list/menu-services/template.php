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
$sectionCount = 0;
?>
<div class="col col-<?=$arParams['IN_ROW'];?>">
<? foreach($arResult['SECTIONS'] as $k=>$arSection):?>
    <? if ($sectionCount == 1 || $sectionCount == 3):?>
    </div>
    <div class="col col-<?=$arParams['IN_ROW'];?>">
    <? endif;?>
    <? 
    $single = false;
    if (count($arSection['ITEMS']) == 1):
        $firstItem = reset($arSection['ITEMS']);
        if ($firstItem['NAME'] == $arSection['NAME']){
            $arSection['SECTION_PAGE_URL'] = $firstItem['DETAIL_PAGE_URL'];
            $single = true;
        }
    endif;?>
    
    <div class="service-menu">
        <div class="product-links--title"><a href="<?=$arSection['SECTION_PAGE_URL'];?>"><?=$arSection['NAME'];?></a></div>
        <? if ($arSection['ITEMS'] && !$single):?>
        <ul class="no-list product-links">
        <? foreach ($arSection['ITEMS'] as $arItem):?>
            <li><a href="<?=$arItem['DETAIL_PAGE_URL'];?>"><?=$arItem['NAME'];?></a></li>
        <? endforeach;?>
        </ul>
    </div>
    <br>  
    <? endif;?>      
<? 
$sectionCount++;
endforeach;?>    
</div>
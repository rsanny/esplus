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
<div class="service-sections row">
    <div class="col col-12 col-lg-4 col-md-6">
<? 
foreach ($arResult['SECTIONS'] as $k=>$arSection):
    $firstItem = reset($arSection["ITEMS"]);
?>
<? if ($arSection['CODE'] == "razrabotka-dogovornoy-konstruktsii-energosnabzheniya"):?>
</div>
<div class="col col-12 col-lg-4 col-md-6">
<? endif;?>    
<? if ($arSection['CODE'] == "obsluzhivanie-i-servis"):?>
</div>
<div class="col col-12 col-lg-4">
<? endif;?>    
        <div class="service-section service-section-<?=$k;?>">
            <div class="service-section--img"><img src="<?=CFile::GetPath($arSection['PICTURE']);?>" alt="<?=$arSection['NAME'];?>"></div>
            <? if (count($arSection["ITEMS"])>0 && $firstItem['NAME'] != $arSection['NAME']):?>
            <div class="z5"><a href="<?=$arSection['SECTION_PAGE_URL'];?>"><?=$arSection['NAME'];?></a></div>
            <ul class="service-section--items">
            <?foreach($arSection["ITEMS"] as $arItem):?>
                <li><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></li>
            <?endforeach;?>
            </ul>
            <? 
            else:
            ?>        
            <div class="z5"><a href="<?=$firstItem['DETAIL_PAGE_URL']?>"><?=$firstItem['NAME'];?></a></div>
            <? endif;?>
        </div>        
<? 
$c++;
endforeach;?>    
    </div>
</div>
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
use DorrBitt\dbCity\DBCITY;
$this->setFrameMode(true);
$idCity = DBCITY::idcity();
?>
<div class="shop-section--carousel slick-arrow--grey mb-40  js-matchHeigh <?=$arParams['ADD_CLASS'];?>">
<? foreach ($arResult['SECTIONS'] as &$arSection):
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    $blokID = 1934;
?>
<?php if($arSection['ID'] == $blokID) { ?>
    <?php if($idCity == 23): ?>
    <div>
        <a href="<?=$arSection['SECTION_PAGE_URL']; ?>" class="shop-section--link"  data-mh="slide-height">
            <i><img src="<?=$arSection['PICTURE']['SRC'];?>" alt=""></i>
            <span><?=$arSection['NAME']; ?></span>
        </a>
    </div>
    <?php endif; ?>
<?php
// На сайте Владимирского филиала https://shop.esplus.ru/ из блока "Каталог товаров" убран подраздел "Светодиодные лампы"
} elseif ($idCity == 11 && $arSection['ID'] == 613) {
    
} else { ?>
    <div>
        <a href="<?=$arSection['SECTION_PAGE_URL']; ?>" class="shop-section--link"  data-mh="slide-height">
            <i><img src="<?=$arSection['PICTURE']['SRC'];?>" alt=""></i>
            <span><?=$arSection['NAME']; ?></span>
        </a>
    </div>
<?php } ?>
<? endforeach;?>
</div>
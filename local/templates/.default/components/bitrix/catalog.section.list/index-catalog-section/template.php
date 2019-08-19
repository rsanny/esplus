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
<div class="shop-section--carousel slick-arrow--grey mb-40  js-matchHeigh <?=$arParams['ADD_CLASS'];?>">
<? foreach ($arResult['SECTIONS'] as &$arSection):
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
?>
   <div>
        <a href="<?=$arSection['SECTION_PAGE_URL']; ?>" class="shop-section--link"  data-mh="slide-height">
            <i><img src="<?=$arSection['PICTURE']['SRC'];?>" alt=""></i>
            <span><?=$arSection['NAME']; ?></span>
        </a>
    </div>      
<? endforeach;?>
</div>
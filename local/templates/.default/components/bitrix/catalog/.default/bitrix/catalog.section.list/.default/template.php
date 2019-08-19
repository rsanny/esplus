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
<div class="sections-menu">
<? foreach ($arResult['SECTIONS'] as &$arSection):
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
?>
    <a href="<?=$arSection['SECTION_PAGE_URL']; ?>" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>"<? if($arSection['ID'] == $arParams['CURRENT_SECTION']):?> class="is-selected"<? endif;?>><?=$arSection['NAME']; ?><span>(<?=$arSection['ELEMENT_CNT']; ?>)</span></a>
<? endforeach;?>
</div>
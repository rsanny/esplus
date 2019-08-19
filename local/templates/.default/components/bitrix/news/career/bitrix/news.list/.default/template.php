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
<? foreach ($arResult['SECTIONS'] as $arSection):?>
    <p class="bg-message bg-warning js-SlideToggle" data-close=".file-list--small" data-href="#career-<?=$arSection['ID'];?>"><?=$arSection['NAME'];?></p>
    <p class="file-list--small<? if ($arParams['CURRENT_BRANCH'] != $arSection['BRANCH']):?> none<? endif;?>" id="career-<?=$arSection['ID'];?>">
    <?foreach($arSection["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $icon = "career";
        if (strpos(strtolower($arSection['NAME']),'гпх') !== false)
            $icon = "career_gph";
        ?>
        <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="file-item--small" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <span><i class="icon-file--career-2"></i></span>
            <b><?=$arItem['NAME'];?></b>
        </a>
    <? endforeach;?>
    </p>
<? endforeach;?>
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
$currentSection = end($arResult['SECTION']['PATH']);
?>
<? if ($currentSection['DESCRIPTION']):?>
    <div class="mb-40"><?=$currentSection['DESCRIPTION'];?></div>
<? endif;?>
<? if (count($arResult['SECTIONS'])):?>
    <? foreach ($arResult['SECTIONS'] as $YearName => $arSection):?>
    <? if (count($arSection['ITEMS'])):?>
    <? if ($YearName):?>
    <div class="bg-message bg-warning"><?=$arSection['VALUE'];?></div>
    <? endif;?>
    <div class="file-list">
        <?foreach($arSection['ITEMS'] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $arFile = CFile::GetFileArray($arItem['PROPERTIES']['FILE']['VALUE']);
        //pr($arFile);
        $fileType = "pdf";
        if (strpos($arFile['CONTENT_TYPE'],"word") !== false)
            $fileType = "doc";
        if (strpos($arFile['CONTENT_TYPE'],"spreadsheetml") !== false || strpos($arFile['CONTENT_TYPE'],"excel") !== false)
            $fileType = "exl";
        if (strpos($arFile['CONTENT_TYPE'],"image") !== false)
            $fileType = "img";
        if (strpos($arFile['CONTENT_TYPE'],"zip") !== false)
            $fileType = "zip";
        if (strpos($arFile['CONTENT_TYPE'],"rar") !== false)
            $fileType = "zip";
        ?>
        <div class="file-list--item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <a class="file-list--item__text" href="<?=$arFile['SRC'];?>" target="_blank"><?=$arItem['PREVIEW_TEXT']?$arItem['PREVIEW_TEXT']:$arItem['NAME'];?></a>
            <a href="<?=$arFile['SRC'];?>" class="file-list--item__file" target="_blank">
                <i class="icon-file--<?=$fileType;?>"></i>
                <span><?=FormatHelper::FileSize($arFile['FILE_SIZE']);?></span>
            </a>
        </div>
        <?endforeach;?>
    </div>
    <? endif;?>
    <? endforeach;?>
<? endif;?>
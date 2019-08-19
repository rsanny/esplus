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
$this->AddEditAction($arResult['ITEM']['ID'], $arResult['ITEM']['EDIT_LINK'], CIBlock::GetArrayByID($arResult['ITEM']["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arResult['ITEM']['ID'], $arResult['ITEM']['DELETE_LINK'], CIBlock::GetArrayByID($arResult['ITEM']["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<div id="<?=$this->GetEditAreaId($arResult['ITEM']['ID']);?>">
    <?=$arResult['ITEM']['PREVIEW_TEXT']?$arResult['ITEM']['PREVIEW_TEXT']:$arResult['ITEM']['DETAIL_TEXT'];?>
    <? if ($arResult['ITEM']['FAQ']):?>
    <div class="mt-30">
        <div class="faq-list mt-30">
        <? foreach ($arResult['ITEM']['FAQ'] as $faq):?>
        <div class="faq-item">
            <div class="faq-item--name"><i></i><span><?=$faq['NAME'];?></span></div>
            <div class="faq-item--text none"><?=$faq['~PREVIEW_TEXT'];?></div>
        </div>
        <? endforeach;?>
        </div>
    </div>
    <? endif;?>
    <? 
    if ($arResult['ITEM']['PROPERTIES']['FILES']['VALUE']):
    ?>
    <div class="file-list--small">
    <?
        foreach ($arResult['ITEM']['PROPERTIES']['FILES']['VALUE'] as $k => $file):
            $FileName = $arResult['ITEM']['PROPERTIES']['FILES']['DESCRIPTION'][$k];
            $arFile = CFile::GetFileArray($file);
            $fileSrc = $arFile['SRC'];
            $fileExt = $arFile['CONTENT_TYPE'];
            $fileType = "pdf";
            
            if (strpos($fileExt,"image") !== false)
                $fileType = "img";
            if (strpos($fileExt,"word") !== false || strpos($fileExt,"doc") !== false)
                $fileType = "doc";
            if (strpos($fileExt,"ppt") !== false || strpos($fileExt,"ppt") !== false)
                $fileType = "ppt";
            if (strpos($fileExt,"spreadsheetml") !== false || strpos($fileExt,"excel") !== false || strpos($fileExt,"xls") !== false)
                $fileType = "exl";
            ?>
            <a href="<?=$fileSrc;?>" class="file-item--small">
                <span><i class="icon-file--<?=$fileType;?>"></i></span>
                <b><?=$FileName;?></b>
            </a>
            <?
        endforeach;
    ?>
    </div>
    <?
    endif;?>
</div>
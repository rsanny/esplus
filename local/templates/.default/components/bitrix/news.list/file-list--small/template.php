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
<div class="file-list--small">
<?foreach($arResult['ITEMS'] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    if ($arItem['PROPERTIES']['FILE_LINK']['VALUE']){
        $fileSrc = $arItem['PROPERTIES']['FILE_LINK']['VALUE'];
        $fileExt = GetFileExtension($fileSrc);
    }
    else {
        $arFile = CFile::GetFileArray($arItem['PROPERTIES']['FILE']['VALUE']);
        $fileSrc = $arFile['SRC'];
        $fileExt = $arFile['CONTENT_TYPE'];
    }
    $fileType = "pdf";
    if (strpos($fileExt,"word") !== false || strpos($fileExt,"doc") !== false)
        $fileType = "doc";
    if (strpos($fileExt,"spreadsheetml") !== false || strpos($fileExt,"excel") !== false || strpos($fileExt,"xls") !== false)
        $fileType = "exl";
    ?>
    <a href="<?=$fileSrc;?>" class="file-item--small" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <span><i class="icon-file--<?=$fileType;?>"></i></span>
        <b><?=$arItem['PREVIEW_TEXT']?$arItem['PREVIEW_TEXT']:$arItem['NAME'];?></b>
    </a>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

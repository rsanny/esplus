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

<div class="promo-list">
<?foreach($arResult["ITEMS"] as $arItem):?>

    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $dateStart = explode('/',CIBlockFormatProperties::DateFormat("d/F/Y г.", MakeTimeStamp($arItem['DATE_ACTIVE_FROM'], CSite::GetDateFormat())));
    if (!empty($arItem['DATE_ACTIVE_TO'])) {
        $dateEnd = explode('/',CIBlockFormatProperties::DateFormat("d/F/Y г.", MakeTimeStamp($arItem['DATE_ACTIVE_TO'], CSite::GetDateFormat())));
    }
    else 
        $dateEnd = false;
    ?>

<div class="row no-gutters promo-item mb-30" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
<? if ($arItem['PROPERTIES']['FILES']['VALUE']):?>
        
        <? foreach ($arItem['PROPERTIES']['FILES']['VALUE'] as $k=>$fileId):
            $fileName = $arItem['PROPERTIES']['FILES']['DESCRIPTION'][$k];
            $arFile = CFile::GetFileArray($fileId);
            $icon = FormatHelper::FileType($arFile['CONTENT_TYPE']);
            if (!$fileName) $fileName = $arFile['FILE_NAME'];
        ?>

        <div class="col col-12 col-lg-5">
  <a href="<?=$arFile['SRC'];?>" class="promo-item__img">
                


                <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="<?=$arItem['NAME'];?>" class="img-responsive">
            </a>

<a href="<?=$arFile['SRC'];?>" class="promo-item__img">
</div>
            
        <? endforeach;?>

        <? endif;?>


        
<div class="col col-12 col-lg-7 promo-item__detail">
        <? if ($arItem['PROPERTIES']['FILES']['VALUE']):?>

        <? foreach ($arItem['PROPERTIES']['FILES']['VALUE'] as $k=>$fileId):
            $fileName = $arItem['PROPERTIES']['FILES']['DESCRIPTION'][$k];
            $arFile = CFile::GetFileArray($fileId);
            $icon = FormatHelper::FileType($arFile['CONTENT_TYPE']);
            if (!$fileName) $fileName = $arFile['FILE_NAME'];
        ?>
<div class="promo-item__name"><a href="<?=$arFile['SRC'];?>"><?=$arItem['NAME'];?></a></div>         
        <? endforeach;?>

        <? endif;?>

            <div class="promo-item__preview"><?=$arItem['PREVIEW_TEXT'];?></div>
	</div>
    </div>




<? endforeach;?>





</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>


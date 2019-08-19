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
<div class="row partners-list">
<?foreach($arResult["ITEMS"] as $k=>$arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $date = explode('/',$arItem["DISPLAY_ACTIVE_FROM"]);
    $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>320, 'height'=>320), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    //$arItem["DETAIL_PAGE_URL"]
	?>
    <div class="col col-12 col-sm-6 col-md-4 col-lg-3 " data-wow-delay="0.<?=$k;?>s">
        <a href="javascript:void();" class="partners-list--item js-matchHeight ink-reaction text-center" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <span class="partners-list--item__img">
                <img src="<?=$file['src'];?>" alt="<?=$arItem["NAME"]?>" height="<?=$file['height'];?>" width="<?=$file['width'];?>" class="img-responsive fadeIn">
            </span>
            <span class="partners-list--item__name"><?=$arItem["NAME"]?></span>
        </a>
    </div>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

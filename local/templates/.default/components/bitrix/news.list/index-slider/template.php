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
<section class="index-slider">
<? foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="index-slider--item<? if ($arItem['PROPERTIES']['DARK_MOBILE_BG']['VALUE']):?> mobile-dark-bg<? endif;?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="index-slider--item-vmiddle">
            <div class="container">
                <div class="row">
                    <div class="col col-12 col-md-8 col-xl-6 offset-md-1 offset-xl-0">
                        <div class="index-slider--title"><?=$arItem['PROPERTIES']['BANNER_TITLE']['~VALUE'];?></div>
                        <div class="index-slider--text"><?=$arItem['PREVIEW_TEXT'];?></div>
                        <? if (!empty($arItem['PROPERTIES']['BTN_LINK']['VALUE'])):?>
                        <div class="index-slide--btn">
                            <a href="<?=$arItem['PROPERTIES']['BTN_LINK']['VALUE'];?>" class="btn btn-orange w-170"><span class="fa-angle-btn"><?=$arItem['PROPERTIES']['BTN_LINK']['DESCRIPTION']?$arItem['PROPERTIES']['BTN_LINK']['DESCRIPTION']:$arItem['PROPERTIES']['BTN_LINK']['DEFAULT_VALUE'];?></span></a>
                        </div>
                        <? endif;?>
                    </div>
                </div>                                                                    
            </div>
        </div>
        <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="<?=$arItem['PROPERTIES']['BANNER_TITLE']['VALUE'];?>" class="index-slider--item-img fadeImg">
    <!--/index slide-->
    </div>
<?endforeach;?>
</section>
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

if (!empty($arResult["ITEMS"])) { ?>
    <div class="slider-flow slider-flow--x-2-slides">
        <div class="swiper-container">
            <div class="swiper-wrapper swiper-no-swiping">
                <? foreach ($arResult["ITEMS"] as $key => $arItem) {
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="card card--large card--horizontal card--fade-hover">
                            <div class="card__img">
                                <svg class="socials__icon i-icon">
                                    <use xlink:href="#<?=$arItem["DISPLAY_PROPERTIES"]["ICON"]["VALUE_XML_ID"]?>"></use>
                                </svg>
                            </div>
                            <div class="card__label">
                                <div class="card__title">
	                                <?=$arItem["NAME"]?>
                                </div>
                                <div class="card__desc">
	                                <?=$arItem["PREVIEW_TEXT"]?>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
<? }
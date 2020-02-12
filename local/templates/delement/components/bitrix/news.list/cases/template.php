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
    <div class="slider-cases">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <? foreach ($arResult["ITEMS"] as $key => $arItem) {
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <figure class="case">
                            <? if ($arItem["PREVIEW_PICTURE"]["SRC"]) { ?>
                                <div class="case__bg">
                                    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"/>
                                </div>
                            <? } ?>
                            <figcaption class="case__content">
                                <h3><?=GetMessage("NL_C_TITLE")?></h3>
                                <p>
                                    <?=$arItem["NAME"]?>
                                    <? if ($arItem["DISPLAY_PROPERTIES"]["LINK"]["VALUE"]) { ?>
                                        — <a target="_blank" href="<?=$arItem["DISPLAY_PROPERTIES"]["LINK"]["VALUE"]?>"><?=$arItem["DISPLAY_PROPERTIES"]["LINK"]["VALUE"]?></a>
                                    <? } ?>
                                </p>
                                <? if (!empty($arItem["DISPLAY_PROPERTIES"]["MARKS"]["VALUE_XML_ID"])) { ?>
                                    <ul class="marks">
                                        <? foreach ($arItem["DISPLAY_PROPERTIES"]["MARKS"]["VALUE_XML_ID"] as $key => $arVal) { ?>
                                            <li class="marks__item"><img src="/local/templates/delement/frontend/assets/images/mark-<?=$arVal?>.png" alt="<?=$arItem["DISPLAY_PROPERTIES"]["MARKS"]["VALUE"][$key]?>"></li>
                                        <? } ?>
                                    </ul>
                                <? } ?>
                                <? if ($arItem["PREVIEW_TEXT"]) { ?>
                                    <p><?=$arItem["PREVIEW_TEXT"]?></p>
                                <? } ?>
                                <? if ($arItem["DISPLAY_PROPERTIES"]["TASK"]["~VALUE"]["TEXT"]) { ?>
                                    <h3><?=GetMessage("NL_C_TASK")?></h3>
                                    <p><?=$arItem["DISPLAY_PROPERTIES"]["TASK"]["~VALUE"]["TEXT"]?></p>
                                <? } ?>
                                <? if (!empty($arItem["DISPLAY_PROPERTIES"]["DECISION"]["VALUE"])) { ?>
                                    <h3><?=GetMessage("NL_C_DECISION")?></h3>
                                    <ul>
                                        <? foreach ($arItem["DISPLAY_PROPERTIES"]["DECISION"]["VALUE"] as $arVal) { ?>
                                            <li><?=$arVal?></li>
                                        <? } ?>
                                    </ul>
                                <? } ?>
	                            <? if ($arItem["DISPLAY_PROPERTIES"]["RESULT"]["~VALUE"]["TEXT"]) { ?>
                                    <h3><?=GetMessage("NL_C_RESULT")?></h3>
                                    <p><?=$arItem["DISPLAY_PROPERTIES"]["RESULT"]["~VALUE"]["TEXT"]?></p>
	                            <? } ?>
                            </figcaption>
                        </figure>
                    </div>
                <? } ?>
            </div>
        </div>
        <div class="slider-cases__navigation slider-pagination-buttons">
            <div class="slider-cases__navigation-btn slider-cases__navigation-btn--next">
                <svg class="socials__icon i-icon">
                    <use xlink:href="#icon-left"></use>
                </svg>
            </div>
            <div class="slider-cases__navigation-btn slider-cases__navigation-btn--prev">
                <svg class="socials__icon i-icon">
                    <use xlink:href="#icon-left"></use>
                </svg>
            </div>
        </div>
    </div>
<? }
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
    <div class="slider-offers">
        <div class="swiper-container">
            <div class="swiper-wrapper swiper-no-swiping">
                <? foreach ($arResult["ITEMS"] as $key => $arItem) {
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <a href="#contact" class="link-wrapper link-wrapper--flex popup-modal">
                            <figure class="price-card price-card--fade-hover">
                                <div class="price-card__img ">
                                    <img src="/local/templates/delement/frontend/assets/images/<?=$arItem["DISPLAY_PROPERTIES"]["TYPE"]["VALUE_XML_ID"]?>.png" alt="<?=$arItem["NAME"]?>" />
                                </div>
                                <figcaption class="price-card__label">
                                    <div class="price-card__title">
	                                    <?=$arItem["NAME"]?>
                                    </div>
                                    <? if ($arItem["DISPLAY_PROPERTIES"]["USERS"]["VALUE"]) { ?>
                                        <div class="price-card__desc">
                                            <?=$arItem["DISPLAY_PROPERTIES"]["USERS"]["VALUE"]?>
                                        </div>
                                    <? } ?>
                                    <? if ($arItem["DISPLAY_PROPERTIES"]["PRICE"]["VALUE"]) { ?>
                                        <div class="price-card__price">
                                            <?=$arItem["DISPLAY_PROPERTIES"]["PRICE"]["VALUE"]?> <span>&#8381;</span>
                                        </div>
                                    <? } ?>
                                    <div class="price-card__action">
                                        <button class="btn btn--wide btn--green-bg btn--upper"><?=GetMessage("NL_P_BUY")?></button>
                                    </div>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
<? }
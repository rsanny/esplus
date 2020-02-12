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
    <div class="slider-flow slider-flow--x-3-slides">
        <?foreach ($arResult["ITEMS"] as $key => $arItem) {?>
            <div class="title"><h2>Условия акции</h2></div>
            <div class="descr">Сроки проведения акции:<br>
               <?= $arItem["DISPLAY_PROPERTIES"]['TIME']['VALUE']?>
            </div>
        <? } ?>
        <div class="swiper-container">
            <div class="swiper-wrapper swiper-no-swiping">
                <? foreach ($arResult["ITEMS"] as $key => $arItem) {
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="swiper-slide">
                        <div class="card card--nohover">
                            <div class="card__label">
                                <div class="card__desc">
                                    <h3 class="card__title--orange">Для кого</h3>
                                    <?=$arItem["DISPLAY_PROPERTIES"]['FOR']['~VALUE']['TEXT']?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card card--nohover">
                            <div class="card__label">
                                <div class="card__desc">
                                    <h3 class="card__title--orange"> Условия</h3>
                                    <?=$arItem["PREVIEW_TEXT"]?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card card--nohover">
                            <div class="card__label">
                                <div class="card__desc">
                                    <h3 class="card__title--orange">Детали</h3>
                                    <?=$arItem["DETAIL_TEXT"]?>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
            <div class="slider-flow-pagination"></div>
        </div>
    </div>
<? }
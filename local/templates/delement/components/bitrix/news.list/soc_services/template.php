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
	<div class="socials__content">
		<? foreach ($arResult["ITEMS"] as $arItem) {
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			if (!$arItem["CLASS"]) continue;
			?>
			<div class="socials__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a rel="external" href="<?=$arItem["DISPLAY_PROPERTIES"]["LINK"]["VALUE"]?>" class="socials__link" target="_blank">
					<svg class="socials__icon i-icon">
						<use xlink:href="#icon-<?=$arItem["CLASS"]?>"></use>
					</svg>
				</a>
			</div>
		<? } ?>
	</div>
<? }
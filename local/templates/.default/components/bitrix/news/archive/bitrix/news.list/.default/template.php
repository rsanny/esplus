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
//ShowFileItem in result_modifier.php
?>
<? if ($arResult['FILTERED']):?>
<div class="file-list--small">
<? foreach ($arResult['FILTERED'] as $arItem):?>
<?=ShowFileItem($arItem);?>
<? endforeach;?>
</div>
<?endif;?>
<? if ($arResult['SECTIONS']):?>
<?foreach($arResult['SECTIONS'] as $arSection):?>
    <p class="bg-message bg-warning"><?=$arSection['NAME'];?></p>
    <div class="file-list--small">
    <? foreach ($arSection['ITEMS'] as $arItem):?>
	<?=ShowFileItem($arItem);?>
	<? endforeach;?>
    </div>
<? endforeach;?>
<? endif;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

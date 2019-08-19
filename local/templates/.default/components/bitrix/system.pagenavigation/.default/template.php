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

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>
<div class="pagen">
<?if($arResult["bDescPageNumbering"] === true):?>
	<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<?if($arResult["bSavePage"]):?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="pagen-arrow pagen--prev pull-left"><i class="fa fa-chevron-left"></i><span>Предыдущая страница</span></a>
		<?else:?>
			<?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
				<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="pagen-arrow pagen--prev pull-left"><i class="fa fa-chevron-left"></i><span>Предыдущая страница</span></a>
				|
			<?else:?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="pagen-arrow pagen--prev pull-left"><i class="fa fa-chevron-left"></i><span>Предыдущая страница</span></a>
			<?endif?>
		<?endif?>
	<?else:?>
		<span class="pagen-arrow pagen--prev pull-left"><i class="fa fa-chevron-left"></i><span>Предыдущая страница</span></span>
	<?endif?>
   <?if ($arResult["NavPageNomer"] > 1):?>
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1" class="pagen-arrow pagen--next pull-right"><span>Следущая страница</span><i class="fa fa-chevron-right"></i></a>
	<?else:?>
        <span class="pagen-arrow pagen--next pull-right"><span>Следущая страница</span><i class="fa fa-chevron-right"></i></span>
	<?endif?>
    <div class="pagen-list overflow text-center">
	<?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
		<?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>
		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<span><?=$NavRecordGroupPrint?></span>
		<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>
		<?endif?>
		<?$arResult["nStartPage"]--;?>
	<?endwhile?>
    </div>

	

<?else:?>
	<?if ($arResult["NavPageNomer"] > 1):?>
		<?if($arResult["bSavePage"]):?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="pagen-arrow pagen--prev pull-left"><i class="fa fa-chevron-left"></i><span>Предыдущая страница</span></a>
		<?else:?>
			<?if ($arResult["NavPageNomer"] > 2):?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="pagen-arrow pagen--prev pull-left"><i class="fa fa-chevron-left"></i><span>Предыдущая страница</span></a>
			<?else:?>
				<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="pagen-arrow pagen--prev pull-left"><i class="fa fa-chevron-left"></i><span>Предыдущая страница</span></a>
			<?endif?>
		<?endif?>
	<?else:?>		
		<span class="pagen-arrow pagen--prev pull-left"><i class="fa fa-chevron-left"></i><span>Предыдущая страница</span></span>
	<?endif?>
    <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="pagen-arrow pagen--next pull-right"><span>Следущая страница</span><i class="fa fa-chevron-right"></i></a>
	<?else:?>
        <span  class="pagen-arrow pagen--next pull-right"><span>Следущая страница</span><i class="fa fa-chevron-right"></i></span>
	<?endif?>
    <div class="pagen-list overflow text-center">
	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<span><?=$arResult["nStartPage"]?></span>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>
    </div>
<?endif?>
</div>
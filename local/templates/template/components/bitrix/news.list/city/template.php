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
<!--<pre>--><?//print_r($arResult["ITEMS"])?><!--</pre>-->
<br>
<form action="" id="question">
	<div class="radio for-rules">
		<p><b>Ваш город</b></p>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<label style="margin-bottom: 10px">
		<input type="radio" name="city" value="<?=$arItem["ID"]?>">
		<i class=""></i><span><?=$arItem["NAME"]?></span>
	</label>
	<br>
<?endforeach;?>
		<br>
		<br>
		<p><b>Как вы хотите оплачивать отопление в течении года?</b></p>
		<label style="margin-bottom: 10px">
			<input type="radio" name="answer" value="PREVIEW_TEXT">
			<i class=""></i><span>Я хочу оплачивать отопление равномерно в течении года.</span>
		</label>
		<label style="margin-bottom: 10px">
			<input type="radio" name="answer" value="DETAIL_TEXT">
			<i class=""></i><span>Я хочу оплачивать отопление только в отопительный период. Я за переход к оплате отопления в отопительный период.</span>
		</label>
		<br>
		<br>
		<button class="btn btn-orange w-170" value="Отправить">Отправить</button>
	</div>
</form>
<p class="succ_voice"><b></b></p>

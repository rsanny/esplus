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
<?
function declOfNum($number, $titles)
{
	$cases = array (2, 0, 1, 1, 1, 2);
	return $number." ".$titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ];
}
foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	$dataAllYear+=intval($arItem["PREVIEW_TEXT"]);
	$dataAllSeason+=intval($arItem["DETAIL_TEXT"]);
endforeach;?>
<p><b>Общая статистика по городам:</b></p>
<div id="graph" style="width: 100%;height: auto"></div>
<div style="display: inline-flex;">
<div style="width: 50px;height: 50px;background:#FF4500;" class="square"></div><div style="margin-top: 15px;margin-left:10px;">Я хочу оплачивать отопление равномерно в течении года. - <?=declOfNum($dataAllYear,array('голос', 'голоса', 'голосов'))?></div>
</div>
<div style="display: inline-flex;">
<div style="width: 50px;height: 50px;background:#00FFFF;" class="square"></div><div style="margin-top: 15px;margin-left:10px;">Я хочу оплачивать отопление только в отопительный период. - <?=declOfNum($dataAllSeason,array('голос', 'голоса', 'голосов'))?></div>
</div>
<script>
	Morris.Donut({
		element: 'graph',
		data: [
			{value: <?=$dataAllYear?>, label: 'Равномерно в течении года'},
			{value: <?=$dataAllSeason?>, label: 'В отопительный период'}
		],
		colors: [
			'#FF4500',
			'#00FFFF',
		],
		formatter: function (x) { return x}
	});
</script>


<?foreach($arResult["ITEMS"] as $arItem):?>
	<br>
	<br>
	<br>
	<p><b>Cтатистика по городу <?=$arItem["NAME"]?>:</b></p>
	<div id="graph<?=$arItem["CODE"]?>" style="width: 100%;height: auto"></div>
	<div style="display: inline-flex;">
		<div style="width: 50px;height: 50px;background:#FF4500;" class="square"></div><div style="margin-top: 15px;margin-left:10px;">Я хочу оплачивать отопление равномерно в течении года. - <?=declOfNum(intval($arItem["PREVIEW_TEXT"]),array('голос', 'голоса', 'голосов'))?></div>
	</div>
	<div style="display: inline-flex;">
		<div style="width: 50px;height: 50px;background:#00FFFF;" class="square"></div><div style="margin-top: 15px;margin-left:10px;">Я хочу оплачивать отопление только в отопительный период.- <?=declOfNum(intval($arItem["DETAIL_TEXT"]),array('голос', 'голоса', 'голосов'))?></div>
	</div>
	<script>
		Morris.Donut({
			element: 'graph<?=$arItem["CODE"]?>',
			data: [
				{value: <?=intval($arItem["PREVIEW_TEXT"])?>, label: 'Равномерно в течении года'},
				{value: <?=intval($arItem["DETAIL_TEXT"])?>, label: 'В отопительный период'}
			],
			colors: [
				'#FF4500',
				'#00FFFF',
			],
			formatter: function (x) { return x}
		});
	</script>
<?endforeach;?>
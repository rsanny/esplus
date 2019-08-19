<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):
$previousLevel = 0;
foreach($arResult as $arItem):
    $link = $arItem["LINK"];
    if (
        $arParams['MENU_TYPE']['CODE'] != "shop" && $arParams['IN_SHOP'] || 
        $arParams['MENU_TYPE']['CODE'] == "shop" && !$arParams['IN_SHOP']
    )
    {
        $link = \OptimalGroup\Url::Shop($arItem["LINK"]);
    }
?>
	<? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<? endif?>
	<? if ($arItem["IS_PARENT"]):?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="has-child">
                <?if ($arItem["SELECTED"]):?>
			    <a href="<?=$link?>" class="is-selected"><?=$arItem["TEXT"]?><i class="fa fa-angle-down"></i></a>
			    <? else:?>
			    <a href="<?=$link?>"><?=$arItem["TEXT"]?></a>
			    <? endif;?>
				<ul class="no-list second-level<?if (!$arItem["SELECTED"]):?> none<?endif?>">
		<?endif?>
	<? else:?>
		    <li><a href="<?=$link?>"<?if ($arItem["SELECTED"]):?> class="is-selected"<?endif?>><?=$arItem["TEXT"]?></a></li>
	<? endif;?>
	<? $previousLevel = $arItem["DEPTH_LEVEL"];?>
<? endforeach?>
<? if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<? endif;
endif;?>
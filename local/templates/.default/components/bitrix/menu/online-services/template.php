<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):
?>
<div class="service-tabs--selector text-center clearfix">
    <div class="row">
<?
$c = count($arResult);
foreach($arResult as $k=>$arItem):
?>
    <div class="col col-4 col-md-2 mb-20 mb-sm-0<? if ($c<6 && $k == 0):?> offset-md-<?=6-$c;?><?endif;?>">
    <a href="<?=$arItem["LINK"]?>" class="<?if($arItem["SELECTED"]):?>is-selected <? endif;?>icon-<?=$arItem['PARAMS']['class'];?>"><i><span></span></i><span><?=$arItem["TEXT"]?></span></a>
    </div>
<? endforeach;?>
    </div>
</div>
<? endif?>
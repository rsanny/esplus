<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):
?>
<div class="service-tabs--selector text-center clearfix">
    <div class="row">
        <pre style="display: none;">
            <?print_r($arResult)?>
        </pre>
<?
$c = count($arResult);
foreach($arResult as $k=>$arItem):
?>
    <div class="col col-<? if ($c<6):?>6<? else:?>4<? endif;?> col-md-2 mb-20<? if ($c<6 && $k == 0):?> offset-md-<?=6-$c;?><?endif;?>">
    <a href="<?=$arItem["LINK"]?>" class="<?if($arItem["SELECTED"]):?>is-selected <? endif;?>icon-<?=$arItem['PARAMS']['class'];?>"><i><span></span></i><span><?=$arItem["TEXT"]?></span></a>
    </div>
<? endforeach;?>
    </div>
</div>
<? endif?>
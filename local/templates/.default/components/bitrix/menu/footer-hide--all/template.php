<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):
$t = count($arResult);
$h = ceil($t/2);
$c = 0;

?>
<div class="col col-12 col-md-3">
    <ul class="no-list footer-menu">
    <?
    foreach($arResult as $arItem):
        $link = $arItem["LINK"];
    //if ($arItem["TEXT"] == "Акционерам и инвесторам") continue;
    if ($h==$c):?>
        </ul>
    </div>
    <div class="col col-12 col-md-3">
        <ul class="no-list footer-menu">
    <? endif; ?>
        <li><a href="<?=$link?>"><?=$arItem["TEXT"]?></a></li>
    <? 
    $c++;
    endforeach; ?>
    </ul>
</div>
<? endif;?>
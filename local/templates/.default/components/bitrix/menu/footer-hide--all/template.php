<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php use DorrBitt\ClassDebug\ClassDebug; ?>
<?if (!empty($arResult)):
$t = count($arResult);
$t = 12-4;
$h = ceil($t/2);
$c = 0;

$domExp = explode(".",$_SERVER["SERVER_NAME"]);
if(count($domExp) == 2){
    if($domExp[0] == "komi"){
        $act_dom = 0;
    }
    else{
        $act_dom = 1; 
    }
}
else{
    $act_dom = 0;
}


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
        <?php if($arItem["TEXT"] == "Контакты" 
                 || $arItem["TEXT"] == "Новости" 
                 || $arItem["TEXT"] == "Акции для клиентов" 
                 || $arItem["TEXT"] == "Стандарт качества обслуживания"):?>

        <?php else:?>
        <li><a href="<?=$link?>"><?=$arItem["TEXT"]?></a></li>
        <?php endif;?>
    <? 
    $c++;
    endforeach; ?>
    </ul>
</div>
<? endif;?>
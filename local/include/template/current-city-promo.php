<?
$cityListUrl = AJAX_PATH.'city-list-promo.php';
?>
<div class="is-current--city-promo">
    <div class="container">
        <i class="fa fa-map-marker hidden-sm-down"></i>  <div>Вы действительно находитесь в <?=$_SESSION['BXExtra']['REGION']['IBLOCK']['REGION_IN'];?>?</div> <span>— <a href="#" class="dotted js-CityIsMy">Да, все верно</a></span> <span>— <a href="#" class="dotted
 js-popUp" data-fancybox-type="ajax" data-fancybox-href="/local/include/ajax/city-list-promo.php">Нет, сменить регион</a></span>
    </div>
</div>
<?
$cityListUrl = AJAX_PATH.'city-list.php';
if ($_SESSION['BXExtra']['SITE']['CODE'] == "shop"){
    $cityListUrl .= "?list=shop";
}
?>
<div class="is-current--city">
    <a title="Закрыть" class="is-current--city__close fancybox-close js-CityIsMy"></a>
    <div class="container">
        <div class="mb-20 fs-18 text-center">Вы действительно находитесь в <?=$_SESSION['BXExtra']['REGION']['IBLOCK']['REGION_IN'];?>?</div>
        <div class="overflow text-center">
            <a href="#" class="btn btn-orange js-CityIsMy">Да, все верно</a>
            <a href="#" class="btn btn-grey js-popUp" data-fancybox-type="ajax" data-fancybox-href="<?=$cityListUrl;?>">Нет, сменить регион</a>
        </div>
        <div class="mt-20 fs-16 text-center">От выбора региона зависят условия обслуживания.</div>
    </div>
</div>
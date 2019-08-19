<?
$cityListUrl = AJAX_PATH.'city-list.php';
if ($_SESSION['BXExtra']['SITE']['CODE'] == "shop"){
    $cityListUrl .= "?list=shop";
}
?>
<a href="#" class="header-top--link js-popUp" data-fancybox-type="ajax" data-fancybox-href="<?=$cityListUrl;?>">
    <i class="fa fa-map-marker"></i><span><?=$_SESSION['BXExtra']['REGION']['IBLOCK']['NAME'];?> филиал</span>
</a>
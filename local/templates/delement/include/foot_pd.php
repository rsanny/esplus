<?
if(!empty($arParams['LINK_PD'])){ ?>
    <a href="<?=$arParams['LINK_PD']?>" target="_blank">Политика защиты персональных данных</a>
<?} else {
    $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'].'/privacy/';
    $url = str_replace('promo',$_GET['from'],$url);
    ?>
    <a href="<?=$url?>" target="_blank">Политика защиты персональных данных</a>
<? } ?>
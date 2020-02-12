<?
$url = 'http://'.$_SESSION['BXExtra']['REGION']['IBLOCK']['URL'].'.esplus.ru/offices/';
?>
<?if(!empty($arParams['LINK_CONTACT'])) { ?>
    <a href="<?=$arParams['LINK_CONTACT']?>" target="_blank">Контакты</a>
<? } else { ?>
    <a href="<?=$url?>" target="_blank">Контакты</a>
<? } ?>
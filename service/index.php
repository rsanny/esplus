<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"]."/service/header.php");
if ($SiteSection['CODE'] == "home" && $SiteGroup != "hide_shop_menu" )
    $APPLICATION->SetTitle("Онлайн сервисы");
else 
    $APPLICATION->SetTitle("Сервисы");
?>
<? $APPLICATION->IncludeFile($CurPath . '/content-'.$indexPage.'.php', Array(), Array("MODE"=> "html"));?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оплатить онлайн");
require($_SERVER["DOCUMENT_ROOT"]."/service/header.php");
?>
<? $APPLICATION->IncludeFile($CurPath . '/content-'.$indexPage.'.php', Array(), Array("MODE"=> "html"));?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет Клиента");
require($_SERVER["DOCUMENT_ROOT"]."/service/header.php");
?>

<?

if ($OptimalGroup['DOMAIN'] == "chuvashia")
$APPLICATION->IncludeFile($CurPath . '/content-'.chuvashia.'.php', Array(), Array("MODE"=> "html"));

else 
   $APPLICATION->IncludeFile($CurPath . '/content-'.$indexPage.'.php', Array(), Array("MODE"=> "html"));
?>



<!--<? $APPLICATION->IncludeFile($CurPath . '/content-'.$indexPage.'.php', Array(), Array("MODE"=> "html"));?>-->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
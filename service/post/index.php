<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Передать показания");

require($_SERVER["DOCUMENT_ROOT"]."/service/header.php");
?><?

if ($OptimalGroup['DOMAIN'] == "chuvashia")
$APPLICATION->IncludeFile($CurPath . '/content-'.chuvashia.'.php', Array(), Array("MODE"=> "html"));
else if ($OptimalGroup['DOMAIN'] == "vladimir")
$APPLICATION->IncludeFile($CurPath . '/content-'.vladimir.'.php', Array(), Array("MODE"=> "html"));
else if ($OptimalGroup['DOMAIN'] == "kirov")
$APPLICATION->IncludeFile($CurPath . '/content-'.kirov.'.php', Array(), Array("MODE"=> "html"));
else if ($OptimalGroup['DOMAIN'] == "samara")
$APPLICATION->IncludeFile($CurPath . '/content-'.samara.'.php', Array(), Array("MODE"=> "html"));

else 
   $APPLICATION->IncludeFile($CurPath . '/content-'.$indexPage.'.php', Array(), Array("MODE"=> "html"));
?>


<!--<? $APPLICATION->IncludeFile($CurPath . '/content-'.$indexPage.'.php', Array(), Array("MODE"=> "html"));?>-->


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
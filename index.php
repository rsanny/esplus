<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//require($_SERVER["DOCUMENT_ROOT"].$IncludePath.'/footer/menu.php');

if ($OptimalGroup['GROUP'] == "hide_all")
    $APPLICATION->IncludeFile(INCLUDE_PATH . 'site/'.$OptimalGroup['SITE']['CODE'].'/hide_all/index.php', Array(), Array("SHOW_BORDER"=> false));
else 
    $APPLICATION->IncludeFile(INCLUDE_PATH . 'site/'.$OptimalGroup['SITE']['CODE'].'/index.php', Array(), Array("SHOW_BORDER"=> false));
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
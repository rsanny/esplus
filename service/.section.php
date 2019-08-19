<?
global $OptimalGroup;
if ($OptimalGroup['SITE']['CODE'] == "home" && $OptimalGroup['GROUP'] != "hide_shop_menu")
    $sSectionName = "Онлайн сервисы";
elseif ($OptimalGroup['DOMAIN'] == "chuvashia")
$sSectionName = "Онлайн сервисы";

else 
    $sSectionName = "Сервисы";
?>
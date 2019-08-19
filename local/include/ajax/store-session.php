<?
define("STOP_STATISTICS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if (!empty($_REQUEST['CODE'] == "CATALOG_VIEW")){
    $_SESSION['BXExtra']['CATALOG']['VIEW'] = $_REQUEST['VALUE'];
}
else {
    $_SESSION[$_REQUEST['CODE']] = $_REQUEST['VALUE'];
}

<?
define("STOP_STATISTICS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$SiteCode = \OptimalGroup\SiteSection::Set($_REQUEST['code']);
$OptimalGroupCity = new \OptimalGroup\City;
$CurrentCity = $OptimalGroupCity->Init("m");

return $SiteCode;



<?
define("STOP_STATISTICS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$OptimalGroupCity = new \OptimalGroup\City;
$domain = \OptimalGroup\SiteSection::GetSubDomain();
$CurrentCity = $OptimalGroupCity->SetRegionById($_REQUEST['id'],true, $domain);
if ($domain == "shop"){
    $result = true;
    \OptimalGroup\Catalog::RecalculateCart();
}
echo json_encode(array("result" => $result));
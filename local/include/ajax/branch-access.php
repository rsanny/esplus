<?
define("STOP_STATISTICS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$domain = \OptimalGroup\SiteSection::GetSubDomain(false);
$result['URL'] = "";
//pr($_SESSION['BXExtra']['REGION']['IBLOCK']['URL'],true);
if ($domain != "shop" && $_REQUEST['change_location'] == "y" && $domain != $_SESSION['BXExtra']['REGION']['IBLOCK']['URL']){
    $result['URL'] = \OptimalGroup\Url::Make($_SESSION['BXExtra']['REGION']['IBLOCK']['URL']);
}
$_SESSION['BXExtra']['REGION']['AGREED'] = true;
echo json_encode(array("result" => $result));
<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
*/
$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
$arResult['STOCK_ADDRESS'] = array();
$arResult['STOCK_CITIES'] = array();
$arResult['STOCK'] = \OptimalGroup\Catalog::GetStock($arResult['ID']);
$maxQuantity = 0;
$arContacts = array();

foreach ($arResult['STOCK'] as $arStock){
    $arContacts[] = $arStock['UF_CONTACTS'];
    if ($arStock['PRODUCT_AMOUNT'] > $maxQuantity) 
        $maxQuantity = $arStock['PRODUCT_AMOUNT'];
}
if ($arContacts){
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PROPERTY_*");
    $arFilter = Array("IBLOCK_ID"=>OFFICE_IBLOCK, "ACTIVE"=>"Y", "ID" => $arContacts);
    $res = CIBlockElement::GetList(array("sort"=>"asc"), $arFilter, false, Array("nPageSize"=>50), $arSelect);
    while($ob = $res->GetNextElement()){ 
        $arFields = $ob->GetFields();
        $arFields['PROPERTIES'] = $ob->GetProperties();
        if (!$arResult['STOCK_CITIES'][strtolower($arFields['PROPERTIES']['CITY']['VALUE'])]){
            $arResult['STOCK_CITIES'][strtolower($arFields['PROPERTIES']['CITY']['VALUE'])] = array(
                "NAME" => $arFields['PROPERTIES']['CITY']['VALUE'],
                "ID" => array($arFields['ID'])
            );
        }
        else {
            $arResult['STOCK_CITIES'][strtolower($arFields['PROPERTIES']['CITY']['VALUE'])]['ID'][] = $arFields['ID'];
        }
        $arResult['STOCK_ADDRESS'][$arFields['ID']] = $arFields;
    }
}
$arResult['STOCK_AVAILABILITY'] = \OptimalGroup\Catalog::GetStockView($maxQuantity);

//Get Banner for product .product-detail--banner
$arResult['SERVICE_BANNER'] = array();
$arProductGroups = array();
$db_old_groups = CIBlockElement::GetElementGroups($arResult['ID'], true);
while($ar_group = $db_old_groups->Fetch()){
    $arProductGroups[] = $ar_group;
}
$FirstGroup = current($arProductGroups);
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_SECTION");
$arFilter = Array("IBLOCK_ID"=>50, "ACTIVE"=>"Y", "PROPERTY_SECTION" => $FirstGroup['ID']);
$res = CIBlockElement::GetList(array("sort"=>"asc"), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while($ob = $res->GetNextElement()){ 
    $arFields = $ob->GetFields();
    $arFields['PROPERTIES'] = $ob->GetProperties();
    $arResult['SERVICE_BANNER'] = $arFields;
}
if (isset($arResult['SERVICE_BANNER']) && $arResult['SERVICE_BANNER']['PROPERTIES']['SERVICE']['VALUE']){
    $ServiceId = $arResult['SERVICE_BANNER']['PROPERTIES']['SERVICE']['VALUE'];
    $db_res = CPrice::GetList(array(),array("PRODUCT_ID" => $ServiceId, "CATALOG_GROUP_ID" => $_SESSION['BXExtra']['PRICE']['ID']));
    while ($arPriceRes = $db_res->Fetch()){
        $arResult['SERVICE_BANNER']['SERVICE'] = array(
            "PRICE" => $arPriceRes['PRICE'],
            "CURRENCY"  => $arPriceRes['CURRENCY'],
            "ID" => $arPriceRes['PRODUCT_ID']
        );
    }
}
$cp = $this->__component;
if (is_object($cp))
{
    $cp->SetResultCacheKeys(array('DETAIL_PAGE_URL'));
}
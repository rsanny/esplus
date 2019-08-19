<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */
$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
$arSectionId =
$arIds = array();
foreach ($arResult['ITEMS'] as $arItem){
    $arIds[] = $arItem['ID'];
}

$arStocks = \OptimalGroup\Catalog::GetStock($arIds);
$arInStock = array();
$arNoStock = array();
foreach ($arResult['ITEMS'] as $k=>$arItem){
    $arItem['STOCK'] = $arStocks[$arItem['ID']];
    $maxQuantity = 0;
    foreach ($arItem['STOCK'] as $arStock){
        if ($arStock['PRODUCT_AMOUNT']>$maxQuantity) $maxQuantity = $arStock['PRODUCT_AMOUNT'];
    }
    $arItem['STOCK_AVAILABILITY'] = \OptimalGroup\Catalog::GetStockView($maxQuantity);
    if ($arItem['STOCK_AVAILABILITY']){
        $arInStock[] = $arItem;
    }
    else {
        $arNoStock[] = $arItem;    
    }
    $arSectionId[] = $arItem['IBLOCK_SECTION_ID'];
}
$arSectionId = array_unique($arSectionId);
$arFilter = ['IBLOCK_ID' => $arParams['IBLOCK_ID'], "ID" => $arSectionId];
$rsSect = CIBlockSection::GetList([],$arFilter);
while ($arSect = $rsSect->GetNext())
{
    $arSections[$arSect['ID']] = $arSect['NAME'];
}

$arResult['ITEMS'] = array_merge($arInStock,$arNoStock);

foreach ($arResult['ITEMS'] as $k=>$arItem){
    $arResult['ITEMS'][$k]['SECTION'] = $arSections[$arItem['IBLOCK_SECTION_ID']];
}
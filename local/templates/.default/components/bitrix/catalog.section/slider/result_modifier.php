<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
$arIds = array();
foreach ($arResult['ITEMS'] as $arItem){
    $arIds[] = $arItem['ID'];
}
if ($arIds){
    $arStocks = \OptimalGroup\Catalog::GetStock($arIds);
}
foreach ($arResult['ITEMS'] as $k=>$arItem){
    $arItem['STOCK'] = $arStocks[$arItem['ID']];
    $maxQuantity = 0;
    foreach ($arItem['STOCK'] as $arStock){
        if (!empty($arParams['DEFAULT_STOCK'])){
            if ($arStock['ID'] == $arParams['DEFAULT_STOCK']){
                $maxQuantity = $arStock['PRODUCT_AMOUNT'];
            }
        }
        else {
            if ($arStock['PRODUCT_AMOUNT']>$maxQuantity) $maxQuantity = $arStock['PRODUCT_AMOUNT'];
        }
    }
    
    $arItem['STOCK_AVAILABILITY'] = \OptimalGroup\Catalog::GetStockView($maxQuantity);
    $arResult['ITEMS'][$k] = $arItem;
}
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

function SortCounters($a, $b) {
    if ($a['COUNTER_AMOUT'] == $b['COUNTER_AMOUT']) {
        return 0;
    }
    return ($a['COUNTER_AMOUT'] < $b['COUNTER_AMOUT']) ? -1 : 1;
}
function GetPriceAndName($arIds, $priceId, $iblock){
    $arIds = array_unique($arIds);
    $arResult = array();
    $arStocks = \OptimalGroup\Catalog::GetStock($arIds);
    $db_res = CPrice::GetList(array(),array("PRODUCT_ID" => $arIds,"CATALOG_GROUP_ID" => $priceId));
    while ($arPriceRes = $db_res->Fetch()){
        $arResult[$arPriceRes['PRODUCT_ID']] = array(
            "PRICE" => $arPriceRes['PRICE'],
            "CURRENCY"  => $arPriceRes['CURRENCY'],
            "ID" => $arPriceRes['PRODUCT_ID']
        );
    }
    $arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "ID"=>$arIds);
    $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter);
    while($arElement = $res->GetNext()){
        $file = CFile::ResizeImageGet($arElement['~DETAIL_PICTURE'], array('width'=>330, 'height'=>330), BX_RESIZE_IMAGE_PROPORTIONAL, false);
        
        $arElement['STOCK'] = $arStocks[$arElement['ID']];
        if ($arElement['STOCK']){
            $maxQuantity = 0;
            foreach ($arElement['STOCK'] as $arStock){
                if ($arStock['PRODUCT_AMOUNT']>$maxQuantity) $maxQuantity = $arStock['PRODUCT_AMOUNT'];
            }
            $arResult[$arElement['ID']]["AMOUT"] = \OptimalGroup\Catalog::GetStockView($maxQuantity);
        }
        $arResult[$arElement['ID']]["NAME"] = $arElement['NAME'];
        $arResult[$arElement['ID']]["IMAGE_SRC"] = $file['src'];
        $arResult[$arElement['ID']]["IMAGE"] = $arElement['DETAIL_PICTURE'];
        $arResult[$arElement['ID']]["DETAIL_PAGE_URL"] = $arElement['DETAIL_PAGE_URL'];
    }
    return $arResult;
    
}
$arCounters = 
$arService = 
$arServiceOld = array();

$arResult['SECTIONS'] = 
$arResult['GRID'] = array();

foreach ($arResult['ITEMS'] as $arItem){
    $phases = $arItem['PROPERTIES']['PHASES']['VALUE_XML_ID'];
    $tariff = $arItem['PROPERTIES']['TARIFF']['VALUE_XML_ID'];
    $counter = $arItem['PROPERTIES']['COUNTER']['VALUE'];
    $counterAdd = $arItem['PROPERTIES']['ADD_PRODUCT']['VALUE'];
    $service = $arItem['PROPERTIES']['SERVICE']['VALUE'];
    $serviceOld = $arItem['PROPERTIES']['SERVICEBASE']['VALUE'];
    $arCounters[] = $counter;
    $arCountersAdd[] = $counterAdd;
    $arService[] = $service;
    $arServiceOld[] = $serviceOld;
    $arResult['GRID']['ROW'][$phases][$tariff][$arItem['ID']] = array(
        "ID" => $arItem['ID'],
        "NAME" => $arItem['NAME'],
        "PHASES" => $phases,
        "TARIFF" => $tariff,
        "COUNTER" => $counter,
        "COUNTER_ADD" => $counterAdd,
        "SERVICE" => $service,
        "SERVICE_OLD" => $serviceOld
    );
}
if ($arCounters){    
    $arCounterData = GetPriceAndName($arCounters, $arParams['PRICE_ID'], $arParams['IBLOCK_ID']);
    if ($arCounterData){
        $arResult['GRID']['COUNTERS'] = $arCounterData;    
    }
}

if ($arCountersAdd){    
    $arCounterData = GetPriceAndName($arCountersAdd, $arParams['PRICE_ID'], $arParams['IBLOCK_ID']);
    if ($arCounterData){
        $arResult['GRID']['COUNTER_ADD'] = $arCounterData;    
    }
}

if ($arService){
    $arServiceData = GetPriceAndName($arService, $arParams['PRICE_ID'], $arParams['IBLOCK_ID']);
    if ($arServiceData){
        $arResult['GRID']['SERVICE'] = $arServiceData;    
    }
}
if ($arServiceOld){
    $arServiceOldData = GetPriceAndName($arServiceOld, $arParams['PRICE_ID'], $arParams['IBLOCK_ID']);
    if ($arServiceOldData){
        $arResult['GRID']['SERVICE_OLD'] = $arServiceOldData;    
    }
}

foreach ($arResult['GRID']['ROW'] as $k=>$grid){
    foreach ($grid as $gk=>$gridItem){
        foreach ($gridItem as $ik=>$item){
            $item['COUNTER_NAME'] = $arResult['GRID']['COUNTERS'][$item['COUNTER']]['NAME'];
            $item['COUNTER_AMOUT'] = $arResult['GRID']['COUNTERS'][$item['COUNTER']]['AMOUT'];
            if (empty($item['COUNTER_AMOUT'])){
                $item['COUNTER_AMOUT'] = 0;
            }
            $item['IMAGE'] = $arResult['GRID']['COUNTERS'][$item['COUNTER']]['IMAGE'];
            $item['IMAGE_SRC'] = $arResult['GRID']['COUNTERS'][$item['COUNTER']]['IMAGE_SRC'];
            $counter = $arResult['GRID']['COUNTERS'][$item['COUNTER']]['PRICE'];
            $counterAdd = $arResult['GRID']['COUNTER_ADD'][$item['COUNTER_ADD']];
            $service = $arResult['GRID']['SERVICE'][$item['SERVICE']]['PRICE'];
            $serviceOld = $arResult['GRID']['SERVICE_OLD'][$item['SERVICE_OLD']]['PRICE'];
            if ($counterAdd)
                $counter += $counterAdd['PRICE'];
            if ($counter){//Check if counter has a price if no unset from array
                $item['PRICE'] = array(
                    "NEW" => $counter+$service,
                    "OLD" => ceil($counter+$serviceOld),
                );
                $item['COUNTER'] = $arResult['GRID']['COUNTERS'][$item['COUNTER']];
                $item['COUNTER_ADD'] = $counterAdd;
                $item['SERVICE'] = $arResult['GRID']['SERVICE'][$item['SERVICE']];
                $gridItem[$ik] = $item;
            }
            else {
                unset($gridItem[$ik]);
            }
        }
    
        //pr($gridItem);
        uasort($gridItem,"SortCounters");
        
        if ($gridItem)
            $grid[$gk] = $gridItem; 
        else 
            unset($grid[$gk]);
    }        
    ksort($grid);
    if ($grid)
        $arResult['GRID']['ROW'][$k] = $grid;
    else
        unset($arResult['GRID']['ROW'][$k]);
}
ksort($arResult['GRID']['ROW']);

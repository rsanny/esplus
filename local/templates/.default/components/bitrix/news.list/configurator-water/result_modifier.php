<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

function GetPriceAndName($arIds, $priceId, $iblock){
    $arIds = array_unique($arIds);
    $arResult = array();
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
        $arResult[$arElement['ID']]['NAME'] = $arElement['NAME'];
        $arResult[$arElement['ID']]["DETAIL_PAGE_URL"] = $arElement['DETAIL_PAGE_URL'];
        $arResult[$arElement['ID']]["IMAGE"] = CFile::GetPath($arElement['DETAIL_PICTURE']);
    }
    return $arResult;
}
$arCountersCold = array();
$arCounters = array();
$arService = array();
$arServiceOld = array();

$arResult['SECTIONS'] = 
$arResult['GRID'] = array();

$rsSect = CIBlockSection::GetList(array('SORT' => 'ASC'),array('IBLOCK_ID' => $arParams['IBLOCK_ID']));
while ($arSect = $rsSect->GetNext()){
    $arResult['SECTIONS'][$arSect['ID']] = $arSect;
}

foreach ($arResult['ITEMS'] as $arItem){
    $qunatity = $arItem['PROPERTIES']['QUANTITY']['VALUE'];
    $counter = $arItem['PROPERTIES']['COUNTER']['VALUE'];
    $counterCold = $arItem['PROPERTIES']['COUNTER_COLD']['VALUE'];
    $service = $arItem['PROPERTIES']['SERVICE']['VALUE'];
    $serviceOld = $arItem['PROPERTIES']['SERVICE_OLD']['VALUE'];
    
    $arCounters[] = $counter;
    $arCountersCold[] = $counterCold;
    $arService[] = $service;
    $arServiceOld[] = $serviceOld; 
    
    //SORT FOR БЕТАР
    $k = 1;
    if ($arItem['PROPERTIES']['BRAND']['VALUE'] == "БЕТАР") $k = 0;
    
    $arResult['GRID']['ROW'][$arItem['IBLOCK_SECTION_ID']][$qunatity][$k] = array(
        "ID" => $arItem['ID'],
        "NAME" => $arItem['NAME'],
        "QUANTITY" => $qunatity,
        "COUNTER" => $counter,
        "COUNTER_COLD" => $counterCold,
        "SERVICE" => $service,
        "SERVICE_OLD" => $serviceOld,
        "IMAGE"=> $arItem['PREVIEW_PICTURE']['SRC'],
        "BRAND"=> $arItem['PROPERTIES']['BRAND']['VALUE']
    );
}
if ($arCounters){
    $arCounterData = GetPriceAndName($arCounters, $arParams['PRICE_ID'], $arParams['IBLOCK_ID']);
    $arResult['GRID']['COUNTERS'] = $arCounterData;    
}
if ($arCountersCold){
    $arCounterData = GetPriceAndName($arCountersCold, $arParams['PRICE_ID'], $arParams['IBLOCK_ID']);
    $arResult['GRID']['COUNTER_COLD'] = $arCounterData;    
}
if ($arService){
    $arServiceData = GetPriceAndName($arService, $arParams['PRICE_ID'], $arParams['IBLOCK_ID']);
    $arResult['GRID']['SERVICE'] = $arServiceData;    
}
if ($arServiceOld){
    $arServiceOldData = GetPriceAndName($arServiceOld, $arParams['PRICE_ID'], $arParams['IBLOCK_ID']);
    $arResult['GRID']['SERVICE_OLD'] = $arServiceOldData;    
}
//Resort items in grid
foreach ($arResult['GRID']['ROW'] as $k=>$grid){
    foreach ($grid as $gk=>$gridItem){
        foreach ($gridItem as $ik=>$item){
            $item['COUNTER_NAME'] = $arResult['GRID']['COUNTERS'][$item['COUNTER']]['NAME'];
            $counter = $arResult['GRID']['COUNTERS'][$item['COUNTER']]['PRICE'];
            $service = $arResult['GRID']['SERVICE'][$item['SERVICE']]['PRICE'];
            $serviceOld = $arResult['GRID']['SERVICE_OLD'][$item['SERVICE_OLD']]['PRICE'];
            $item['PRICE'] = array(
                "NEW" => ($counter*$item['QUANTITY'])+$service,
                "OLD" => ($counter+$serviceOld)*$item['QUANTITY'],
            );
            $item['COUNTER'] = $arResult['GRID']['COUNTERS'][$item['COUNTER']];
            $item['COUNTER_COLD'] = $arResult['GRID']['COUNTER_COLD'][$item['COUNTER_COLD']];
            $item['SERVICE'] = $arResult['GRID']['SERVICE'][$item['SERVICE']];
            $item['SERVICE_OLD'] = $arResult['GRID']['SERVICE_OLD'][$item['SERVICE_OLD']];
            
            $gridItem[$ik] = $item;
        }
        ksort($gridItem);
        $grid[$gk] = $gridItem; 
    }        
    ksort($grid);
    $arResult['GRID']['ROW'][$k] = $grid;
}
<?
$arResult['SECTIONS'] = array();
$arResult['BRANCH_NAME'] = array();
$arSectionsId = $arTempSections = $tempBranch =  array();
foreach ($arResult['ITEMS'] as $k=>$arItem){
    $branch = $arItem['PROPERTIES']['BRANCH']['VALUE'];
    if ($branch == $arParams['CURRENT_BRANCH']){
        $tempBranch[$branch]['ITEMS'][] = $arItem;
        unset($arResult['ITEMS'][$k]);
    }
    else {
        $arTempSections[$branch]['ITEMS'][] = $arItem;
    }
    $arResult['BRANCH_NAME'][$branch] = $arItem['NAME'];
}
$temp = $tempBranch + $arTempSections;
$arResult['SECTIONS'] = $temp;
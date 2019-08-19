<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$FilteredList = array();
foreach ($arResult['SECTIONS'] as $arSection){
    if ($arSection['UF_TYPE'] == $arParams['FILTER_TYPE']){
        if (!empty($arParams['FILTER_ID'])){
            if(!in_array($arSection['ID'], $arParams['FILTER_ID']))            
                $FilteredList[] = $arSection;
        }
        else
            $FilteredList[] = $arSection;
    }
}
$arResult['SECTIONS'] = $FilteredList;
foreach ($arResult['SECTIONS'] as $k => &$arSection) {
	$arSection['ACTIVE'] = 'N';
	if ($arSection['CODE'] == $arParams['CURRENT_SECTION_CODE'] || $arSection['ID'] == $arParams['CURRENT_SECTION']) {
		$arSection['ACTIVE'] = 'Y';
		if ($arSection['DEPTH_LEVEL'] == $arParams['CHILD_DEPTH_LEVEL']) {
			$arSection['OPENED'] = 'Y';
		}
	}
    
	if ($arSection['DEPTH_LEVEL'] > $arParams['CHILD_DEPTH_LEVEL']) {
		$arResult['SECTIONS'][$currentTopLevel]['IS_PARENT'] = 'Y';
		$arResult['SECTIONS'][$currentTopLevel]['CHILDREN'][] = $arSection;
		unset($arResult['SECTIONS'][$k]);
		if ($arSection['CODE'] == $arParams['CURRENT_SECTION_CODE'] || $arSection['ID'] == $arParams['CURRENT_SECTION']) {
			$arResult['SECTIONS'][$currentTopLevel]['OPENED'] = 'Y';	
		}
		//$arSection['FIRST_CHILD'] = true;
	} else {
		$currentTopLevel = $k;
	}

}
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arSectionId = array();
$arResult['SECTIONS'] = array();
foreach ($arResult['ITEMS'] as $arItem){
    $arSectionId[] = $arItem['IBLOCK_SECTION_ID'];
}
$arSectionId = array_unique($arSectionId);
if ($arSectionId){
    $rsSect = CIBlockSection::GetList(array('SORT' => 'ASC'),array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $arSectionId, "UF_BRANCH" => $arParams['UF_BRANCH']));
    while ($arSect = $rsSect->GetNext()){
        $arResult['SECTIONS'][$arSect['ID']] = $arSect;
    }
    foreach ($arResult['ITEMS'] as $arItem){
        if ($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']])
            $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
    }
}
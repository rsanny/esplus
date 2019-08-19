<?
$arSectionsId = array();
$arResult['SECTIONS'] = array();

$property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "CODE"=>"YEAR"));
while($enum_fields = $property_enums->GetNext())
{
    $arResult['SECTIONS'][$enum_fields['ID']] = $enum_fields;
}

$arArchive = array();
foreach ($arResult['ITEMS'] as $arItem){
    $Year = $arItem['PROPERTIES']['YEAR']['VALUE_ENUM_ID'];
    $arResult['SECTIONS'][$Year]['ITEMS'][] = $arItem;
}
//$arResult['SECTIONS'] = $arResult['SECTIONS'] + $arArchive;
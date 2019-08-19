<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$FilteredList = array();
foreach ($arResult['SECTIONS'] as $arSection){
    if ($arSection['UF_TYPE'] == CATALOG_TYPE_PRODUCTS){
        $FilteredList[] = $arSection;
    }
}
$arResult['SECTIONS'] = $FilteredList;
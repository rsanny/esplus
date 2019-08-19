<?
$arResult['SECTIONS'] = array();
$rsSect = CIBlockSection::GetList(array('name' => 'desc'),array('IBLOCK_ID' => $arParams['IBLOCK_ID']));
while ($arSect = $rsSect->GetNext()){
    $arResult['SECTIONS'][] = $arSect;
}
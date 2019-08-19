<?
$arSectionsId = array();
$arResult['SECTIONS'] = array();
foreach ($arResult['ITEMS'] as $arItem){
    $arSectionsId[] = $arItem['IBLOCK_SECTION_ID'];
}
$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE'=>'Y', 'ID' => $arSectionsId);
$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
while($ar_result = $db_list->GetNext()){
	$arResult['SECTIONS'][$ar_result['ID']] = $ar_result;
}
foreach ($arResult['ITEMS'] as $arItem){
    $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
}
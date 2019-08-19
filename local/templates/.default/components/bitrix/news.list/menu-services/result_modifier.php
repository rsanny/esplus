<?
$arResult['SECTIONS'] = array();
$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE'=>'Y');
$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
while($ar_result = $db_list->GetNext()){
    if ($ar_result['ID'] == SERVICE_EXCLUDE_SECTION) continue;
	$arResult['SECTIONS'][$ar_result['ID']] = $ar_result;
}
foreach ($arResult['ITEMS'] as $arItem){
    if (isset($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]))
        $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
}
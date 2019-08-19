<?
$arResult['SECTIONS'] = array();
$arSectionsId = $arTempSections = array();
foreach ($arResult['ITEMS'] as $arItem){
    $arTempSections[$arItem['IBLOCK_SECTION_ID']][] = $arItem;
    $arSectionsId[] = $arItem['IBLOCK_SECTION_ID'];
}
$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $arSectionsId);
$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter);
while ($arSection = $rsSections->Fetch())
{
    $arSection['ITEMS'] = $arTempSections[$arSection['ID']];
    $arResult['SECTIONS'][$arSection['ID']] = $arSection;
}
<?
$arResult['SECTIONS'] = array();
$arSectionsId = $arTempSections = $tempBranch = $firstChild = array();
foreach ($arResult['ITEMS'] as $arItem){
    $arTempSections[$arItem['IBLOCK_SECTION_ID']][] = $arItem;
    $tempBranch[$arItem['IBLOCK_SECTION_ID']] = $arItem['PROPERTIES']['BRANCH']['VALUE'];
    $arSectionsId[] = $arItem['IBLOCK_SECTION_ID'];
}
$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $arSectionsId);
$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter);
while ($arSection = $rsSections->Fetch())
{
    $arSection['BRANCH'] = $tempBranch[$arSection['ID']];
    $arSection['ITEMS'] = $arTempSections[$arSection['ID']];
    if ($tempBranch[$arSection['ID']] == $arParams['CURRENT_BRANCH']){
        $firstChild[$arSection['ID']] = $arSection;
    }
    else {
        $arResult['SECTIONS'][$arSection['ID']] = $arSection;
    }
}
//pr($firstChild);
$arResult['SECTIONS'] = array_merge($firstChild, $arResult['SECTIONS']);
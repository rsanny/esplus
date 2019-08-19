<?
$arResult['ARCHIVE_NAME'] = "Архив";
$arResult['YEARS'] = array();
$arArchive = $arDates = array();
foreach ($arResult['ITEMS'] as $arItem){
    $k = $arItem['PROPERTIES']['YEAR']['VALUE'];
    if ($arItem['PROPERTIES']['YEAR']['VALUE'] < 2013) {
        $k = $arResult['ARCHIVE_NAME'];
        $arArchive[$k][$arItem['PROPERTIES']['YEAR']['VALUE']] = $arItem['PROPERTIES']['YEAR']['VALUE'];
    }
    else {
        $arDates[$k] = $arItem['PROPERTIES']['YEAR']['VALUE'];
    }
}
unset($arDates[$arResult['ARCHIVE_NAME']]);
arsort($arDates);
$arResult['YEARS'] = array_merge($arDates,$arArchive);

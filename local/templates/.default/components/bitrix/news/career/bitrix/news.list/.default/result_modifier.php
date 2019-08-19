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
$arResult['SECTIONS'] = array_merge($firstChild, $arResult['SECTIONS']);
//?><!--<pre>--><?//print_r($arResult['SECTIONS'])?><!--</pre>-->
<?/*$UKMO=array_pop($arResult['SECTIONS']);
array_unshift($arResult['SECTIONS'], $UKMO);*/

$UKMOIndex = -1;
foreach ($arResult['SECTIONS'] as $index => $SECTION) {
    if ($SECTION['CODE'] === 'uk-oao-energosbyt-plyus-moskva-i-mo') {
        $UKMOIndex = $index;
        break;
    }
}
if ($UKMOIndex > -1) {
    $UKMO = $arResult['SECTIONS'][$UKMOIndex];
    unset($arResult['SECTIONS'][$UKMOIndex]);
    array_unshift($arResult['SECTIONS'], $UKMO);
}

/*$UKMO = array_filter($arResult['SECTIONS'], function ($section) {
    return $section['CODE'] === 'uk-oao-energosbyt-plyus-moskva-i-mo';
})[0];

if ($_REQUEST['d'] === 'Y') {
    spr($UKMO);
    die;
}

$UKMO=$arResult['SECTIONS'][1];
unset($arResult['SECTIONS'][1]);
array_unshift($arResult['SECTIONS'], $UKMO);*/
?>
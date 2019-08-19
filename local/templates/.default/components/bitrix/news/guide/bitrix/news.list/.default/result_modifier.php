<?
$arResult['HEAD'] = array();
$arResult['ALL'] = array();
$firstPerson = array();
foreach ($arResult['ITEMS'] as $k=>$arItem){
    if ($arItem['PROPERTIES']['HEAD']['VALUE']) {
        $arResult['HEAD'][] = $arItem;
        unset($arResult['ITEMS'][$k]);
    }
    if ($arItem['PROPERTIES']['BRANCH']['VALUE'] == $arParams['CURRENT_BRANCH']) {
        $arResult['HEAD'][] = $arItem;
        unset($arResult['ITEMS'][$k]);
    }
}
$arResult['ALL'] = array_merge($firstPerson,$arResult['ITEMS']);
//pr($arResult['ALL']);
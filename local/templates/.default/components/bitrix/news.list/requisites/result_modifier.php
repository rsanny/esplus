<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$FirstAll[] = reset($arResult["ITEMS"]);
unset($arResult["ITEMS"][0]);
$CurrentBranch = array();
foreach($arResult["ITEMS"] as $k=>$arItem){
    if ($arItem['PROPERTIES']['BRANCH']['VALUE'] == $arParams['CURRENT_BRANCH']){
        $CurrentBranch[] = $arItem;
        unset($arResult['ITEMS'][$k]);
    }
}
$TopElements = array_merge($FirstAll,$CurrentBranch);
$arResult["ITEMS"] = array_merge($TopElements,$arResult["ITEMS"]);
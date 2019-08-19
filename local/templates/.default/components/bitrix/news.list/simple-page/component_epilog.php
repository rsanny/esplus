<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if ($arParams['SET_COSTUME_TITLE'] != "N"){
    global $APPLICATION;
    $APPLICATION->SetTitle($arResult['PAGE_TITLE']);
}
$ipropValues = new Bitrix\Iblock\InheritedProperty\ElementValues($arParams["IBLOCK_ID"], reset($arResult["ELEMENTS"]));
$arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();

if ($arResult["IPROPERTY_VALUES"] && !$arParams['SET_COSTUME_TITLE'])
{
    global $APPLICATION;
    if ($arParams["SET_BROWSER_TITLE"] === 'Y' && $arResult["IPROPERTY_VALUES"]["ELEMENT_META_TITLE"] != "")
        $APPLICATION->SetPageProperty("title", $arResult["IPROPERTY_VALUES"]["ELEMENT_META_TITLE"], $arTitleOptions);

    if ($arParams["SET_META_KEYWORDS"] === 'Y' && $arResult["IPROPERTY_VALUES"]["ELEMENT_META_KEYWORDS"] != "")
        $APPLICATION->SetPageProperty("keywords", $arResult["IPROPERTY_VALUES"]["ELEMENT_META_KEYWORDS"], $arTitleOptions);

    if ($arParams["SET_META_DESCRIPTION"] === 'Y' && $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"] != "")
        $APPLICATION->SetPageProperty("description", $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"], $arTitleOptions);
}

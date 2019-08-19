<?
global ${$arParams["FILTER_NAME"]};
$countFilter = ${$arParams["FILTER_NAME"]};
$countFilter["IBLOCK_ID"] = $arParams["IBLOCK_ID"];
if ($arCurSection["ID"]){
    $countFilter["SECTION_ID"] = $arCurSection["ID"];
}
else {
    $countFilter["SECTION_ID"] = $SectionTypes;
}
$countFilter["INCLUDE_SUBSECTIONS"] = $arParams["INCLUDE_SUBSECTIONS"];
$CoutnInSection = CIBlockElement::GetList(array(), $countFilter, array(), false);


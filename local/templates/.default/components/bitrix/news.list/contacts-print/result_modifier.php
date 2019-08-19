<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$forFilter = array();
foreach($arResult["ITEMS"] as $k=>$arItem){
    if ($arItem['PROPERTIES']['ICONS']['VALUE']) {
        foreach ($arItem['PROPERTIES']['ICONS']['VALUE'] as $k=>$value){
            $forFilter[$arItem['PROPERTIES']['ICONS']['VALUE_ENUM_ID'][$k]] = array(
                "ID" => $arItem['PROPERTIES']['ICONS']['VALUE_ENUM_ID'][$k],
                "NAME" => $value,
                "ICON" => $arItem['PROPERTIES']['ICONS']['VALUE_XML_ID'][$k],
                "SORT" => $arItem['PROPERTIES']['ICONS']['VALUE_SORT'][$k],
            );
        }
    }
}
$filterContent = "";
foreach ($forFilter as $icon){
    $checked = "";
    if (in_array($icon['ID'], $arParams['SELECTED_ICONS'])){
        $checked = " checked";
    }
    $filterContent .= '<label><input name="contacts_type[]" type="checkbox"'.$checked.' value="'.$icon['ID'].'"><i data-text="'.$icon['NAME'].'" data-position="middle" class="icon-'.$icon['ICON'].' js-toolTip"></i></label>';
}
$APPLICATION->AddViewContent("news_icons", $filterContent, "1")
?>
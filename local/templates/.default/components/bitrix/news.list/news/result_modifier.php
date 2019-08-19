<?
$arColors = array();
$arColorsReady = array();
foreach ($arResult['ITEMS'] as $arItem){
    $arColors[] = $arItem['PROPERTIES']['TAG']['VALUE'];
}
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_COLOR");
$res = CIBlockElement::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>12, "ID"=>$arColors), false, false, $arSelect);

while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arColorsReady[$arFields['ID']] = array(
        "ID" => $arFields["ID"],
        "NAME" => $arFields["NAME"],
        "COLOR" => $arFields["PROPERTY_COLOR_VALUE"]
        
    );
}
foreach ($arResult['ITEMS'] as $k=>$arItem){
    $arResult['ITEMS'][$k]['TAG'] = $arColorsReady[$arItem['PROPERTIES']['TAG']['VALUE']];
}
?>

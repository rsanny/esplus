<?
$arResult['YEARS'] = array();
$arResult['TAGS'] = array();
$arTags = array();
foreach ($arResult['ITEMS'] as $arItems){
    $date = explode('/',$arItems['DISPLAY_ACTIVE_FROM']);
    $arResult['YEARS'][] = $date[1];
    if ($arItems['PROPERTIES']['TAG']['VALUE'])
        $arTags[] = $arItems['PROPERTIES']['TAG']['VALUE'];
}
$arTags = array_unique($arTags);
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_COLOR");
$res = CIBlockElement::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>12, "ID"=>$arTags), false, false, $arSelect);

while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arResult['TAGS'][$arFields['ID']] = array(
        "ID" => $arFields["ID"],
        "NAME" => $arFields["NAME"],
        "COLOR" => $arFields["PROPERTY_COLOR_VALUE"]
        
    );
}
$arResult['YEARS'] = array_unique($arResult['YEARS']);

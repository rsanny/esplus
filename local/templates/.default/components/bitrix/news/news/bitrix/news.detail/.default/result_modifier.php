<?
if ($arResult['PROPERTIES']['TAG']['VALUE']){
    $arColorsReady = array();
    $arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_COLOR");
    $res = CIBlockElement::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>12, "ID"=>$arResult['PROPERTIES']['TAG']['VALUE']), false, false, $arSelect);

    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $arColorsReady = array(
            "ID" => $arFields["ID"],
            "NAME" => $arFields["NAME"],
            "COLOR" => $arFields["PROPERTY_COLOR_VALUE"]

        );
    }
    $arResult['TAG'] = $arColorsReady;
}
?>

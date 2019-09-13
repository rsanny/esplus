<?
CModule::IncludeModule("iblock");
$arRegions = array();
$arResult['REGIONS'] = array();
$res = CIBlockElement::GetList(array("sort"=>"asc"), array("IBLOCK_ID"=>BRANCH_IBLOCK, "ACTIVE"=>"Y"), false, Array("nPageSize"=>50), array("ID", "IBLOCK_ID", "NAME", "PROPERTY_EMAIL", "PROPERTY_EMAIL_ZHKU"));
while($ob = $res->GetNextElement()){ 
    $arFields = $ob->GetFields();  
    $arResult['REGIONS'][$arFields['ID']] = array(
        "NAME" => $arFields['NAME'],
        "EMAIL" => $arFields['PROPERTY_EMAIL_VALUE'],
        "EMAIL_ZHKU" => $arFields['PROPERTY_EMAIL_ZHKU_VALUE'],
        "ID" => $arFields['ID']
    );
    if ($_SESSION['BXExtra']['REGION']['IBLOCK']['ID'] == $arFields['ID'])
        $arResult['REGIONS'][$arFields['ID']]['SELECTED'] = "Y";
}
?>
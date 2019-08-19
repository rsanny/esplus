<?
define("STOP_STATISTICS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

if(\CModule::IncludeModule("iblock")) {
    $arResult = array();
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_CITY");
    $arFilter = Array("%PROPERTY_CITY"=>$request['query']);
    $contactsFilter = array(
        "IBLOCK_ID"=>7, 
        "ACTIVE"=>"Y",
        "PROPERTY_BRANCH" => $_SESSION['BXExtra']['REGION']['IBLOCK']['ID'],
        "%PROPERTY_CITY"=>$request['query'],
    );
    $res = CIBlockElement::GetList(Array(), $contactsFilter, false, Array("nPageSize"=>50), $arSelect);
    $SavedCity = array();
    while($ob = $res->GetNextElement()){ 
        $arFields = $ob->GetFields();
        if (!in_array($arFields['PROPERTY_CITY_VALUE'],$SavedCity)){
            $arResult['suggestions'][] = array(
                "value" => $arFields['PROPERTY_CITY_VALUE'],
                "data" => array(
                    'id' => $arFields['ID']
                )
            );
            $SavedCity[] = $arFields['PROPERTY_CITY_VALUE'];
        }
    }
}
if(empty($arResult)){
    $arResult['suggestions'] = array();
}
echo json_encode($arResult);
?>
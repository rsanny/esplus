<?
CModule::IncludeModule("iblock");

$arResult['BRANCH'] = array();
$OptimalGroupCity = new \OptimalGroup\City;
$arBranchList = $OptimalGroupCity->GetBranchList();

foreach ($arBranchList as $arBranch){
    $arResult['BRANCH'][$arBranch['ID']] = array(
        "NAME" => $arBranch['NAME'],
        "ID" => $arBranch['ID']
    );
    if ($arParams['BRANCH_EMAIL']) {
        $arResult['BRANCH'][$arBranch['ID']]['EMAIL'] = $arBranch[$arParams['BRANCH_EMAIL']];
    }
    
    if ($_SESSION['BXExtra']['REGION']['IBLOCK']['ID'] == $arBranch['ID'])
        $arResult['BRANCH'][$arBranch['ID']]['SELECTED'] = "Y";
}

if ($arResult["isFormNote"] == "Y" && $arParams['SUBSCRIBE_ID'] && $_REQUEST['RESULT_ID']){
    $arrVALUES = CFormResult::GetDataByIDForHTML($_REQUEST['RESULT_ID']);
    $email = false;
    foreach ($arrVALUES as $field){
        if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
            $email = $field;
        }
    }
    if ($email){
        CModule::IncludeModule('subscribe');
        $arFields = Array(
            "USER_ID" => false,
            "FORMAT" => "html",
            "EMAIL" => $email,
            "ACTIVE" => "Y",
            "CONFIRMED" => "Y",
            "DATE_CONFIRM" => date("d.m.Y"),
            "RUB_ID" => array($arParams['SUBSCRIBE_ID'])
        );
        $subscr = new CSubscription;
        $ID = $subscr->Add($arFields);
    }
}
?>
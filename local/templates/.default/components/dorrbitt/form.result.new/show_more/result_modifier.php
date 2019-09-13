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
    if ($arParams['BRANCH_EMAIL'])
        $arResult['BRANCH'][$arBranch['ID']]['EMAIL'] = $arBranch[$arParams['BRANCH_EMAIL']];
    
    if ($_SESSION['BXExtra']['REGION']['IBLOCK']['ID'] == $arBranch['ID'])
        $arResult['BRANCH'][$arBranch['ID']]['SELECTED'] = "Y";
}
?>
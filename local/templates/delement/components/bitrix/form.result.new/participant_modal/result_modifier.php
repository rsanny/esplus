<?
CModule::IncludeModule("iblock");

$arResult['BRANCH'] = array();
$OptimalGroupCity = new \OptimalGroup\City;
$arBranchList = $OptimalGroupCity->GetBranchList();

$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'].'/privacy/';
$url = str_replace('promo',$_GET['from'],$url);

if($arParams['DOMAIN'] == 'komi') {
    $arResult['arQuestions']['SIMPLE_QUESTION_399']['COMMENTS'] = 'Нажимая кнопку "Отправить", я предоставляю персональные данные и соглашаюсь с обработкой моих персональных данных АО «Коми энергосбытовая компания» в соответствии с <a target="_blank" href="'.$arParams['URL_PD'].'">Политикой обработки персональных данных</a>';
}
elseif ($arParams['DOMAIN'] == 'ivanovo') {
    $arResult['arQuestions']['SIMPLE_QUESTION_399']['COMMENTS'] = 'Нажимая кнопку "Отправить", я предоставляю персональные данные и соглашаюсь с обработкой моих персональных данных ООО «ЭСК Гарант» в соответствии с <a target="_blank" href="'.$arParams['URL_PD'].'">Политикой обработки персональных данных</a>';
}
else {
    $arResult['arQuestions']['SIMPLE_QUESTION_399']['COMMENTS'] = 'Нажимая кнопку "Отправить", я предоставляю персональные данные и соглашаюсь с обработкой моих персональных данных АО "ЭнергосбыТ Плюс" в соответствии с <a target="_blank" href="https://'.$arParams['DOMAIN'].'.esplus.ru/privacy/">Политикой обработки персональных данных</a>';
}

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
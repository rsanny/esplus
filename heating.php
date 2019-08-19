<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");



if (CModule::IncludeModule("iblock")) {

    $arSelect = Array("ID", "IBLOCK_ID", $_POST["answer"]);//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("IBLOCK_ID"=>53, "ID"=>$_POST["city"],"ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        /*print_r($arFields);
        $arProps = $ob->GetProperties();
        print_r($arProps);*/
        $allVoice=$arFields[$_POST["answer"]];
    }

    if (!empty($allVoice)):
        $newVoice = intval($allVoice) + 1;
    else:
        $newVoice = 1;
    endif;

    $el = new CIBlockElement;

    $arLoadProductArray = Array(
        $_POST["answer"]   => $newVoice,
    );

    $PRODUCT_ID = $_POST["city"];  // изменяем элемент с кодом (ID) 2
    $res = $el->Update($PRODUCT_ID, $arLoadProductArray);

    echo json_encode("Спасибо, Ваш голос учтен!"); // Спасибо! Ваш голос отправлен!
}

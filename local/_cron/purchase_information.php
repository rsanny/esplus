<?
define("STOP_STATISTICS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$arParams = array(
    "IBLOCK" => 23,
    "SUBSCRIBE" => SUBSCRIBE_PURCHASE,
    "EMAIL_CODE" => "SUBSCRIBE_PURCHASE"
);
$arTmpEmails = array(
    "alex2621@gmail.com",
    //"nefedx@yandex.ru",
    //"mbasmanov@optimalgroup.ru",
    //"suzona.mail@gmail.com",
//    "Yuliya.Syromyatnikova@esplus.ru",
//    "Andrey.Vitkov@esplus.ru"
);
CModule::IncludeModule('subscribe');
CModule::IncludeModule('iblock');

$arPurchaseFilter = array(
    'IBLOCK_ID' => $arParams['IBLOCK'],
    '>=PROPERTY_DATE_POST' => date('Y-m-') .(date('d')-1). date(' H:i:s'),
    '<=PROPERTY_DATE_POST' => date('Y-m-d H:i:s'),
    'ACTIVE' => 'Y'
);
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_CREATE", "PROPERTY_DATE_POST");
$res = CIBlockElement::GetList(Array(), $arPurchaseFilter, false, Array("nPageSize"=>50), $arSelect);
$UpdateList = array();
while($ob = $res->GetNextElement()){ 
    $arFields = $ob->GetFields();
    $UpdateList[] = "<p><b>" . $arFields['PROPERTY_DATE_POST_VALUE']."</b> ".$arFields['NAME']."</p>";
}
if ($UpdateList){
    $arSend = array(
        "UPDATE_DATE" => date('Y-m-d'),
        "UPDATE_LIST" => implode("",$UpdateList)
    );
    $arEmailList = array();
    $subscr = CSubscription::GetList(array("ID"=>"ASC"), array("RUBRIC"=>$arParams['SUBSCRIBE']));
    while($subscr_arr = $subscr->Fetch()){
        $arEmailList[] = $subscr_arr['EMAIL'];
    }
    //$arSend['EMAILS'] = implode(", ",$arEmailList);
    //pr($arSend);
    //pr($arEmailList);
    /*foreach ($arTmpEmails as $email){
        $arSend['EMAIL'] = $email;
        if (CEvent::Send($arParams["EMAIL_CODE"], SITE_ID, $arSend, "N")){
            echo "Обновление информации о закупках";
        }
    }*/
}
else {
    echo "Нет обновлений !";
}

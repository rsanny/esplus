<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arResult = array();

if ($_POST['web_form_submit'] == "Зарегистрироваться"){
    if(!check_bitrix_sessid()){
        $arResult['error']['id'] = 'Ошибка запроса';
    }
    $arRequired = array();
    foreach ($arParams['CHECK_NAME'] as $k=>$v)
        $arRequired[$arParams['CHECK'][$k]] = $v;
        
    if(empty($arResult['error']))
    {
        foreach ($_POST['register'] as $name=>$property){
            if (isset($arRequired[$name])){
                if(empty($property)) $errors[$name]  = FormatHelper::Error($arRequired[$name], true);
            }		
        }
        if (!$_POST['register']['sign_rules']){
            $errors['sign_rules'] = "Необходимо принять условия обработки данных";
        }
        if ($_POST['register']['email']){
            if (!filter_var($_POST['register']['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email']  = FormatHelper::Error($arRequired['email'], true);
            }
        }
        if ($errors){
            $arResult['error'] = $errors;
        } 
        else {
            $api = new esplusApi(array(
                'appid' => '40',
                'uid' => 'c4abe6bf-7a57-4e82-8484-c0ca39ca0dc9',
                'key' => 'VyyD|$XVwGdlrh$u#mNDwQxTuSKHaYrQ',
                'channel' => '40',
            ));

            $result = $api->Registration(
                trim($_POST['register']['nlsid']),
                trim($_POST['register']['house']),
                trim($_POST['register']['litera']),
                trim($_POST['register']['flat']),
                trim($_POST['register']['extflat']),
                trim($_POST['register']['email']),
                trim($_POST['register']['password']),
                $_POST['register']['get_actions']=='Y'?'true':'false'
            );
            $arResult['server'] = $result;
            if(!!$result['Code']){
                $arResult['error']['server'] = $result['Message'];
            }
            else {
                $arResult['message'] = true;
            }
        }
    }
}
$this->IncludeComponentTemplate();
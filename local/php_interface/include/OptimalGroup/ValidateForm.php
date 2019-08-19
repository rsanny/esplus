<?
class CFormCustomValidator
{
    
    function ToDB($arParams){
        return serialize($arParams);
    }
    function FromDB($strParams){
        return unserialize($strParams);
    }  
    /*Validate phone number*/
    function GetDescriptionPhone()
    {
        return array(
            "NAME"            => "phone",
            "DESCRIPTION"     => "Валиация телефона",
            "TYPES"           => array("text"),
            "SETTINGS"        => array("CFormCustomValidator", "GetSettingsPhone"),
            "CONVERT_TO_DB"   => array("CFormCustomValidator", "ToDB"),
            "CONVERT_FROM_DB" => array("CFormCustomValidator", "FromDB"),
            "HANDLER"         => array("CFormCustomValidator", "DoValidatePhone")
        );
    }

    function GetSettingsPhone(){
        return array(
            "PATTERN" => array(
                "TITLE"   => "Маска",
                "TYPE"    => "TEXT",
                "DEFAULT" => "/^\+7 \d{3} \d{3} \d{2} \d{2}$/",
            ),
        );
    }  
    function DoValidatePhone($arParams, $arQuestion, $arAnswers, $arValues)
    {
        global $APPLICATION;

        foreach ($arValues as $value){
            if (strlen($value) <= 0) continue;
            if (!preg_match($arParams["PATTERN"], $value)){
                $APPLICATION->ThrowException("Не верный формат номера телефона");
                return false;
            }
        }
        return true;
    }
    
    /* Validate e-mail*/
    function GetDescriptionEmail()
    {
        return array(
            "NAME"            => "email",
            "DESCRIPTION"     => "Валиация e-mail",
            "TYPES"           => array("text"),
            "SETTINGS"        => array("CFormCustomValidator", "GetSettingsEmail"),
            "CONVERT_TO_DB"   => array("CFormCustomValidator", "ToDB"),
            "CONVERT_FROM_DB" => array("CFormCustomValidator", "FromDB"),
            "HANDLER"         => array("CFormCustomValidator", "DoValidateEmail")
        );
    }

    function GetSettingsEmail()
    {
        return array(
            "PATTERN" => array(
                "TITLE"   => "Фильтр",
                "TYPE"    => "TEXT",
                "DEFAULT" => "",
            ),
        );
    }
    function DoValidateEmail($arParams, $arQuestion, $arAnswers, $arValues)
    {
        global $APPLICATION;
        foreach ($arValues as $value){
            if (strlen($value) <= 0) continue;
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $APPLICATION->ThrowException("Введите корректный адрес эл. почты");
                return false;
            }
        }
        return true;
    }
}
$eventManager->addEventHandler("form", "onFormValidatorBuildList", array("CFormCustomValidator", "GetDescriptionPhone"));
$eventManager->addEventHandler("form", "onFormValidatorBuildList", array("CFormCustomValidator", "GetDescriptionEmail"));
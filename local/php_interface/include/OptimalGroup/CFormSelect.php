<?
AddEventHandler("iblock", "OnIBlockPropertyBuildList", array("CIBlockPropertyCFormSelect", "GetUserTypeDescription"));
class CIBlockPropertyCFormSelect {
    function GetUserTypeDescription() {
        return array(
            'PROPERTY_TYPE' => 'S',
            'USER_TYPE' => 'Checkbox',
            'DESCRIPTION' => 'Форма "договора"',
            
            'CheckFields' => array('CIBlockPropertyCFormSelect', 'CheckFields'),
            'GetLength' => array('CIBlockPropertyCFormSelect', 'GetLength'),
            'GetPropertyFieldHtml' => array('CIBlockPropertyCFormSelect', 'GetEditField'),
            'GetAdminListViewHTML' => array('CIBlockPropertyCFormSelect', 'GetFieldView'),
            'GetPublicViewHTML' => array('CIBlockPropertyCFormSelect', 'GetFieldView'),
            'GetPublicEditHTML' => array('CIBlockPropertyCFormSelect', 'GetEditField')
        );
    }
    function CheckFields($arProperty, $value) {
        return array();
    }
    
    function GetLength($arProperty, $value) {
        return strlen($value['VALUE']);
    }
    function GetEditField($arProperty, $value, $htmlElement) {
        //pr($arProperty);
//        pr($value);
//        pr($htmlElement);
        CModule::IncludeModule("form");
        $arFilter = Array(
            "NAME" => "[Заключить договор]",
            "NAME_EXACT_MATCH" => "N",
        );
        $FormSelect = '<select name="'.$htmlElement['VALUE'].'">';
        $FormSelect .= '<option value="">Выберите форму</option>';
        $arSelect = array();
        
        $rsForms = CForm::GetList($by="s_id", $order="desc", $arFilter, $is_filtered);
        while ($arForm = $rsForms->Fetch())
        {
            $selected = '';
            if ($value['VALUE'] == $arForm['ID']){
                $selected = ' selected';
            }
            elseif(!$value['VALUE'] && $arForm['ID'] == $arProperty['DEFAULT_VALUE']){
                $selected = ' selected';
            }
            $FormSelect .= '<option value="'.$arForm['ID'].'"'.$selected.'>'.$arForm['NAME'].'</option>';
        }
        $FormSelect .= '</select>';
        
        return $FormSelect;
    }
    
    function GetFieldView($arProperty, $value, $htmlElement) {
        return $value['VALUE'];
    }
}
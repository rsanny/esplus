<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if(CModule::IncludeModule('iblock'))
    {
        $arBill = CIBlockElement::GetList(
            array(),
            array(
                'ID' => $_REQUEST['bill_id'],
                'IBLOCK_ID' => 32,
                'ACTIVE' => 'Y',
                'PROPERTY_PAYED' => false,
            ),
            false,
            array(
                'nTopCount' => 1
            ),
            array(
                'ID',
                'IBLOCK_ID'
            )
        )->Fetch();

        if(!!$arBill['ID'])
        {
            CIBlockElement::SetPropertyValuesEx($arBill['ID'], $arBill['IBLOCK_ID'], array('PAYED' => date('d.m.Y H:i:s')));

            
        }
    }
?>
<?
COption::SetOptionString("catalog", "DEFAULT_SKIP_SOURCE_CHECK", "Y");
COption::SetOptionString("sale", "secure_1c_exchange", "N"); 

//
// При изменении существующего товара из 1С запрещаем ему менять раздел
//

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate","DoNotUpdate"); 
function DoNotUpdate(&$arFields) 
{ 
    if ($_REQUEST['mode']=='import') 
    { 
		unset($arFields['SECTION_ID']); 
		unset($arFields['IBLOCK_SECTION']); 
    } 
} 
AddEventHandler("iblock", "OnBeforeIBlockElementAdd","DoNotAdd"); 
function DoNotAdd(&$arFields) 
{ 
    if ($_REQUEST['mode']=='import') 
    { 
		unset($arFields['SECTION_ID']); 
		unset($arFields['IBLOCK_SECTION']); 
    } 
} 

//
// Запрещаем создавать/изменять разделы из 1С
//
AddEventHandler("iblock", "OnBeforeIBlockSectionAdd", "OnBefore1CSectionAddUpdate");
AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate", "OnBefore1CSectionAddUpdate");
function OnBefore1CSectionAddUpdate(&$arParams)
{
  if(!!$_SESSION['BX_CML2_IMPORT'] && $arParams['IBLOCK_ID'] == CATALOG_IBLOCK_ID)
  {
    return false;
  }
}

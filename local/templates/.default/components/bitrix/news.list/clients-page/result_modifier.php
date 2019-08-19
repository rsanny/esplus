<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
if (count($arResult["ITEMS"]) == 1)
    $arResult['ITEM'] = reset($arResult["ITEMS"]);

if ($arResult['ITEM']['PROPERTIES']['FAQ']['VALUE']){
    $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), array("IBLOCK_ID"=>"15","ID"=>$arResult['ITEM']['PROPERTIES']['FAQ']['VALUE']), Array("NAME","PREVIEW_TEXT"));
    while($ar_fields = $res->GetNext())
    {
        $arResult['ITEM']['FAQ'][] = $ar_fields;
    }
}

$cp = $this->__component;
if (is_object($cp))
{
    $cp->arResult['PAGE_TITLE'] = $arResult['ITEM']['NAME'];   
    $arResult['PAGE_TITLE'] = $cp->arResult['PAGE_TITLE'];
    $cp->SetResultCacheKeys(array('PAGE_TITLE'));
}
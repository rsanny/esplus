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
    $title = $arResult['ITEM'];
    if ($arResult['ITEM']['PROPERTIES']['TITLE']['VALUE'])
        $title = $arResult['ITEM']['PROPERTIES']['TITLE']['VALUE'];
    $cp->arResult['PAGE_TITLE'] = $title;   
    $cp->arResult['PAGE_URL'] = $arResult['ITEM']['DETAIL_PAGE_URL'];  
    $arResult['PAGE_TITLE'] = $cp->arResult['PAGE_TITLE'];
    $arResult['PAGE_URL'] = $cp->arResult['PAGE_URL'];
    $cp->SetResultCacheKeys(array('PAGE_TITLE'));
}
$k=0;
if ($arResult['ITEM']['PROPERTIES']['CITIES']['VALUE']){
    $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), array("IBLOCK_ID"=>"52","ID"=>$arResult['ITEM']['PROPERTIES']['CITIES']['VALUE']), Array("NAME","PROPERTY_LIST_HOME"));
    while($ar_fields = $res->GetNextElement())
    {
        $arFields = $ar_fields->GetFields();
        $arResult['ITEM']['ARR_CITIES'][$k] = $ar_fields->GetFields();
        $arResult['ITEM']['ARR_CITIES'][$k]['PROPERTY_LIST_HOME_VALUE']=CFile::GetPath($arResult['ITEM']['ARR_CITIES'][$k]['PROPERTY_LIST_HOME_VALUE']);
        $k++;
    }
}
?>
<!--<pre>--><?//print_r($arResult);?><!--</pre>-->
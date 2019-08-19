<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
$cp = $this->__component;
if (is_object($cp))
{
    foreach($arResult['ITEMS'] as $arItem){
        $cp->arResult['PAGE_TITLE'] = $arItem['PROPERTIES']['PAGE_TITLE']['VALUE'];   
        $arResult['PAGE_TITLE'] = $cp->arResult['PAGE_TITLE'];
    }
    $cp->SetResultCacheKeys(array('PAGE_TITLE'));
}
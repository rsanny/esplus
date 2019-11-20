<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\CartSession\CartSession;
use DorrBitt\dbapi\DGAPI;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use Bitrix\Main\Type\Date;
use DorrBitt\dbapi\BElements;

$obj = new BElements();
/*$arParams = [
    "IBLOCK_ID"=>"",
    "arSelect"=>"",
    "arOrder"=>"",
    "arProperty"=>"",
    "PROPERTYID"=>""
];FAIL_VY*/
$arParams["arProperty"] = ["CODE"=>"FAIL_VY"];
//ClassDebug::debug($arParams);
$arResult = $obj->elemList($arParams);
//ClassDebug::debug($rest);
/*
$result = DBXLS::parseExcelFileSimpleXls($fileFull);
for($r = 2; $r <=4;$r++){
    ClassDebug::debug($result[$r]);
}
*/
$this->IncludeComponentTemplate($templatePage);
?>
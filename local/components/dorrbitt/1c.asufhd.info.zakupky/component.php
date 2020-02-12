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
use DorrBitt\dbapi\DBCFILES;
use DorrBitt\ASUFHD1C\ASUFHD1C;
$obj = new BElements();

/** 
* class CartSession array
*/
$user_ses = DGAPI::ses();

if($_SERVER["REQUEST_METHOD"] = "POST"){
if(isset($_POST) && !empty($_POST)){
    $resultArrJson = ASUFHD1C::arrayData($_POST["datajson"]);
    $resultAdd = ASUFHD1C::listAdd($resultArrJson);
    }
}
$arResult["resultAdd"] = $resultAdd;
$this->IncludeComponentTemplate($templatePage);
?>
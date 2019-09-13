<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\DGAPI;
use DorrBitt\DataArefmetikaCapchy\DataArefmetikaCapchy;
use DorrBitt\IB\IBOT;
use DorrBitt\ParseType\ParseType;

$user_ses = DGAPI::ses();
$solgo = DataArefmetikaCapchy::ses_sol();
$ari = DataArefmetikaCapchy::arifmetiks();
$arisave = DataArefmetikaCapchy::ar_save();
$ariResult = "{$arisave[0]}-{$arisave[1]}-{$arisave[2]}";
$provBota = DataArefmetikaCapchy::arf_proverka();
if($provBota == 1 && ParseType::len($_GET["id"]) > 6 && ParseType::len($_GET["name"]) > 3 && ParseType::len($ariResult) > 14){
    print DataArefmetikaCapchy::arf_input($_GET["id"],$_GET["name"],$ariResult);
}
?>
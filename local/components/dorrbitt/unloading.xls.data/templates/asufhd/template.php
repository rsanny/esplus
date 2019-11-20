<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\DBIB\TypeUri;
//ClassDebug::debug($arResult);
$resultProceduru = ($arResult["resultAdd"] == 1) ? "update" : "add";
print("success: {$resultProceduru}");
?>
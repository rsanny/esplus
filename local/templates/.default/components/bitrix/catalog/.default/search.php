<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
global ${$arParams["FILTER_NAME"]};
${$arParams["FILTER_NAME"]}["%NAME"] = $_REQUEST['q'];
?>
<? include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/sections.php");?>
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
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
$arFilter = array(
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "ACTIVE" => "Y",
    "GLOBAL_ACTIVE" => "Y",
    "DEPTH_LEVEL" => 2,
    "UF_BRANCH" => $_SESSION['BXExtra']['REGION']['IBLOCK']['ID']
);
$SectionRule = array(
    'VARIABLES' => $arResult['VARIABLES'],
    'SHOW_ROOT_TEXT' => true,
);
include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/include/section_list.php");

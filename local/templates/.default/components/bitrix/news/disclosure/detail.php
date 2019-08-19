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
$arCurrentSection = array();
$arFilter = array(
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "ACTIVE" => "Y",
    "UF_BRANCH" => $_SESSION['BXExtra']['REGION']['IBLOCK']['ID'],
    "GLOBAL_ACTIVE" => "Y",
);
$arCurrentSection = $arFilter;
$arCurrentSection["=CODE"] = $arResult["VARIABLES"]['SECTION_CURRENT_CODE'];
if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
    $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
    $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
$SectionSelect = array("ID", "DESCRIPTION", "NAME", "UF_*", "DEPTH_LEVEL", "LEFT_MARGIN", "RIGHT_MARGIN", "SECTION_PAGE_URL");
$cache = \Bitrix\Main\Data\Cache::createInstance();
if ($cache->initCache("36000",  serialize(array_merge($arResult["VARIABLES"], $arFilter)), "/iblock/disclosure")) 
{
    $arCurSection = $cache->getVars(); 
} 
elseif ($cache->startDataCache()) 
{
    $arCurSection = array();
    if (Loader::includeModule("iblock"))
    {
        global $CACHE_MANAGER;
        $CACHE_MANAGER->StartTagCache("/iblock/disclosure");
        $TmpName = "";
        $dbRes = CIBlockSection::GetList(array("sort"=>"asc"), $arFilter, false, $SectionSelect);
        if ($SesctionRule['SECTION_URL']){
            $dbRes->SetUrlTemplates("", $SesctionRule["SECTION_URL"]);
        }
        while ($arTmpSection = $dbRes->GetNext()){
            $TmpName = $arTmpSection['NAME'];
            $arCurrentSection["LEFT_MARGIN"] = $arTmpSection['LEFT_MARGIN'] + 1;
            $arCurrentSection["RIGHT_MARGIN"] = $arTmpSection['RIGHT_MARGIN'];
        }
        if ($arCurrentSection['LEFT_MARGIN'] && $arCurrentSection['RIGHT_MARGIN']){
            $dbRes = CIBlockSection::GetList(array("sort"=>"asc"), $arCurrentSection, false, $SectionSelect);
            while ($arRootSection = $dbRes->GetNext()){
                $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
                $arRootSection['ROOT_NAME'] = $TmpName;
                $arCurSection = $arRootSection;
            }
        }
        
    }
    if ($isInvalid) { 
        $cache->abortDataCache(); 
    } 
    $CACHE_MANAGER->EndTagCache();
    $cache->endDataCache($arCurSection); 
}
if ($arCurSection['ROOT_NAME']){
    $APPLICATION->SetTitle($arCurSection['ROOT_NAME']);
}
unset($arResult["VARIABLES"]["SECTION_CODE"]);
unset($arResult["VARIABLES"]["SECTION_CURRENT_CODE"]);
$arResult["VARIABLES"]["SECTION_ID"] = $arCurSection['ID'];
?>
<? if ($arCurSection['DESCRIPTION']):?>
<div class="section-text mb-30"><?=$arCurSection['DESCRIPTION'];?></div>
<? endif;?>
<? include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/include/news_list.php");?>
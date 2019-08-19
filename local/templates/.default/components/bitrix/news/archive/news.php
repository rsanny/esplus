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
use Bitrix\Main\Loader,
    Bitrix\Main\ModuleManager,
    Bitrix\Main\Data\Cache;
$arFilter = array(
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "ACTIVE" => "Y",
    "GLOBAL_ACTIVE" => "Y",
    "DEPTH_LEVEL" => 1
);
$cache = Cache::createInstance(); 
if ($cache->initCache("36000",  serialize($arFilter), "/iblock/archive")) 
{
    $arCurSection = $cache->getVars(); 
} 
elseif ($cache->startDataCache()) 
{
    $arCurSection = array();
    if (Loader::includeModule("iblock"))
    {
        global $CACHE_MANAGER;
        $CACHE_MANAGER->StartTagCache("/iblock/archive");
        
        $RootSection = array();
        $dbRes = CIBlockSection::GetList(array("sort"=>"asc"), $arFilter, false, array("ID", "DESCRIPTION", "SECTION_PAGE_URL", "UF_*", "NAME", "ELEMENT_CNT", "IBLOCK_SECTION_ID"));
        
        $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
        
        while ($arTmpSection = $dbRes->GetNext()){
            $RootSection[] = $arTmpSection['IBLOCK_SECTION_ID'];
            $arCurSection['SECTIONS'][] = $arTmpSection;
        }
    }
    if ($isInvalid) { 
        $cache->abortDataCache(); 
    } 
    $CACHE_MANAGER->EndTagCache();
    $cache->endDataCache($arCurSection); 
}
?>
<div class="file-list--small">
    <? foreach ($arCurSection['SECTIONS'] as $arSection):?>
    <a href="<?=$arSection['SECTION_PAGE_URL'];?>" class="file-item--small">
        <span><i class="icon-file--section"></i></span>
        <b><?=$arSection['NAME'];?></b>
    </a>
    <? endforeach;?>
</div>

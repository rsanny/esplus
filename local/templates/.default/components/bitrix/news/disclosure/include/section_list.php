<?
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
$cache = \Bitrix\Main\Data\Cache::createInstance(); 
if ($cache->initCache("36000",  serialize(array_merge($SectionRule, $arFilter)), "/iblock/disclosure")) 
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
        $RootSection = array();
        $dbRes = CIBlockSection::GetList(array("sort"=>"asc"), $arFilter, false, array("ID", "DESCRIPTION", "SECTION_PAGE_URL", "UF_*", "NAME", "ELEMENT_CNT", "IBLOCK_SECTION_ID"));
        if ($SectionRule['SECTION_URL']){
            $dbRes->SetUrlTemplates("", $SectionRule["SECTION_URL"]);
        }
        while ($arTmpSection = $dbRes->GetNext()){
            $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
            $RootSection[] = $arTmpSection['IBLOCK_SECTION_ID'];
            $arCurSection['SECTIONS'][] = $arTmpSection;
        }
        if ($SectionRule['SHOW_ROOT_TEXT']){//for news.php page (Root folder of section)
            if ($RootSection){
                $RootSection = array_unique($RootSection);
                if (count($RootSection) == 1){
                    $arFilter['ID'] = $RootSection;
                    unset($arFilter['DEPTH_LEVEL']);
                    unset($arFilter['UF_BRANCH']);
                    $dbRes = CIBlockSection::GetList(array("sort"=>"asc"), $arFilter, false, array("ID", "DESCRIPTION", "NAME"));
                    while ($arRoot = $dbRes->GetNext()){
                        $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
                       $arCurSection['ROOT']  = $arRoot;
                    }
                }
            }
        }
    }
    if ($isInvalid) { 
        $cache->abortDataCache(); 
    } 
    $CACHE_MANAGER->EndTagCache();
    $cache->endDataCache($arCurSection); 
}
?>
<? if ($arCurSection['ROOT']['DESCRIPTION']):?>
<div class="mb-30"><?=$arCurSection['ROOT']['DESCRIPTION'];?></div>
<? endif;?>
<div class="file-list--small">
    <? foreach ($arCurSection['SECTIONS'] as $arSection):?>
    <a href="<?=$arSection['SECTION_PAGE_URL'];?>" class="file-item--small">
        <span><i class="icon-file--section"></i></span>
        <b><?=$arSection['NAME'];?></b>
    </a>
    <? endforeach;?>
</div> 
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
$this->setFrameMode(false);
$CacheId = array(
    "QUERY" => $_REQUEST['q'],
    "IBLOCK_ID" => 24,
    'UF_BRANCH' => $_SESSION["BXExtra"]['REGION']['IBLOCK']['ID'],
    'UF_TYPE' => $_SESSION["BXExtra"]['SITE']['ID']
);

$cache = \Bitrix\Main\Data\Cache::createInstance(); 
if ($cache->initCache("360000", serialize($CacheId), "/clients/search")) {
    $arSearchResult = $cache->getVars(); 
} 
elseif ($cache->startDataCache()) {
    CModule::IncludeModule('search');
    global $CACHE_MANAGER;
    $CACHE_MANAGER->StartTagCache("/clients/search");
    $iBlock = 24;
    $arSearchResult = array();
    $arIDs = array();
    $arCompareIDs = array();
    $SearchResorter = array();

    $obSearch = new CSearch;
    $obSearch->SetOptions(array('ERROR_ON_EMPTY_STEM' => false));
    $obSearch->Search(array(
       'QUERY' => $_REQUEST['q'],
       'SITE_ID' => SITE_ID,
       'MODULE_ID' => 'iblock',
       'PARAM2' => array($iBlock)
    ));
    if (!$obSearch->selectedRowsCount()) {
       $obSearch->Search(array(
          'QUERY' => $_REQUEST['q'],
          'SITE_ID' => SITE_ID,
          'MODULE_ID' => 'iblock',
          'PARAM2' => array($iBlock)
       ), array(), array('STEMMING' => false));
    }  
    while ($row = $obSearch->fetch()) {
        $SearchResorter[$row['ID']] = $row;
        if ($row['ITEM_ID'][0] == "S"){
            $SectionId = explode("S",$row['ITEM_ID']);
            $TrueSectionId = end($SectionId);
            $arCompareIDs['SECTION'][$TrueSectionId] = $row['ID'];
            $arIDs['SECTION'][] = $TrueSectionId;
        }
        else {
            $arCompareIDs['ELEMENT'][$row['ITEM_ID']] = $row['ID'];
            $arIDs['ELEMENTS'][] = $row['ITEM_ID'];
        }
    }
    if ($SearchResorter){
        $CACHE_MANAGER->RegisterTag("iblock_id_".$iBlock);
        if ($arIDs['SECTION']){
            $arSectionFilter = array(
                "IBLOCK_ID"=>$iBlock,
                "GLOBAL_ACTIVE"=>"Y",
                "IBLOCK_ACTIVE"=>"Y",
                "ID"=> $arIDs['SECTION'],
                'UF_BRANCH' => $_SESSION["BXExtra"]['REGION']['IBLOCK']['ID'],
                'UF_TYPE' => $_SESSION["BXExtra"]['SITE']['ID']
            );
            $rsSections = CIBlockSection::GetList(array("sort"=>"asc"), $arSectionFilter, false, array("ID", "DEPTH_LEVEL", "NAME", "SECTION_PAGE_URL"));
            while($arSection = $rsSections->GetNext()){
                $SearchSection = $arCompareIDs['SECTION'][$arSection['ID']];
                $SearchResult = $SearchResorter[$SearchSection];
                $SearchResult['IBLOCK'] = $arSection;
                $arSearchResult[] = $SearchResult;
            }
        }
        if ($arIDs['ELEMENTS']){
            $arSelect = array("ID", "IBLOCK_ID", "DETAIL_PAGE_URL", "IBLOCK_SECTION_ID", "NAME", "DEPTH_LEVEL", "PROPERTY_LINK", "PROPERTY_TITLE");
            $arElementFilter = array(
                "IBLOCK_SECTION_ID" => $arResult["SECTIONS_ID"],
                "ACTIVE" => "Y",
                "!CODE" => false,
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "PROPERTY_BRANCH" => $_SESSION["BXExtra"]['REGION']['IBLOCK']['ID'],
                "PROPERTY_TYPE" => $_SESSION["BXExtra"]['SITE']['ID'],
                "ID" => $arIDs['ELEMENTS']
            );
            $rsElements = CIBlockElement::GetList(array("SORT"=>"ASC"), $arElementFilter, false, false, $arSelect);
            while($arElement = $rsElements->GetNext())
            {
                $SearchSection = $arCompareIDs['ELEMENT'][$arElement['ID']];
                $SearchResult = $SearchResorter[$SearchSection];
                $SearchResult['IBLOCK'] = $arElement;
                if ($arElement['PROPERTY_TITLE_VALUE'])
                    $SearchResult['TITLE'] = $arElement['PROPERTY_TITLE_VALUE'];
                if ($arElement['PROPERTY_LINK_VALUE'])
                    $SearchResult['URL'] = $arElement['PROPERTY_LINK_VALUE'];
                else    
                    $SearchResult['URL'] = $arElement['DETAIL_PAGE_URL'];
                $arSearchResult[] = $SearchResult;
            }
        }
    }
    if ($isInvalid) { 
        $cache->abortDataCache(); 
    } 
    $CACHE_MANAGER->EndTagCache();
    $cache->endDataCache($arSearchResult); 
}
?>
<form class="clearfix mb-30" action="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"];?>">
    <button class="btn btn-orange w-170 pull-right">Найти</button>
    <div class="header-search--form__input overflow">
        <i class="fa fa-search"></i>
        <input type="search" name="q" class="form-control" value="<?=$_REQUEST['q'];?>" placeholder="Поиск информации или вопроса" autocomplete="off">
        <a href="#" class="js-input-clear"></a>
    </div>
</form>
<? //pr($arSearchResult);?>
<div class="content-container">
    <? if ($arSearchResult):?>
    <div class="search-result">
    <? $t = count($arSearchResult);?>
    <? 
    foreach ($arSearchResult as $k => $arSearch):
        $SearchUrl = $arSearch['URL'];
        $SearchName = $arSearch['TITLE'];
        if (empty($SearchUrl)) $SearchUrl = $arSearch['IBLOCK']['SECTION_PAGE_URL'];
        if (empty($SearchName)) $SearchName = $arSearch['IBLOCK']['NAME'];
    ?>
        <div class="mb-30">
            <div class="fs-18"><a href="<?=$SearchUrl;?>"><?=$SearchName;?></a></div>
            <? if ($arSearch['BODY_FORMATED']):?>
            <div class="fs-14 color-grey mt-10"><?=$arSearch['BODY_FORMATED'];?></div>
            <? endif;?>
        </div>
        <? if ($t != $k+1):?>
        <hr>
        <? endif;?>
    <? endforeach;?>
    </div>
    <? else:?>
    <font class="color-green fs-18">К сожалению, на ваш поисковый запрос ничего не найдено.</font>
    <? endif;?>
</div>
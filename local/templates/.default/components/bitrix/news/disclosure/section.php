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
    "UF_BRANCH" => $_SESSION['BXExtra']['REGION']['IBLOCK']['ID']
);
if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
    $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
    $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

$obCache = new CPHPCache();
if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/disclosure"))
{
    $arCurSection = $obCache->GetVars();
}
elseif ($obCache->StartDataCache())
{
    $arCurSection = array();
    if (Loader::includeModule("iblock"))
    {
        $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID", "DESCRIPTION", "NAME", "UF_*", "DEPTH_LEVEL", "LEFT_MARGIN", "RIGHT_MARGIN", "CODE"));

        if(defined("BX_COMP_MANAGED_CACHE"))
        {
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache("/iblock/disclosure");

            if ($arCurSection = $dbRes->Fetch())
                $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
            
            $CACHE_MANAGER->EndTagCache();
        }
        else
        {
            if(!$arCurSection = $dbRes->Fetch())
                $arCurSection = array();
        }
    }
    $obCache->EndDataCache($arCurSection);
}
if ($arCurSection):
    $APPLICATION->SetTitle($arCurSection['NAME']);
    if ($arCurSection['DESCRIPTION']):
    ?>
    <div class="section-text mb-30"><?=$arCurSection['DESCRIPTION'];?></div>
    <?
    endif;
    ?>
    <? if ($arCurSection['UF_TYPE']):
        $arFilter = array(
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "ACTIVE" => "Y",
            "GLOBAL_ACTIVE" => "Y",
            "UF_BRANCH" => $_SESSION['BXExtra']['REGION']['IBLOCK']['ID'],
            "LEFT_MARGIN" => $arCurSection['LEFT_MARGIN'] + 1,
            "RIGHT_MARGIN" => $arCurSection['RIGHT_MARGIN'],
            "DEPTH_LEVEL" => $arCurSection['DEPTH_LEVEL']+1
        );
        $SectionRule = array(
            'SECTION_URL' => $arParams['SEF_FOLDER'].'#SECTION_CODE_PATH#/',
            'VARIABLES' => $arResult['VARIABLES']
        );
        include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/include/section_list.php");
    else:
        global ${$arParams['FILTER_NAME']};
        ${$arParams['FILTER_NAME']}['PROPERTY_BRANCH'] = $_SESSION['BXExtra']['REGION']['IBLOCK']['ID'];
        if ($arResult["VARIABLES"]['SECTION_CODE']){
            unset($arResult["VARIABLES"]['SECTION_CODE']);
            $arResult["VARIABLES"]['SECTION_ID'] = $arCurSection['ID'];
        }
        include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/include/news_list.php");
    endif;
endif;
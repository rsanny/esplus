    <?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["ID"] = intval($arParams["ID"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

$arParams["DEPTH_LEVEL"] = intval($arParams["DEPTH_LEVEL"]);
if($arParams["DEPTH_LEVEL"]<=0)
	$arParams["DEPTH_LEVEL"]=1;

$arResult["SECTIONS_ID"] = array();
$arResult["SECTIONS"] = array();
$arResult["ITEMS"] = array();

if($this->StartResultCache("360000", serialize($arParams), "/menu.iblock/"))
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
	}
	else
	{
		$arFilter = array(
			"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
			"GLOBAL_ACTIVE"=>"Y",
			"IBLOCK_ACTIVE"=>"Y",
			//"<="."DEPTH_LEVEL" => $arParams["DEPTH_LEVEL"],
		);
        if ($arParams['SECTION_FILTER'])
            $arFilter = array_merge($arParams['SECTION_FILTER'],$arFilter);
            
		$arOrder = array(
			"sort"=>"asc",
		);

		$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, array(
			"ID",
			"DEPTH_LEVEL",
			"NAME",
			"SECTION_PAGE_URL",
		));
		if($arParams["IS_SEF"] !== "Y")
			$rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
		else
			$rsSections->SetUrlTemplates("", $arParams["SEF_BASE_URL"].$arParams["SECTION_PAGE_URL"]);
		while($arSection = $rsSections->GetNext())
		{
			$arResult["SECTIONS"][] = array(
				"ID" => $arSection["ID"],
				"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
				"~NAME" => $arSection["~NAME"],
				"~SECTION_PAGE_URL" => $arSection["~SECTION_PAGE_URL"],
			);
            $arResult["SECTIONS_ID"][] = $arSection["ID"];
		}
        
        $arSelect = array("ID", "IBLOCK_ID", "DETAIL_PAGE_URL", "IBLOCK_SECTION_ID", "NAME", "DEPTH_LEVEL", "PROPERTY_LINK", "PROPERTY_TITLE");
        $arFilter = array(
            "IBLOCK_SECTION_ID" => $arResult["SECTIONS_ID"],
            "ACTIVE" => "Y",
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        );
        
        if ($arParams['ELEMENT_FILTER'])
            $arFilter = array_merge($arParams['ELEMENT_FILTER'],$arFilter);
        $rsElements = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
        if ($arParams['DETAIL_PAGE_URL'])
            $rsElements->SetUrlTemplates($arParams["SEF_BASE_URL"].$arParams["DETAIL_PAGE_URL"]);
        while($arElement = $rsElements->GetNext())
        {
            if ($arElement['PROPERTY_LINK_VALUE'])
                $arElement['DETAIL_PAGE_URL'] = $arElement['PROPERTY_LINK_VALUE'];
            if ($arElement['PROPERTY_TITLE_VALUE'])
                $arElement['NAME'] = $arElement['PROPERTY_TITLE_VALUE'];
            $arResult["ITEMS"][$arElement['IBLOCK_SECTION_ID']][] = $arElement;
        }
        
		$this->EndResultCache();
	}
}
//In "SEF" mode we'll try to parse URL and get ELEMENT_ID from it
if($arParams["IS_SEF"] === "Y")
{
	$engine = new CComponentEngine($this);
	if (CModule::IncludeModule('iblock'))
	{
		$engine->addGreedyPart("#SECTION_CODE_PATH#");
		$engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
	}
	$componentPage = $engine->guessComponentPath(
		$arParams["SEF_BASE_URL"],
		array(
			"section" => $arParams["SECTION_PAGE_URL"],
			"detail" => $arParams["DETAIL_PAGE_URL"],
		),
		$arVariables
	);
	if($componentPage === "detail")
	{
		CComponentEngine::InitComponentVariables(
			$componentPage,
			array("SECTION_ID", "ELEMENT_ID"),
			array(
				"section" => array("SECTION_ID" => "SECTION_ID"),
				"detail" => array("SECTION_ID" => "SECTION_ID", "ELEMENT_ID" => "ELEMENT_ID"),
			),
			$arVariables
		);
		$arParams["ID"] = intval($arVariables["ELEMENT_ID"]);
	}
}
$aMenuLinksNew = array();
$menuIndex = 0;
$previousDepthLevel = 1;
$SectionIndex = array();
foreach($arResult["SECTIONS"] as $arSection)
{
    $DepthLever = $arSection["DEPTH_LEVEL"]-$arParams['START_DEPTH_LEVEL'];
	if ($menuIndex > 0)
		$aMenuLinksNew[$menuIndex - 1][3]["IS_PARENT"] = $DepthLever > $previousDepthLevel;
	$previousDepthLevel = $DepthLever;
    
    $SectionIndex[$arSection['ID']] = $menuIndex;
	$aMenuLinksNew[$menuIndex++] = array(
		htmlspecialcharsbx($arSection["~NAME"]),
		$arSection["~SECTION_PAGE_URL"],
		"",
		array(
			"FROM_IBLOCK" => true,
			"IS_PARENT" => false,
			"DEPTH_LEVEL" => $DepthLever,
		),
	);
    if ($arResult["ITEMS"][$arSection['ID']]){
        foreach ($arResult["ITEMS"][$arSection['ID']] as $sectionId => $arItem){
            if (empty($arItem['CODE'])) continue;
            $index = $SectionIndex[$arItem['IBLOCK_SECTION_ID']];
            $aMenuLinksNew[$index][3]['IS_PARENT'] = true;
            $aMenuLinksNew[$menuIndex++] = array(
                htmlspecialcharsbx($arItem["NAME"]),
                $arItem["DETAIL_PAGE_URL"],
                "",
                array(
                    "FROM_IBLOCK" => true,
                    "IS_PARENT" => false,
                    "DEPTH_LEVEL" => $DepthLever+1,
                ),
            );
        }
    }
}
return $aMenuLinksNew;
?>

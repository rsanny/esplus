<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

$IblockId = 21;
$aMenuLinksExt = array();
$tree = CIBlockSection::GetTreeList(
    array('IBLOCK_ID' => $IblockId, ">DEPTH_LEVEL" => 1, "GLOBAL_ACTIVE" => "Y", "ACTIVE" => "Y", "UF_BRANCH" => $_SESSION['BXExtra']['REGION']['IBLOCK']['ID']),
    array()
);
$menuIndex = 0;
$previousDepthLevel = 1;
while($arSect = $tree->GetNext()) {
    $DepthLevel = $arSect["DEPTH_LEVEL"];
	if ($menuIndex > 0)
		$aMenuLinksExt[$menuIndex - 1][3]["IS_PARENT"] = $DepthLevel > $previousDepthLevel;
        
	$previousDepthLevel = $DepthLevel;
    
    $aMenuLinksExt[$menuIndex++] = array(
		htmlspecialcharsbx($arSect["~NAME"]),
		$arSect["~SECTION_PAGE_URL"],
		"",
		array(
			"FROM_IBLOCK" => true,
			"IS_PARENT" => false,
			"DEPTH_LEVEL" => $DepthLevel,
		),
	);
}
//pr($aMenuLinksExt);
$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
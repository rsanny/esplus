<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION, $OptimalGroup;
$ClientSection = "/clients/";
if ($OptimalGroup['SITE']['CODE'] == "business"){
    $ClientSection = "/".$OptimalGroup['SITE']['CODE'].$ClientSection;
}
$aMenuLinksExt = $APPLICATION->IncludeComponent("optimalgroup:menu.iblock","",Array(
        "IS_SEF" => "Y", 
        "SEF_BASE_URL" => $ClientSection, 
        "SECTION_PAGE_URL" => "#SECTION_CODE#/", 
        "DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/", 
        "IBLOCK_TYPE" => "information", 
        "IBLOCK_ID" => "24", 
        "START_DEPTH_LEVEL" => "2", 
        "CACHE_TYPE" => "A", 
        "SECTION_FILTER" => array(
            'UF_TYPE' => $OptimalGroup['SITE']['ID'],
            'UF_BRANCH' => $OptimalGroup['BRANCH']['ID'],
        ),
        "CACHE_TIME" => "3600" 
    )
);
$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
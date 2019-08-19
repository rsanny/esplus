<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
if ($arParams['SECTION_ID']) {
    $arTempSections = array();
    $arFilter = array("IBLOCK_ID"=>$arParams['IBLOCK_ID']);
    $arFilter["ID"] = $arParams["SECTION_ID"];
    $rsSections = CIBlockSection::GetList(array("sort"=>"asc"), $arFilter, $arParams["COUNT_ELEMENTS"], $arSelect);
    $rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
    $arResult["SECTION"] = $rsSections->GetNext();
    
    
    unset($arFilter["ID"]);
    $arFilter["LEFT_MARGIN"]=$arResult["SECTION"]["LEFT_MARGIN"]+1;
    $arFilter["RIGHT_MARGIN"]=$arResult["SECTION"]["RIGHT_MARGIN"];
    $arFilter["<="."DEPTH_LEVEL"]=$arResult["SECTION"]["DEPTH_LEVEL"] + 5;
    $rsSections = CIBlockSection::GetList(array("LEFT_MARGIN"=>"ASC"), $arFilter);
	while($arSection = $rsSections->GetNext())
	{
       $arTempSections[$arSection['ID']] = $arSection;
    }
    foreach ($arResult['ITEMS'] as $arItem){
        $SectionId = $arItem['~IBLOCK_SECTION_ID'];
        if ($arTempSections[$SectionId]){
            $CurPrice = reset($arItem['ITEM_PRICES']);
            if ($CurPrice['RATIO_PRICE']){
                $arTempSections[$SectionId]['ITEMS'][] = $arItem;
            }
        }
    }
    foreach ($arTempSections as $k=>$arSection){
        $arTempSections[$k]['SELECTED'] = 'N';
        if ($arSection['CODE'] == $arParams['CURRENT_SECTION_CODE']) {
            $arTempSections[$k]['SELECTED'] = 'Y';
//            if ($arSection['DEPTH_LEVEL'] == 2) {
                $arTempSections[$k]['OPENED'] = 'Y';
//            }
        }

        if ($arSection['DEPTH_LEVEL'] > 2) {
            $arSection['SELECTED'] = "N";
            if ($arSection['CODE'] == $arParams['CURRENT_SECTION_CODE']) {
                $arTempSections[$currentTopLevel]['OPENED'] = 'Y';
                $arSection['SELECTED'] = "Y";
            }
            $arTempSections[$currentTopLevel]['IS_PARENT'] = 'Y';
            $arTempSections[$currentTopLevel]['CHILDREN'][] = $arSection;
            unset($arTempSections[$k]);
            //$arSection['FIRST_CHILD'] = true;
        } else {
            $currentTopLevel = $k;
        }
    }
    //pr($arTempSections);
    $arResult['SECTIONS'] = $arTempSections;
}

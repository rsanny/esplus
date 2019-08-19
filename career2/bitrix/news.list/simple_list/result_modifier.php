<?
$arResult['SECTIONS'] = array();
$arSectionsId = $arTempSections = array();
foreach ($arResult['ITEMS'] as $arItem){
    $arTempSections[$arItem['IBLOCK_SECTION_ID']][] = $arItem;
    $arSectionsId[] = $arItem['IBLOCK_SECTION_ID'];
}
$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $arSectionsId);
$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter);
while ($arSection = $rsSections->Fetch())
{
    $arSection['ITEMS'] = $arTempSections[$arSection['ID']];
    $arResult['SECTIONS'][$arSection['ID']] = $arSection;
}?>

<?$res = CIBlockElement::GetByID($arParams["ELEMENT_ID"]);
if($ar_res = $res->GetNext()) {
        $sectionCareer=$ar_res["IBLOCK_SECTION_ID"];
}

if($sectionCareer=="1787")
{
    $arResult["UK"]["ACTIVE"]="Y";
}
else
{
    $arResult["UK"]["ACTIVE"]="N";

    $sectionCareer="1787";
}

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*","DETAIL_PAGE_URL");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
$arFilter = Array("IBLOCK_ID"=>$arParems["IBLOCK_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","IBLOCK_SECTION_ID"=>$sectionCareer,"!ID"=>$arParams["ELEMENT_ID"]);

$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>99999999), $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arResult["UK"]["ITEMS"][$arFields["ID"]]=$arFields;
}
?>

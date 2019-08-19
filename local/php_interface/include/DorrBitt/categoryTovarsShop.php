<?php
namespace DorrBitt\CategoryTovarsShop;
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\ClassDBase;

class CategoryTovarsShop {

    public function cTovars($arrs){
        
        if(is_array($arrs) && !empty($arrs)){
            $arrResultDataItog = [];
            $arrsFilter = array(
                "ACTIVE" => "Y",
                "IBLOCK_ID" => $arrs['IBLOCK_ID'],
                "IBLOCK_SECTION_ID" => $arrs['IBLOCK_SECTION_ID'],
            );
            $resl = \CIBlockElement::GetList(array(), $arrsFilter, false, false, array("ID"));
            while($ar_fields = $resl->GetNext()){
                $arrResl[] = $ar_fields;
            }

            $secResult = $this->RubSections($arrs);
            foreach($secResult as $resID){
                $arrsFilterS = array(
                    "ACTIVE" => "Y",
                    "IBLOCK_ID" => $arrs['IBLOCK_ID'],
                    "IBLOCK_SECTION_ID" => $resID['ID'],
                );
                $resls = \CIBlockElement::GetList(array(), $arrsFilterS, false, false, array("ID"));
                while($ars_fields = $resls->GetNext()){
                    $arrReslr[] = $ars_fields;
                }
            }
            $eLen = count($arrResl); $rLen = count($arrReslr);
            if($eLen > 0 && $rLen > 0){
                $arrResultDataItog = array_merge($arrResl,$arrReslr);
            }
            elseif($eLen > 0 && $rLen == 0){
                $arrResultDataItog = $arrResl;
            }
            elseif($eLen == 0 && $rLen > 0){
                $arrResultDataItog = $arrReslr;
            }
            else{
                $arrResultDataItog = []; 
            }

            foreach($arrResultDataItog as $elem){

                $dbResult = \CCatalogStore::GetList(
                   array('PRODUCT_ID'=>'ASC','ID' => 'ASC'),
                   array('ACTIVE' => 'Y','PRODUCT_ID'=>$elem["ID"],">PRODUCT_AMOUNT"=>0,"UF_REGION"=>$arrs['UF_REGION']),
                   false,
                   $arNavStartParams = Array("nTopCount"=>1),
                   array("ID","TITLE","ACTIVE","PRODUCT_AMOUNT","ELEMENT_ID")
                );
                while ($arRes =  $dbResult ->GetNext()){
                       $arResult2[] = $arRes;           
               }
            }
        }
        return $arResult2;
    }

    public function RubSections($arrs){
        $objClassDBase = new ClassDBase();
        $arrSects = $objClassDBase->initQuery3(
        "b_iblock_section",
        [
            "b_iblock_section.ID as ID",
        ],
        [
            ["b_iblock_section.IBLOCK_ID","=",$arrs['IBLOCK_ID']],
            ["b_iblock_section.IBLOCK_SECTION_ID","=",$arrs['IBLOCK_SECTION_ID']],
        ],
        "",
        30,
        0
        );
        return $arrSects;
    }

    public function elementss($arrs){
        $objClassDBase = new ClassDBase();
        return $objClassDBase->initQuery3(
        "b_iblock_element",
        [
            "b_iblock_element.ID as ID",
        ],
        [
            ["b_iblock_element.IBLOCK_ID","=",$arrs['IBLOCK_ID']],
            ["b_iblock_element.IBLOCK_SECTION_ID","=",$arrs['IBLOCK_SECTION_ID']],
        ],
        "",
        50,
        0
        );
    }
}
?>
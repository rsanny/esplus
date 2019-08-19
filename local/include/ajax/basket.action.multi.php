<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use DorrBitt\ClassDebug\ClassDebug;
//ClassDebug::debug($_REQUEST);
    //pr($_REQUEST);
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'ADD2BASKET') {
    $CounterId = intval(trim($_REQUEST['COUNTER']['ID']));
    $CounterColdId = intval(trim($_REQUEST['COUNTER_COLD']['ID']));
    $ServiceId = intval(trim($_REQUEST['SERVICE']['ID']));
    
    if (isset($_REQUEST['QUANTITY'])) {
        $quantity = intval($_REQUEST['QUANTITY']);
        if ($quantity <= 0)
            $quantity = 1;
    } else {
        $quantity = 1;
    }
    if (\CModule::IncludeModule("sale") && \CModule::IncludeModule('iblock')) {
        //Counter basket props
        $arCounterProps = array(
            array(
                "NAME" => "С услугой",
                "CODE" => "WITH_SERVICE",
                "VALUE" => $ServiceId
            ),
            array(
                "NAME" => "Тип",
                "CODE" => "TYPE",
                "VALUE" => "PRODUCT"
            ),
            array(
                "NAME" => "Раздел",
                "CODE" => "SECTION",
                "VALUE" => $_REQUEST['type']
            ),
            
        );
        if (isset($_REQUEST['CounterAmout']) && $_REQUEST['CounterAmout'] > 0 || !isset($_REQUEST['CounterAmout'])){
            $arCounter = CIBlockElement::GetByID($CounterId)->Fetch();
            $arCountIblock = CIBlock::GetByID($arCounter['IBLOCK_ID'])->Fetch();
            
            $arCounterFields = array(
                "MODULE" => "catalog",
                "PRODUCT_PROVIDER_CLASS" => "OptimalGroup\CatalogProductProvider",
                "PRODUCT_ID" => $CounterId,
                "QUANTITY" => $_REQUEST['CounterAmout']?$_REQUEST['CounterAmout']:$quantity,
                "CURRENCY" => $_REQUEST['COUNTER']['CURRENCY'],
                "NAME" => $_REQUEST['COUNTER']['NAME'],
                "PRICE" => $_REQUEST['COUNTER']['PRICE'],
                "DETAIL_PAGE_URL"=>$_REQUEST['COUNTER']['DETAIL_PAGE_URL'],
                'PRODUCT_XML_ID' => $arCounter['XML_ID'],
                'CATALOG_XML_ID' => $arCountIblock['XML_ID'],
                "LID" => SITE_ID
            );
            
            if ($_REQUEST['IMAGE']){
                $arCounterProps[] = array(
                    "NAME" => "Фото",
                    "CODE" => "PICTURE",
                    "VALUE" => $_REQUEST['IMAGE']
                );
            }

            $arCounterFields["PROPS"] = $arCounterProps;
            if ($arCounterFields) 
                CSaleBasket::Add($arCounterFields);
        }
        
        
        
        
        if ($_REQUEST['CounterColdAmout']){
            $arCounterCold = CIBlockElement::GetByID($CounterColdId)->Fetch();
            $arCountColdIblock = CIBlock::GetByID($arCounterCold['IBLOCK_ID'])->Fetch();
            
            $arCounterColdFields = array(
                "MODULE" => "catalog",
                "PRODUCT_PROVIDER_CLASS" => "OptimalGroup\CatalogProductProvider",
                "PRODUCT_ID" => $CounterColdId,
                "QUANTITY" => $_REQUEST['CounterColdAmout'],
                "CURRENCY" => $_REQUEST['COUNTER_COLD']['CURRENCY'],
                "NAME" => $_REQUEST['COUNTER_COLD']['NAME'],
                "PRICE" => $_REQUEST['COUNTER_COLD']['PRICE'],
                "DETAIL_PAGE_URL"=>$_REQUEST['COUNTER_COLD']['DETAIL_PAGE_URL'],
                "LID" => SITE_ID,
                'PRODUCT_XML_ID' => $arCounterCold['XML_ID'],
                'CATALOG_XML_ID' => $arCountColdIblock['XML_ID'],
            );
            if ($arCounterColdFields) 
                $arCounterColdFields["PROPS"] = $arCounterProps;
            
            CSaleBasket::Add($arCounterColdFields);
        }
        
        if (!empty($_REQUEST['COUNTER_ADD'])){
            $arCounterAdd = CIBlockElement::GetByID($_REQUEST['COUNTER_ADD']['ID'])->Fetch();
            $arCountAddIblock = CIBlock::GetByID($arCounterAdd['IBLOCK_ID'])->Fetch();
            
            $arCounterAddFields = array(
                "MODULE" => "catalog",
                "PRODUCT_PROVIDER_CLASS" => "OptimalGroup\CatalogProductProvider",
                "PRODUCT_ID" => $_REQUEST['COUNTER_ADD']['ID'],
                "QUANTITY" => 1,
                "CURRENCY" => $_REQUEST['COUNTER_ADD']['CURRENCY'],
                "NAME" => $_REQUEST['COUNTER_ADD']['NAME'],
                "PRICE" => $_REQUEST['COUNTER_ADD']['PRICE'],
                "DETAIL_PAGE_URL"=>$_REQUEST['COUNTER_ADD']['DETAIL_PAGE_URL'],
                "LID" => SITE_ID,
                'PRODUCT_XML_ID' => $arCounterAdd['XML_ID'],
                'CATALOG_XML_ID' => $arCountAddIblock['XML_ID'],
            );
            $arCounterAddFields["PROPS"] = $arCounterProps;
            foreach ($arCounterAddFields["PROPS"] as $k=>$arProp){
                if ($arProp['CODE'] == "PICTURE")
                    unset($arCounterAddFields["PROPS"][$k]);
            }
            $arCounterAddFields["PROPS"][] = array(
                "NAME" => "Фото",
                "CODE" => "PICTURE",
                "VALUE" => $_REQUEST['COUNTER_ADD']['IMAGE']
            );
            CSaleBasket::Add($arCounterAddFields);
        }
        
        //Service basket props
        $arServiceProps = array(
            array(
                "NAME" => "С счетчиком",
                "CODE" => "WITH_COUNTER",
                "VALUE" => $CounterId
            ),
            array(
                "NAME" => "Тип",
                "CODE" => "TYPE",
                "VALUE" => "SERVICE"
            ),
            
        );
        $arService = CIBlockElement::GetByID($ServiceId)->Fetch();
        $arServiceIblock = CIBlock::GetByID($arService['IBLOCK_ID'])->Fetch();
        
        $arServiceFields = array(
            "MODULE" => "catalog",
            "PRODUCT_PROVIDER_CLASS" => "OptimalGroup\CatalogProductProvider",
            "PRODUCT_ID" => $ServiceId,
            "QUANTITY" => "1",
            "CURRENCY" => $_REQUEST['SERVICE']['CURRENCY'],
            "NAME" => $_REQUEST['SERVICE']['NAME'],
            "PRICE" => $_REQUEST['SERVICE']['PRICE'],
            "LID" => SITE_ID,
            'PRODUCT_XML_ID' => $arService['XML_ID'],
            'CATALOG_XML_ID' => $arServiceIblock['XML_ID'],
        );
        $arServiceFields["PROPS"] = $arServiceProps;
        
            
        if (CSaleBasket::Add($arServiceFields)){
            ob_start();
            $APPLICATION->IncludeFile(INCLUDE_PATH . 'template/header.basket.php', Array(), Array("SHOW_BORDER"=> "false"));
            $basket = ob_get_contents();
            ob_end_clean(); 
            //print $basket;
            echo json_encode(array('basket'=>$basket));
        }
        else {
            echo json_encode(array('error'=>"Ошибка добавления счетчика с услугой"));
            //print "Ошибка добавления счетчика с услугой";
        }
    }
}
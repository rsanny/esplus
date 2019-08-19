<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//pr($_REQUEST);
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'ADD2BASKET') {
	if (isset($_REQUEST['service'])) {
        $totalServicies = count($_REQUEST['service']);
        $added = 0;
        if (CModule::IncludeModule("sale") && CModule::IncludeModule('iblock')) {
            foreach ($_REQUEST['service'] as $service){
                $id = intval(trim($service['id']));
                $arProduct = CIBlockElement::GetByID($id)->Fetch();
                $arIblock = CIBlock::GetByID($arProduct['IBLOCK_ID'])->Fetch();
                if (isset($service['quantity'])) {
                    $quantity = intval($service['quantity']);
                    if ($quantity <= 0)
                        $quantity = 1;
                } else {
                    $quantity = 1;
                }

                $arProps = array(
                    array(
                        "NAME" => "Тип",
                        "CODE" => "TYPE",
                        "VALUE" => "SERVICE"
                    ),
                );
                $arFields = array(
                    "MODULE" => "catalog",
                    "PRODUCT_PROVIDER_CLASS" => "OptimalGroup\CatalogProductProvider",
                    "PRODUCT_ID" => $service['id'],
                    "PRODUCT_PRICE_ID" => $service['priceId'],
                    "PRICE_TYPE_ID" => $service['priceTypeId'],
                    "PRICE" => $service['price'],
                    "QUANTITY" => $quantity,
                    "CURRENCY" => "RUB",
                    "LID" => SITE_ID,
                    "NAME" => $service['name'],
                    "DETAIL_PAGE_URL"=>'/electrical-work/',
                    'PRODUCT_XML_ID' => $arProduct['XML_ID'],
                    'CATALOG_XML_ID' => $arIblock['XML_ID'],
                );
                $arFields["PROPS"] = $arProps;
                
                if (CSaleBasket::Add($arFields)){
                   $added++; 
                }            
            }//foreach service
            if ($added = $totalServicies){
                ob_start();
                $APPLICATION->IncludeFile(INCLUDE_PATH . 'template/header.basket.php', Array(), Array("SHOW_BORDER"=> "false"));
                $basket = ob_get_contents();
                ob_end_clean(); 

                echo json_encode(array('basket'=>$basket));
            }
        }
    }
}
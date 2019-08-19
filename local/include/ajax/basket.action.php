<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'ADD2BASKET') {
	if (isset($_REQUEST['id']) && CModule::IncludeModule('iblock')) {
		$id = intval(trim($_REQUEST['id']));
        if (isset($_REQUEST['quantity'])) {
			$quantity = intval($_REQUEST['quantity']);
			if ($quantity <= 0)
				$quantity = 1;
		} else {
			$quantity = 1;
		}
        if (\CModule::IncludeModule("sale") && \CModule::IncludeModule('iblock')) {
            $arProduct = \CIBlockElement::GetByID($id)->Fetch();
            $arIblock = \CIBlock::GetByID($arProduct['IBLOCK_ID'])->Fetch();
            $arProps = array(
                array(
                    "NAME" => "Тип",
                    "CODE" => "TYPE",
                    "VALUE" => "PRODUCT"
                ),
            );
            
            if(empty($_REQUEST['price'])){
                 $_REQUEST['price'] = GetCatalogProductPrice($_REQUEST['id'], $_SESSION['BXExtra']["PRICE"]["ID"])['PRICE'];
                }

            $arFields = array(
                "PRODUCT_ID" => $_REQUEST['id'],
                "PRODUCT_PRICE_ID" => $_REQUEST['priceId'],
                "PRICE_TYPE_ID" => $_REQUEST['priceTypeId'],
                "PRICE" => $_REQUEST['price'],
                "QUANTITY" => $quantity,
                "CURRENCY" => "RUB",
                "LID" => SITE_ID,
                "NAME" => $_REQUEST['name'],
                "DETAIL_PAGE_URL"=>$_REQUEST['url'],
                'PRODUCT_XML_ID' => $arProduct['XML_ID'],
                'CATALOG_XML_ID' => $arIblock['XML_ID'],
                "MODULE" => "catalog",
                "PRODUCT_PROVIDER_CLASS" => "OptimalGroup\CatalogProductProvider",
            );

            if ($_REQUEST['image']){
                $arProps[] = array(
                    "NAME" => "Фото",
                    "CODE" => "PICTURE",
                    "VALUE" => $_REQUEST['image']
                );
            }
            if ($_REQUEST['priceOld']){
                $arProps[] = array(
                    "NAME" => "Старая цена",
                    "CODE" => "PRICE_OLD",
                    "VALUE" => $_REQUEST['priceOld']
                );
            }
            $arFields["PROPS"] = $arProps;
            
            if (CSaleBasket::Add($arFields)){
                ob_start();
                $APPLICATION->IncludeFile(INCLUDE_PATH . 'template/header.basket.php', Array(), Array("SHOW_BORDER"=> "false"));
                $basket = ob_get_contents();
                ob_end_clean(); 

                echo json_encode(array('basket'=>$basket));
            }
        }
    }
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'remove') {
	if (isset($_REQUEST['id'])) {	
		$id = intval(trim($_REQUEST['id']));
		CModule::IncludeModule("sale");	
		if (CSaleBasket::Delete($id)) {
			ob_start();
			$APPLICATION->IncludeFile(INCLUDE_PATH . 'template/header.basket.php', Array(), Array("SHOW_BORDER"=> "false"));
			$basket = ob_get_contents();
			ob_end_clean(); 
			echo json_encode(array('basket'=>$basket));
		}
	}
    if (isset($_REQUEST['service'])) {
        $id = intval(trim($_REQUEST['service']));
		CModule::IncludeModule("sale");	
		CSaleBasket::Delete($id);
    }
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update') {
    
	$result = array();
	$id = intval(trim($_REQUEST['id']));
	$product = intval(trim($_REQUEST['pid']));
	if (isset($_REQUEST['q'])) {
		$quantity = intval($_REQUEST['q']);
		if ($quantity <= 0)
			$quantity = 1;
	} else {
		$quantity = 1;
	}

	if (CModule::IncludeModule("sale")) {
    	CSaleBasket::Update($id, array("PRODUCT_ID"=>$product, "QUANTITY" => $quantity));
	}

    ob_start();
    $APPLICATION->IncludeFile(INCLUDE_PATH . 'template/header.basket.php', Array(), Array("SHOW_BORDER"=> "false"));
    $basket = ob_get_contents();
    ob_end_clean(); 
    
    echo json_encode(array('basket'=>$basket));
}
exit();
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'reload') {
	ob_start();
	$APPLICATION->IncludeFile('/local/include/footer.basket.php', Array(), Array("SHOW_BORDER"=> "false"));
	$basket = ob_get_contents();
	ob_end_clean(); 
	echo $basket;
}


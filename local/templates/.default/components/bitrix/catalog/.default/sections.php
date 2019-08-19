<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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

use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\DGAPI;
use DorrBitt\CategoryTovarsShop\CategoryTovarsShop;
$dev = DGAPI::dev("6bb94a866ca9c9cddf2f73f704e7c176");

$APPLICATION->IncludeFile(INCLUDE_PATH . 'catalog-scripts.php', Array(), Array("SHOW_BORDER"=> false));
$SectionTypes = \OptimalGroup\Catalog::GetSectionsIdByCode('shop');
$inCart = \OptimalGroup\Catalog::InCart();

//pr($inCart['QUANTITY'],true);
$this->setFrameMode(true);
?>
<main class="content">
    <div class="container">
        <?$APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "",
            Array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0"
            )
        );?>
        <div class="page-header">
            <div class="row">
                <div class="col col-12 col-md-8">
                    <h1><?=$APPLICATION->ShowTitle();?></h1>        
                </div>
                <div class="col col-12 col-md-4 mt-20 mt-md-0">
                    <form action="<?=$arResult['FOLDER'];?>" class="catalog-search">
                        <input type="text" class="form-control" name="q" placeholder="Поиск товара" value="<?=$_REQUEST['q'];?>">
                        <button class="btn"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <aside class="col col-12 col-md-4 col-lg-3">
                <?
                $arSettings = array(
                    "CURRENT_SECTION" => $arCurSection['ID']
                );
                ?>
                <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/site/shop/sidebar/links.php', Array("arSettings"=>$arSettings), Array("SHOW_BORDER"=> false));?>
                <?
                if ($arCurSection["ID"]){
                    include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/include/banners.php");
                }
                ?>               
            </aside>
            <section class="col col-12 col-md-8 col-lg-9">
                <?
                //Миша Tradekey, [25.10.17 17:00]
                //пока без фильтра тогда
                /*
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.smart.filter",
                    "",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SECTION_ID" => $arCurSection['ID'],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SAVE_IN_SESSION" => "N",
                        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                        "XML_EXPORT" => "Y",
                        "SECTION_TITLE" => "NAME",
                        "SECTION_DESCRIPTION" => "DESCRIPTION",
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        "SEF_MODE" => $arParams["SEF_MODE"],
                        "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
                        "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );
                ?>
                <form class="section-filter">
                    <div class="filter-title clearfix">
                        <span class="pull-left catalog-section--title">Фильтр</span>
                        <div class="pull-right catalog-section--title">
                            <a href="#" class="clear-filter">Сбросить фильтр</a>
                        </div>
                    </div>
                    <div class="filter-content">
                        <div class="row">
                            <div class="filter-fieldset col col-3">
                                <div class="form-select js-select has-close">
                                    <select>
                                        <option>Количество фаз</option>
                                    </select>
                                    <a href="#" class="clear-select"></a>
                                </div>
                            </div>
                            <div class="filter-fieldset col col-3">
                                <div class="form-select js-select">
                                    <select>
                                        <option>Количество тарифов</option>
                                    </select>
                                </div>
                            </div>
                            <div class="filter-fieldset col col-3">
                                <div class="form-select js-select">
                                    <select>
                                        <option>Способ крепления</option>
                                    </select>
                                </div>
                            </div>
                            <div class="filter-fieldset col col-3">
                                <div class="form-select js-select">
                                    <select>
                                        <option>Цена в руб.</option>
                                    </select>
                                </div>
                            </div>
                        </div>                                        
                    </div>
                </form>*/?>
                <? include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/include/count-products.php");?>
                <? include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/include/sort.php");?>
                
                <?
                if (!$arCurSection["ID"]){
                    ${$arParams["FILTER_NAME"]}['IBLOCK_SECTION_ID'] = $SectionTypes;
                }

                $ParamsForSection = array(
                    "IN_CART"=>$inCart['QUANTITY'],
                    "CATALOG_VIEW" => $arParams['CATALOG_VIEW'],
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                    "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                    "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                    "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                    "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                    "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
                    "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                    "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                    "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                    "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                    "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                    "BASKET_URL" => $arParams["BASKET_URL"],
                    "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                    "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                    "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                    "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                    "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                    "FILTER_NAME" => $arParams["FILTER_NAME"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "SET_TITLE" => $arParams["SET_TITLE"],
                    "MESSAGE_404" => $arParams["~MESSAGE_404"],
                    "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                    "SHOW_404" => $arParams["SHOW_404"],
                    "FILE_404" => $arParams["FILE_404"],
                    "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                    "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                    "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                    "PRICE_CODE" => $arParams["PRICE_CODE"],
                    "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                    "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                    "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                    "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                    "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                    "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                    "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

                    "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                    "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                    "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                    "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                    "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                    "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                    "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                    "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                    "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                    "LAZY_LOAD" => $arParams["LAZY_LOAD"],

                    "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                    "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                    "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                    "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                    "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                    "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                    "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                    "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                    "SHOW_ALL_WO_SECTION"=>"Y",
                    "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                    "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                    "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                    'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                    'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                    'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                    'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                    'LABEL_PROP' => $arParams['LABEL_PROP'],
                    'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                    'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                    'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                    'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                    'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                    'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
                    'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                    'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                    'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                    'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                    'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                    'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                    'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                    'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                    'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                    'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                    'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                    'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                    'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                    'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),
                    'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                    "ADD_SECTIONS_CHAIN" => $arParams['ADD_SECTIONS_CHAIN'],
                    'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                    'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                    'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                    'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
                    'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
                );
                
                if ($_REQUEST['show_all_products']){
                    $ParamsForSection['SHOW_ALL_STOCK'] = $_REQUEST['show_all_products'];
                }
                $GetIDforFilter = \OptimalGroup\Catalog::GetProductsIdByStock($ParamsForSection, ${$arParams["FILTER_NAME"]});
                /*if($dev == 1){
                    //ClassDebug::debug($GetIDforFilter);
                    $arrs = [
                        "IBLOCK_SECTION_ID"=>$arCurSection['ID'],
                        "IBLOCK_ID"=>$arParams["IBLOCK_ID"],
                        "UF_REGION"=>$_SESSION['BXExtra']['REGION']['IBLOCK']['ID'],
                    ];
                    $devArr = [];
                    $devArr = (new CategoryTovarsShop())->cTovars($arrs);
                    //ClassDebug::debug($devArr);
                }*/
                if ($GetIDforFilter){
                    if ($_REQUEST['show_all_products']){
                        $rs = new CDBResult;
                        $rs->InitFromArray($GetIDforFilter);
                        $rs->NavStart($ParamsForSection['PAGE_ELEMENT_COUNT'],false);
                        $IdList = $rs->arResult;
                        ${$arParams["FILTER_NAME"]}['=ID'] = $IdList;
                    }
                    else {
                        ${$arParams["FILTER_NAME"]}['=ID'] = $GetIDforFilter;                    
                    }
                }
                $ParamsForSection['SHOW_IDS'] = $GetIDforFilter;
                $intSectionID = $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "",
                    $ParamsForSection,
                    $component
                );
                if ($_REQUEST['show_all_products']){
                    if($rs->IsNavPrint()){
                         echo $rs->GetPageNavStringEx();
                    }
                }
                $GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;
                ?>     
                <? if ($arCurSection['DESCRIPTION']):?>
                <div class="section-descriotion"><?=$arCurSection['DESCRIPTION'];?></div>
                <? endif;?>
            </section>
        </div>    
    </div>
</main>
<?php 
//if($dev == 1){ ClassDebug::debug($_SESSION["__get_id_for_filter"]); } 
?>
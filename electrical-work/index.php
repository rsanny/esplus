<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Электромонтажные работы");
global $OptimalGroup;
OptimalGroup\Core::AddJs(array("optimalgroup/numbers"));
$prefDomen = (!empty($OptimalGroup['DOMAIN'])) ? $OptimalGroup['DOMAIN'] : "ekb";
$prefDomenData = mb_strtoupper($prefDomen, 'UTF-8');
$parDomPrice = "PRICE_{$prefDomenData}";
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\DGAPI;
use DorrBitt\dbapi\ClassDBase;
$objRubBasa = new ClassDBase();
/*
** array
** Определение минимальной суммы заказа по iD товара. ID = 236485
*/
$tovarIDDefault = 236485;
$tovarIDDefaultPrice = $objRubBasa->initQuery4(
    "b_catalog_price,b_catalog_group",
    [
        "b_catalog_price.PRICE as PRICE",
        "b_catalog_price.CURRENCY as CURRENCY",
        "b_catalog_price.PRICE_SCALE as PRICE_SCALE",
    ],
    [
        ["b_catalog_group.NAME","=",$parDomPrice],  
        ["b_catalog_price.PRODUCT_ID","=",$tovarIDDefault],
        ["b_catalog_group.ID","=","b_catalog_price.CATALOG_GROUP_ID"], 
    ],
    []
  );
  $price_region_min = 0;
  if(is_array($tovarIDDefaultPrice) && count($tovarIDDefaultPrice) > 0){
      if($tovarIDDefaultPrice[0]["CURRENCY"] == "RUB"){
          $price_region_min = $tovarIDDefaultPrice[0]["PRICE"]; 
          $price_region_min = number_format($price_region_min, 0, '', '');
      }
  }
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
        <h1><?=$APPLICATION->ShowTitle();?></h1>
        <div class="row">
            <aside class="col col-12 col-md-4 col-lg-3">
                <?
                $arSettings = array(
                    "CURRENT_SECTION_CODE" => $_REQUEST['SECTION_CODE']
                );
                ?>
                <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/site/shop/sidebar/links.php', Array("arSettings"=>$arSettings), Array("SHOW_BORDER"=> false));?>
            </aside>
            <section class="col col-12 col-md-8 col-lg-9">
            <? if ($OptimalGroup['BRANCH']['SHOP_SERVICE_TEXT']['TEXT']):?>
                <?php if($price_region_min > 0):?>
                    <?php $SHOP_SERVICE_TEXT = "<span class=\"color-orange\">Минимальная сумма заказа: {$price_region_min} руб.</span>"; ?>
                <?php else:?>
                    <?php $SHOP_SERVICE_TEXT = $OptimalGroup['BRANCH']['SHOP_SERVICE_TEXT']['TEXT']; ?>
                <?php endif;?>
                <div class="catalog-section--title"><?=$SHOP_SERVICE_TEXT;?></div>
                <? endif;?>
                <?
                global $arrServiceFilter;
                $arrServiceFilter['PROPERTY_VYGRUZHAT_NA_SAYT_'.strtoupper($OptimalGroup['DOMAIN']).'_VALUE'] = "Да";
                ?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "service-page",
                    Array(
                        "ACTION_VARIABLE" => "action",
                        "ADD_PICT_PROP" => "-",
                        "ADD_PROPERTIES_TO_BASKET" => "Y",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "ADD_TO_BASKET_ACTION" => "ADD",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "BACKGROUND_IMAGE" => "-",
                        "BASKET_URL" => "/personal/basket.php",
                        "BRAND_PROPERTY" => "-",
                        "BROWSER_TITLE" => "-",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "COMPATIBLE_MODE" => "N",
                        "CONVERT_CURRENCY" => "N",
                        "CUSTOM_FILTER" => "",
                        "DATA_LAYER_NAME" => "dataLayer",
                        "DETAIL_URL" => "",
                        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_COMPARE" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "ELEMENT_SORT_FIELD" => "sort",
                        "ELEMENT_SORT_FIELD2" => "id",
                        "ELEMENT_SORT_ORDER" => "asc",
                        "ELEMENT_SORT_ORDER2" => "desc",
                        "ENLARGE_PRODUCT" => "STRICT",
                        "FILTER_NAME" => "arrServiceFilter",
                        "HIDE_NOT_AVAILABLE" => "Y",
                        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                        "IBLOCK_ID" => "41",
                        "IBLOCK_TYPE" => "1c_catalog",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "LABEL_PROP" => array(),
                        "LABEL_PROP_MOBILE" => array(),
                        "LABEL_PROP_POSITION" => "top-left",
                        "LAZY_LOAD" => "N",
                        "LINE_ELEMENT_COUNT" => "3",
                        "LOAD_ON_SCROLL" => "N",
                        "MESSAGE_404" => "",
                        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                        "MESS_BTN_BUY" => "Купить",
                        "MESS_BTN_DETAIL" => "Подробнее",
                        "MESS_BTN_SUBSCRIBE" => "Подписаться",
                        "MESS_NOT_AVAILABLE" => "Нет в наличии",
                        "META_DESCRIPTION" => "-",
                        "META_KEYWORDS" => "-",
                        "OFFERS_LIMIT" => "5",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Товары",
                        "PAGE_ELEMENT_COUNT" => "1000",
                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                        "PRICE_CODE" => array($_SESSION['BXExtra']['PRICE']['NAME']),
                        "PRICE_VAT_INCLUDE" => "Y",
                        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                        "PRODUCT_ID_VARIABLE" => "id",
                        "PRODUCT_PROPERTIES" => array(),
                        "PRODUCT_PROPS_VARIABLE" => "prop",
                        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                        "PRODUCT_SUBSCRIPTION" => "N",
                        "PROPERTY_CODE" => array("SROK_GARANTII_LET", ""),
                        "PROPERTY_CODE_MOBILE" => array(),
                        "RCM_PROD_ID" => "",
                        "RCM_TYPE" => "personal",
                        "SECTION_CODE" => "",
                        "SECTION_CODE_PATH" => "",
                        "CURRENT_SECTION_CODE" => $_REQUEST['SECTION_CODE'],
                        "SECTION_ID" => CATALOG_IBLOCK_SERVICE_SECTION,
                        "SECTION_ID_VARIABLE" => "SECTION_ID",
                        "SECTION_URL" => "",
                        "SECTION_USER_FIELDS" => array("UF_TYPE", ""),
                        "SEF_MODE" => "N",
                        "SEF_RULE" => "",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SHOW_ALL_WO_SECTION" => "Y",
                        "SHOW_CLOSE_POPUP" => "N",
                        "SHOW_DISCOUNT_PERCENT" => "N",
                        "SHOW_FROM_SECTION" => "N",
                        "SHOW_MAX_QUANTITY" => "N",
                        "SHOW_OLD_PRICE" => "N",
                        "SHOW_PRICE_COUNT" => "1",
                        "SHOW_SLIDER" => "N",
                        "SLIDER_INTERVAL" => "3000",
                        "SLIDER_PROGRESS" => "N",
                        "TEMPLATE_THEME" => "blue",
                        "USE_ENHANCED_ECOMMERCE" => "N",
                        "USE_MAIN_ELEMENT_SECTION" => "N",
                        "USE_PRICE_COUNT" => "N",
                        "USE_PRODUCT_QUANTITY" => "N"
                    )
                );?>
                
            </section>
        </div>
    </div>
</main>
<section class="index-section">
    <div class="container">
        <div class="section-title text-center"><span>Остались вопросы?</span></div>
        <div class="row">
            <div class="col col-12 col-sm-8">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "faq",
                    Array(
                        "COLS"=>4,
                        "ACTIVE_DATE_FORMAT" => "d F Y г.",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "N",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "N",
                        "DISPLAY_PREVIEW_TEXT" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array("", ""),
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "15",
                        "IBLOCK_TYPE" => "info",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "10",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Новости",
                        "PARENT_SECTION" => "315",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array("BRANCH", ""),
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER1" => "DESC",
                        "SORT_ORDER2" => "ASC",
                        "STRICT_SECTION_CHECK" => "N"
                    )
                );?>
                
            </div>
            <div class="col col-12 col-sm-4">                
                <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/page/more-question.php', Array(), Array("MODE"=> "html"));?>
            </div>
        </div>
        <? \Optimalgroup\Template::OfferBanners(
            array(
                "arSettings" => array(
                    "NEWS_COUNT" => 2, 
                    "BY_PAGE"=> "Y"
                )
            )
        );?>
    </div>
</section>    
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>
<? $APPLICATION->IncludeComponent(
	"bitrix:sale.order.ajax", 
	".default", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADDITIONAL_PICT_PROP_8" => "-",
		"ALLOW_APPEND_ORDER" => "Y",
		"ALLOW_AUTO_REGISTER" => "Y",
		"ALLOW_NEW_PROFILE" => "N",
		"ALLOW_USER_PROFILES" => "N",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"BASKET_POSITION" => "after",
		"COMPATIBLE_MODE" => "Y",
		"DELIVERIES_PER_PAGE" => "9",
		"DELIVERY_FADE_EXTRA_SERVICES" => "N",
		"DELIVERY_NO_AJAX" => "N",
		"DELIVERY_NO_SESSION" => "Y",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"DISABLE_BASKET_REDIRECT" => "Y",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"PATH_TO_AUTH" => "/auth/",
		"PATH_TO_BASKET" => "basket.php",
		"PATH_TO_PAYMENT" => "payment.php",
		"PATH_TO_PERSONAL" => "index.php",
		"PAY_FROM_ACCOUNT" => "N",
		"PAY_SYSTEMS_PER_PAGE" => "9",
		"PICKUPS_PER_PAGE" => "5",
		"PRODUCT_COLUMNS_HIDDEN" => "",
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "PROPS",
		),
		"SEND_NEW_USER_NOTIFY" => "Y",
		"SERVICES_IMAGES_SCALING" => "adaptive",
		"SET_TITLE" => "Y",
		"SHOW_BASKET_HEADERS" => "N",
		"SHOW_COUPONS_BASKET" => "Y",
		"SHOW_COUPONS_DELIVERY" => "Y",
		"SHOW_COUPONS_PAY_SYSTEM" => "Y",
		"SHOW_DELIVERY_INFO_NAME" => "Y",
		"SHOW_DELIVERY_LIST_NAMES" => "Y",
		"SHOW_DELIVERY_PARENT_NAMES" => "Y",
		"SHOW_MAP_IN_PROPS" => "N",
		"SHOW_NEAREST_PICKUP" => "N",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
		"SHOW_ORDER_BUTTON" => "final_step",
		"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
		"SHOW_PICKUP_MAP" => "Y",
		"SHOW_STORES_IMAGES" => "N",
		"SHOW_TOTAL_ORDER_BUTTON" => "N",
		"SHOW_VAT_PRICE" => "Y",
		"SKIP_USELESS_BLOCK" => "Y",
		"TEMPLATE_LOCATION" => "popup",
		"TEMPLATE_THEME" => "site",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
		"USE_CUSTOM_ERROR_MESSAGES" => "N",
		"USE_CUSTOM_MAIN_MESSAGES" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_PRELOAD" => "Y",
		"USE_PREPAYMENT" => "N",
		"USE_YM_GOALS" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
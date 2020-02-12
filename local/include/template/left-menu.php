<?
$MenuParams = array(
    "ALLOW_MULTI_SELECT" => "N",
    "CHILD_MENU_TYPE" => "section",
    "DELAY" => "N",
    "MAX_LEVEL" => "2",
    "MENU_CACHE_GET_VARS" => array(""),
    "MENU_CACHE_TIME" => "3600",
    "MENU_CACHE_TYPE" => "A",
    "MENU_CACHE_USE_GROUPS" => "Y",
    "ROOT_MENU_TYPE" => "left",
    "USE_EXT" => "N"
);
foreach ($MenuParams as $code=>$param){
    if (isset($arSettings[$code])){
        $MenuParams[$code] = $arSettings[$code];
    }
}

if ($arSettings['MENU_ROOT'])
    $MenuParams['ROOT_MENU_TYPE'] = $arSettings['MENU_ROOT'];
if ($arSettings['DEPTH_LEVEL'])
    $MenuParams['MAX_LEVEL'] = $arSettings['DEPTH_LEVEL'];

$APPLICATION->IncludeComponent(
	"optimalgroup:menu", 
	"left", 
	array(
		"COMPONENT_TEMPLATE" => "left",
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>

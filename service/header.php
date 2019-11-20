<?
global $OptimalGroup;
$CurPath = OptimalGroup\Core::GetCurPage();
$menuType = "section";
$indexPage = "home";
if ($OptimalGroup['SITE']['CODE'] == "business"){
    $menuType = "section-business";
    $indexPage = "business";
}    
if ($OptimalGroup['GROUP'] == "hide_shop_menu"){
    $menuType = "section-hide_shop_menu";  
    $indexPage = "teplo";
    
    if ($OptimalGroup['SITE']['CODE'] == "business"){
        $menuType = "section-teplo-business";  
        $indexPage = "teplo-business";
    }
}

if ($OptimalGroup['DOMAIN'] == "chuvashia"){
    $menuType = "section-chuvashia";  
    $indexPage = "home";
    
    if ($OptimalGroup['SITE']['CODE'] == "business"){
        $menuType = "section-teplo-business";  
        $indexPage = "teplo-business";
    }
}

if ($OptimalGroup['DOMAIN'] == "kirov"){
    $menuType = "section-kirov";  
    $indexPage = "kirov";
    
    if ($OptimalGroup['SITE']['CODE'] == "business"){
        $menuType = "section-teplo-business";  
        $indexPage = "teplo-business";
    }
}


if ($OptimalGroup['DOMAIN'] == "vladimir"){
    $menuType = "section-vladimir";
    $indexPage = "vladimir";
    if ($OptimalGroup['SITE']['CODE'] == "business"){
        $menuType = "section-vladimir-business";        
        $indexPage = "business";
    }

}


if ($OptimalGroup['DOMAIN'] == "penza"){
    $menuType = "section-empty";
    $indexPage = "contract";
}
?>
<?$APPLICATION->IncludeComponent(
	"optimalgroup:menu", 
	"online-services", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => $menuType,
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "online-services"
	),
	false
);?>




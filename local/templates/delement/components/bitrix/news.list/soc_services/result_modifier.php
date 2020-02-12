<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult["ITEMS"] as &$arItem) {
	switch ($arItem["DISPLAY_PROPERTIES"]["SOC_NETWORK"]["VALUE_XML_ID"]) {
		case "ss1":
			$arItem["CLASS"] = "vk";
			break;
		case "ss2":
			$arItem["CLASS"] = "fb";
			break;
        case "ss3":
            $arItem["CLASS"] = "ig";
            break;
        case "ss4":
            $arItem["CLASS"] = "twitter";
            break;
        case "ss5":
            $arItem["CLASS"] = "youtube";
            break;
		case "ss6":
			$arItem["CLASS"] = "ig";
			break;
	}
}
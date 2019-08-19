<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $templateData
 * @var array $arParams
 * @var string $templateFolder
 * @global CMain $APPLICATION
 */
global $APPLICATION;
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\DGAPI;
$dev = DGAPI::dev("596d7ba7c2ea77ab28a9760a93c533a5");
if($dev == 1):
//ClassDebug::debug($arResult);
endif;
$APPLICATION->AddChainItem($arResult['NAME'], $arResult['DETAIL_PAGE_URL']);
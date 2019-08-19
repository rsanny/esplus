<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$arResult['ITEM'] = reset($arResult['ITEMS']);
if(property_exists($component, 'arResultCacheKeys')) {
   if(!is_array($component->arResultCacheKeys)) {
      $component->arResultCacheKeys = array();
   }
   $sVarName = 'arResult';
   $component->arResultCacheKeys[] = $sVarName;
   $component->arResult[$sVarName] = $$sVarName;
}
?>

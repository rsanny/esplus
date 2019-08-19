<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */
$this->setFrameMode(true);
$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
?>
<div class="product-slider slick-arrow--grey">
	<?
	if (!empty($arResult['ITEMS'])):
	foreach ($arResult['ITEMS'] as $item):
        $uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
        $item['AREA_ID'] = $this->GetEditAreaId($uniqueId);
        $this->AddEditAction($item['AREA_ID'], $item['EDIT_LINK'], $elementEdit);
        $this->AddDeleteAction($item['AREA_ID'], $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
        if (!$item['STOCK_AVAILABILITY']) continue;
        //pr($item);
        ?>
        <div class="product-slider--item">
        <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/page/product-item.php', array("arItem"=>$item, "arSettings"=>$arParams), Array("SHOW_BORDER"=> false));?>
        </div>
        <?
    endforeach;//foreach items
    endif;//count items
    ?>
</div>
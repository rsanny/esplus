<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\DGAPI;
//print DGAPI::ses();
//475bf523bf15b9be9950833c016766b5
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
$dev = DGAPI::dev("475bf523bf15b9be9950833c016766b5");
//print $dev;
//if($dev == 1){ ClassDebug::debug($_SESSION); }
//if($dev == 1){ ClassDebug::debug($arParams['SHOW_IDS']); }

if (!empty($arResult['NAV_RESULT'])) {
	$navParams =  array(
		'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
		'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
		'NavNum' => $arResult['NAV_RESULT']->NavNum
	);
}
$showTopPager = false;
$showBottomPager = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1) {
	$showTopPager = $arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
}
$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
?>
<div class="row catalog-items catalog-view--<?=$arParams['CATALOG_VIEW'];?>">
	<?
	if (!empty($arResult['ITEMS']) && $arParams['SHOW_IDS']):
	foreach ($arResult['ITEMS'] as $item):
        $uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
        $item['AREA_ID'] = $this->GetEditAreaId($uniqueId);
        $this->AddEditAction($item['AREA_ID'], $item['EDIT_LINK'], $elementEdit);
        $this->AddDeleteAction($item['AREA_ID'], $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
        ?>
        <div class="col col-12 col-md-6 col-lg-4">
        <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/page/product-item.php', array("arItem"=>$item, "arSettings"=>$arParams), Array("SHOW_BORDER"=> false));?>
        </div>
        <?
    endforeach;//foreach items
    else:
        ?><div class="z5 col">В данном разделе нет товаров.</div><?
    endif;//count items
    ?>
</div>
<?
if ($showBottomPager)
{
	?>
	<div data-pagination-num="<?=$navParams['NavNum']?>">
		<?=$arResult['NAV_STRING']?>
	</div>
	<?
}
?>
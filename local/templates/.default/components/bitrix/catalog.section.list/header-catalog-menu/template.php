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
$this->setFrameMode(true);
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\DGAPI;
use DorrBitt\CategoryTovarsShop\CategoryTovarsShop;
$dev = DGAPI::dev("6bb94a866ca9c9cddf2f73f704e7c176");
//print DGAPI::ses();
//if($dev == 1){ ClassDebug::debug($arResult['SECTIONS']); }
?>
<ul class="no-list main-menu--second-level">
<? foreach ($arResult['SECTIONS'] as &$arSection):
    //if($dev == 1){ ClassDebug::debug($arSection['ID']); ClassDebug::debug($arSection['NAME']); }
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

    $arrs = [
        "IBLOCK_SECTION_ID"=>$arSection['ID'],
        "IBLOCK_ID"=>41,
        "UF_REGION"=>$_SESSION['BXExtra']['REGION']['IBLOCK']['ID'],
    ];
    $devArr = [];
    //$objCategoryTovarsShop = new CategoryTovarsShop();
    $devArr =  (new CategoryTovarsShop())->cTovars($arrs);
    $devArrLen = count($devArr);

    if ($arParams['IS_OREN'])
        if (
            $arSection['ID'] == '623' ||
            $arSection['ID'] == '612'
        )
            continue;

?>
    <?php if($devArrLen > 0):?>
    <li>
        <a href="<?=$arSection['SECTION_PAGE_URL']; ?>"><?=$arSection['NAME']; ?></a>
    </li>
    <?php endif;?>
<? endforeach;?>
</ul>
<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$t = count($arResult["ITEMS"]);
$row = ceil($t/2);
?>
<div class="overflow">
    <div class="row">
        <div class="col col-12 col-md-6">
            <ul class="no-list cities-list">
        <? foreach($arResult["ITEMS"] as $k=>$arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $url = \OptimalGroup\Url::Make($arItem['PROPERTIES']['URL']['VALUE']);
            ?>
            <? if ($k==$row):?>
                </ul>
            </div>
            <div class="col col-12 col-md-6">
                <ul class="no-list cities-list">
            <? endif;?>
            <li id="<?=$this->GetEditAreaId($arItem['ID']);?>"><a href="<?=$url;?>?type=m"><?=$arItem['PROPERTIES']['REGION']['VALUE'];?></a></li>
        <? endforeach;?>
            </ul>
        </div>
    </div>
</div>
<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \OptimalGroup\Core;
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\BElements;
use DorrBitt\dbCity\DBCITY;
use DorrBitt\dbapi\DGAPI;
$OptimalGroup = Core::Settings();
$arTemplate = $arResult['arResult'];
$obj = new BElements();
$arParams = [
    "IBLOCK_ID"=>6,
    "arSelect"=>["ID","NAME"],
    "arProperty"=>["CODE"=>"URL"],
    "PROPERTYID"=>$OptimalGroup['DOMAIN'],
];
$branchID = $obj->elemList2($arParams);
//ClassDebug::debug($branchID);
?>
<section class="page-banner">
<? foreach($arTemplate["ITEMS"] as $arItem):?>
	<?
    //ClassDebug::debug($arItem['PROPERTIES']["BRANCH_FILIAL"]["VALUE"]);
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <?php if(DBCITY::inarray($arItem['PROPERTIES']["BRANCH_FILIAL"]["VALUE"],$branchID[0]["ID"]) == 1):?>
	<div class="page-banner--item<? if ($arItem['PROPERTIES']['PAGE_CONTENT']['VALUE']):?> banner--content<? endif;?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="page-banner--item-vmiddle">
            <div class="container">
                <div class="row row-vertical">
                    <div class="col col-12 <? if ($arItem['PROPERTIES']['FORM']['VALUE']):?>col-lg-7 col-xl-8<? endif;?>">
                        <? if ($arItem['PROPERTIES']['BANNER_TITLE']['~VALUE']):?>
                        <div class="page-banner--title"><?=$arItem['PROPERTIES']['BANNER_TITLE']['~VALUE'];?></div>
                        <? endif;?>
                        <div class="page-banner--text text-left"><?=$arItem['PREVIEW_TEXT'];?></div>
                        <? if (!empty($arItem['PROPERTIES']['BTN_LINK']['VALUE'])):?>
                        <div class="mt-20 text-left">
                            <a href="<?=$arItem['PROPERTIES']['BTN_LINK']['VALUE'];?>" class="btn btn-orange w-170"><span class="fa-angle-btn"><?=$arItem['PROPERTIES']['BTN_LINK']['DESCRIPTION']?$arItem['PROPERTIES']['BTN_LINK']['DESCRIPTION']:$arItem['PROPERTIES']['BTN_LINK']['DEFAULT_VALUE'];?></span></a>
                        </div>
                        <? endif;?>
                        <? if ($arItem['PROPERTIES']['FORM']['VALUE']):?>
                        <div class="mt-20 text-left">
                            <a href="#" class="btn btn-orange w-170 js-popUpData" data-fancybox-href="<?=AJAX_PATH;?>form/banner-order.php"><span class="fa-angle-btn">Заказать</span></a>
                        </div>
                        <? endif;?>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-banner--img js-parallax" data-swiper-parallax="100%" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC'];?>)"></div>
    <!--/index slide-->
    </div>
<?php endif;?>
<?endforeach;?>
</section>
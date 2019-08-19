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
?>
<div class="news-detail">
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	
    <hr>
    <div class="text-center">
        <a href="#" class="btn btn-orange btn-big js-popUpData" data-fancybox-href="<?=AJAX_PATH;?>form/career.php">Откликнуться на вакансию</a>
    </div>
    <hr>
	<div class="news-detail--share mt-30 text-center mb-30">
        <div 
            class="ya-share2" 
            data-services="facebook,twitter,odnoklassniki,vkontakte,gplus"
            data-title="<?=$arResult["NAME"];?>"
            data-description="<?=$arResult["PREVIEW_TEXT"];?>"
            data-url="<?=$_SERVER['REQUEST_SCHEME'];?>://<?=$_SERVER['SERVER_NAME'];?><?=$arResult["DETAIL_PAGE_URL"];?>"
        ></div>
    </div>
</div>
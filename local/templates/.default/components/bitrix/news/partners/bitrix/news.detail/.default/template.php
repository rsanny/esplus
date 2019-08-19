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
    <div class="row">
        <?if(is_array($arResult["PREVIEW_PICTURE"])):?>
        <div class="col col-12 col-sm-4 col-md-3 col-lg-3">
            <img
                border="0"
                src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>"
                width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>"
                height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>"
                alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>"
                title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>"
                class="img-responsive"
                />
        </div>                 
        <?endif?>
        <div class="col col-12 col-sm-8 col-md-9 col-mt-sm-20">
        <?if($arResult["NAV_RESULT"]):?>
            <?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
            <?echo $arResult["NAV_TEXT"];?>
            <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
        <?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
            <?echo $arResult["DETAIL_TEXT"];?>
        <?else:?>
            <?echo $arResult["PREVIEW_TEXT"];?>
        <?endif?>
        </div>
    </div>
    <div class="text-center mt-10 mt-2">
        <a href="<?=$arResult['LIST_PAGE_URL'];?>" class="btn btn-transparent-border w-210">Все партнеры</a>
    </div>
</div>
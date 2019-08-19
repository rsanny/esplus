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
$col = $arParams['COLS']?12/$arParams['COLS']:"4";
?>
<? if (count($arResult["ITEMS"])):?>
<div class="news-list row">
<? foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $PreviewText = $arItem['PREVIEW_TEXT'];
    if (!$PreviewText){
        $obParser = new CTextParser;
        $PreviewText = strip_tags($obParser->html_cut($arItem["DETAIL_TEXT"], 200));
    }
    
	?>
	<div class="col col-12 col-lg-<?=$col;?> col-md-6 mb-40">
        <div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="news-item__link">
                <span class="news-item--date"><?=$arItem['DISPLAY_ACTIVE_FROM'];?></span>
                <span class="news-item--name"><?=$arItem['NAME'];?></span>
                <span class="news-item--text"><?=$PreviewText;?></span>
            </a>
            <? if ($arItem['TAG']):?>
            <div class="news-item__section">
                <a href="/news/?tag=<?=$arItem['TAG']['ID'];?>" style="background-color:#<?=$arItem['TAG']['COLOR'];?> ">#<?=$arItem['TAG']['NAME'];?></a>
            </div>
            <? endif;?>
            <div class="news-item--share mt-10">
                <div 
                    class="ya-share2" 
                    data-services="facebook,twitter,odnoklassniki,vkontakte,gplus"
                    data-title="<?=$arItem["NAME"];?>"
                    data-url="<?=$_SERVER['REQUEST_SCHEME'];?>://<?=$_SERVER['SERVER_NAME'].$arItem["DETAIL_PAGE_URL"];?>"
                    data-description="<?=$PreviewText;?>"
                ></div>
            </div>
            
        </div>
    </div>
<? endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<? endif;?>
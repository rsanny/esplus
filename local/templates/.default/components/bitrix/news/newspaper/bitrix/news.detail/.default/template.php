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
$dateStart = explode('/',CIBlockFormatProperties::DateFormat("d/F/Y г.", MakeTimeStamp($arResult['DATE_ACTIVE_FROM'], CSite::GetDateFormat())));
if (!empty($arResult['DATE_ACTIVE_TO'])) {
    $dateEnd = explode('/',CIBlockFormatProperties::DateFormat("d/F/Y г.", MakeTimeStamp($arResult['DATE_ACTIVE_TO'], CSite::GetDateFormat())));
    $NoEndDate = 2;
}
else {
    $dateEnd = false;
    $NoEndDate = 0;
}
$Banner = false;
if ($arResult['DETAIL_PICTURE'])
    $Banner = $arResult['DETAIL_PICTURE'];
elseif ($arResult['PREVIEW_PICTURE'])
    $Banner = $arResult['PREVIEW_PICTURE'];
?>
<div class="row">
    <div class="col col-12 col-md-9 col-lg-10 order-1">
        <div class="row no-gutters promo-item mb-30">
            <div class="col col-12 col-lg-5 col-xl-4">
                <div class="promo-item__img">
                    <div class="promo-item__date text-right ">
                        <div class="item__date--left item__date">
                            <b><?=$dateStart[0];?></b>
                            <div><span><?=$dateStart[1];?></span><?=$dateStart[2];?></div>
                        </div>
                        <? if ($dateEnd):?>
                        <div class="item__date--right item__date">
                            <b><?=$dateEnd[0];?></b>
                            <div><span><?=$dateEnd[1];?></span><?=$dateEnd[2];?></div>
                        </div>
                        <? endif;?>
                    </div>
                    <img src="<?=$Banner['SRC'];?>" height="<?=$Banner['HEIGHT'];?>" width="<?=$Banner['WIDTH'];?>" alt="<?=$arResult['NAME'];?>" class="img-responsive">
                </div>
            </div>
            <div class="col col-12 col-lg-7 col-xl-8 promo-item__detail">
                <? if ($arResult['SHOW_COUNTER']):?>
                <div class="news-detail--count">
                    <i class="fa fa-eye"></i> <?=$arResult['SHOW_COUNTER'];?>
                </div>
                <? endif;?>
                <div class="promo-item__name"><a><?=$arResult['NAME'];?></a></div>
                <div class="promo-item__preview"><?=$arResult['PREVIEW_TEXT'];?></div>
            </div>
        </div>
    </div>
    <div class="col col-12 col-md-3 col-lg-2 order-3 order-md-3 mt-30 mt-md-0">
        <div class="news-detail--share">
            <div 
                class="ya-share2" 
                data-services="facebook,twitter,odnoklassniki,vkontakte,gplus"
                data-title="<?=$arResult["NAME"];?>"
                data-description="<?=$arResult["PREVIEW_TEXT"];?>"
                data-url="<?=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$arResult["DETAIL_PAGE_URL"];?>"
            ></div>
        </div>
    </div>
    <div class="col col-12 order-2 order-md-3">
        <div class="overflow news-detail">
            <?echo $arResult["DETAIL_TEXT"];?>
        </div>
        <? if ($arResult['PROPERTIES']['FILES']['VALUE']):?>
        <div class="file-list--small mt-40 mb-20">
        <? foreach ($arResult['PROPERTIES']['FILES']['VALUE'] as $k=>$fileId):
            $fileName = $arResult['PROPERTIES']['FILES']['DESCRIPTION'][$k];
            $arFile = CFile::GetFileArray($fileId);
            $icon = FormatHelper::FileType($arFile['CONTENT_TYPE']);
            if (!$fileName) $fileName = $arFile['FILE_NAME'];
        ?>
            <div><a href="<?=$arFile['SRC'];?>" class="file-item--small" target="_blank"><span><i class="icon-file--<?=$icon;?>"></i></span><b><?=$fileName;?></b></a></div>
        <? endforeach;?>
        </div>
        <? endif;?>
    </div>
</div>    
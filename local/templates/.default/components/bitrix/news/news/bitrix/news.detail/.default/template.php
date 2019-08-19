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
$date = explode('/',$arResult["DISPLAY_ACTIVE_FROM"]);
?>

<div class="overflow news-detail">
    <div class="news-detail--header row">
        <div class="col col-sm-2 col-md-1 order-2 order-sm-1">
            <div class="news-detail--date ib text-center">
                <span><?=$date[0];?></span>
                <div><?=$date[1];?></div>
                <?=$date[2];?>
            </div>
        </div>
        <div class="col col-12 col-sm-9 col-md-10 order-1">
            <h1>
                <?=$arResult['NAME'];?>

                <? if ($arResult['TAG']):?>
                <div class="news-item__section ib">
                    <a href="/news/?tag=<?=$arResult['TAG']['ID'];?>" style="background-color:#<?=$arResult['TAG']['COLOR'];?> ">#<?=$arResult['TAG']['NAME'];?></a>
                </div>
                <? endif;?>
            </h1>
        </div>
        <? if ($arResult['SHOW_COUNTER']):?>
        <div class="col col-sm-1 news-detail--count text-right order-3">
            <i class="fa fa-eye"></i> <?=$arResult['SHOW_COUNTER'];?>
        </div>
        <? endif;?>
    </div>
    <hr class="mt-0">
	<div class="row">
	    <div class="col col-12 col-sm-10 col-lg-11">
            <? if ($arResult['PROPERTIES']['YOUTUBE']['VALUE']):?>
            <div class="clearfix detail-news--video">
                <div class="detail-news--video__content ib"><iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$arResult['PROPERTIES']['YOUTUBE']['VALUE'];?>?rel=0&amp;controls=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen style="max-width: 100%;"></iframe></div>
                <hr>
            </div>
            <? endif;?>
            <? if ($arResult['PROPERTIES']['GALLERY']['VALUE']):?>
                <div class="news-slider slick-arrow--grey">
                    <? foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $img):
                        $resizedImg = CFile::ResizeImageGet($img, array('width'=>400, 'height'=>400), BX_RESIZE_IMAGE_PROPORTIONAL, false);
                    ?>
                    <div class="news-slider--item">
                        <a href="<?=CFile::GetPath($img);?>" class="fancybox" rel="news-gallery"><img src="<?=$resizedImg['src'];?>" alt="" class="img-responsive"></a>
                    </div>
                    <? endforeach;?>
                </div>
                <script>
                $(function(){
                    $('.news-slider').slick({
                        centerMode: true,
                        centerPadding: '0',
                        slidesToShow: 1,
                        variableWidth: true,
                        infinite: true,
                        responsive: [
                            {
                                breakpoint: 768,
                                settings: {
                                    arrows: false,
                                    centerMode: true,
                                    centerPadding: '40px',
                                    slidesToShow: 3
                                }
                            },
                            {
                            breakpoint: 480,
                            settings: {
                                    arrows: false,
                                    centerMode: true,
                                    centerPadding: '40px',
                                    slidesToShow: 1
                                }
                            }
                        ]
                    });
                });
                </script>
                <hr>                
            <? endif;?>
            <? if ($arResult['PROPERTIES']['BANNER']['VALUE']):?>
            <div class="detail-news--img pull-left">
                <img src="<?=CFile::GetPath($arResult['PROPERTIES']['BANNER']['VALUE']);?>" alt="<?=$arResult['NAME'];?>" class="img-responsive">
            </div>
            <? endif;?>
        <? if($arResult["NAV_RESULT"]):?>
            <?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
            <?echo $arResult["NAV_TEXT"];?>
            <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
        <? elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
            <?echo $arResult["DETAIL_TEXT"];?>
        <? else:?>
            <?echo $arResult["PREVIEW_TEXT"];?>
        <? endif?>
            <div class="clear"></div>
        
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
        <div class="col col-12 col-sm-2 col-lg-1 mt-20 mt-sm-0">
            <div class="news-detail--share">
                <div 
                    class="ya-share2" 
                    data-services="facebook,twitter,odnoklassniki,vkontakte,gplus"
                    data-title="<?=$arResult["NAME"];?>"
                    data-description="<?=$arResult["PREVIEW_TEXT"];?>"
                    data-url="<?=$_SERVER['REQUEST_SCHEME'];?>://<?=$_SERVER['SERVER_NAME'];?><?=$arResult["DETAIL_PAGE_URL"];?>"
                ></div>
            </div>
        </div>
    </div>
    <!--
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
    -->
</div>
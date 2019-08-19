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
<? if (count($arResult["ITEMS"])):?>
<? if (!$arParams['LOAD_MORE']):?>
<? /*
<div class="contacts-simple--more text-center">
    <a href="#" class="btn btn-transparent-border btn-magic--padding js-hideContactsList"><span>Скрыть</span> офисы продаж и обслуживания клиентов<i class="fa fa-angle-up btn-fa--collapse"></i></a>
</div>
*/?>
<div class="contacts-list">
<? endif;?>
<? foreach($arResult["ITEMS"] as $k=>$arItem):?>		
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="contacts-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="row">
            <div class="col col-12 col-md-6 col-lg-5 col-xl-4">
                <div class="contacts-item--address"><i class="fa fa-map-marker"></i><?=$arItem['PROPERTIES']['INDEX']['VALUE']?$arItem['PROPERTIES']['INDEX']['VALUE'].", ":"";?><a href="#" class="dashed js-OpenOnMap" data-id="<?=$arItem['ID'];?>"><?=$arItem['PROPERTIES']['ADDRESS']['VALUE'];?></a></div>
                <div class="contacts-item--phone">
                <? foreach ($arItem['PROPERTIES']['PHONE']['VALUE'] as $k=>$phone):?>
                <div>
                    <i class="fa fa-phone"></i>
                    <?=$phone;?>
                    <? if($arItem['PROPERTIES']['PHONE']['DESCRIPTION'][$k]):?><small><?=$arItem['PROPERTIES']['PHONE']['DESCRIPTION'][$k];?></small><? endif;?>
                </div>
                <? endforeach;?>
                <? if($arItem['PROPERTIES']['FAX']['VALUE']):?><div><i class="fa fa-fax"></i><?=$arItem['PROPERTIES']['FAX']['VALUE'];?></div><?endif;?>
                </div>
            </div>
            <div class="col col-12 col-md-6 col-lg-3 col-xl-5 mt-20 mt-md-0">
                <div class="row">            
                    <? if ($arItem['PROPERTIES']['TIME_INDIVIDUALS']['VALUE']):?>
                    <div class="col col-12 <? if ($arItem['PROPERTIES']['TIME_LEGAL']['VALUE']):?>col-xl-6<? endif;?>">
                        <div class="contacts-item--time">
                            <i class="fa fa-clock-o"></i>
                            <?
                            $arTimeInd = "<p>Для физ. лиц</p><table>";
                            foreach ($arItem['PROPERTIES']['TIME_INDIVIDUALS']['VALUE'] as $k=>$day):
                                $time = $arItem['PROPERTIES']['TIME_INDIVIDUALS']['DESCRIPTION'][$k];
                                $arTimeInd .= '<tr><td nowrap>'.$day.'</td><td nowrap>'.$time.'</td></tr>';
                            endforeach;
                            $arTimeInd .= "</table>";   
                            ?>
                            <?=$arTimeInd;?>
                        </div>
                    </div>
                    <? endif;?>
                    <? if ($arItem['PROPERTIES']['TIME_LEGAL']['VALUE']):?>
                    <div class="col col-12  <? if ($arItem['PROPERTIES']['TIME_INDIVIDUALS']['VALUE']):?>col-xl-6 mt-20 mt-xl-0<? endif;?>">
                        <div class="contacts-item--time">
                            <i class="fa fa-clock-o"></i>
                            <?
                            $arTimeLeg = "<p>Для юр. лиц</p><table>";
                            foreach ($arItem['PROPERTIES']['TIME_LEGAL']['VALUE'] as $k=>$day):
                                $time = $arItem['PROPERTIES']['TIME_LEGAL']['DESCRIPTION'][$k];
                                $arTimeLeg .= '<tr><td nowrap>'.$day.'</td><td nowrap>'.$time.'</td></tr>';
                            endforeach;
                            $arTimeLeg .= "</table>";                    
                            ?>
                            <?=$arTimeLeg;?>
                        </div>
                    </div>
                    <? endif;?>
                </div>
            </div>
            <div class="col col-12 col-md-12 col-lg-4 col-xl-3 mt-20 mt-lg-0">
                <? if($arItem['PREVIEW_TEXT']):?>
                <div class="contacts-item--text"><?=$arItem['PREVIEW_TEXT'];?></div>
                <? endif;?>
                <div class="contacts-item--action">
                    <a href="#" class="btn btn-transparent-border block js-popUp" data-fancybox-type="iframe" data-fancybox-href="<?=AJAX_PATH;?>print-contact.php?id=<?=$arItem['ID'];?>"><i class="fa fa-print btn-fa"></i>Распечатать карту проезда</a>
                    <? if ($arItem['PROPERTIES']['ICONS']['VALUE']):?>
                    <div class="contacts-item--icons">
                    <? foreach ($arItem['PROPERTIES']['ICONS']['VALUE_XML_ID'] as $k=>$icon):?>
                        <i data-text="<?=$arItem['PROPERTIES']['ICONS']['VALUE'][$k];?>" data-position="middle" class="icon-<?=$icon;?> js-toolTip"></i>
                    <? endforeach;?>
                    </div>
                    <? endif;?>
                </div>
            </div>
        </div>
    </div>
<? 
endforeach;?>
<? if (!$arParams['LOAD_MORE']):?>
</div>
<? if (count(count($arResult["ITEMS"]))>1):?>
<div class="contacts-simple--more text-center ajax-load-iblock-but">
    <a href="#" class="btn btn-transparent-border btn-magic--padding" data-page="2" data-total="<?=$arResult['NAV_RESULT']->NavPageCount?>">Показать еще<i class="fa fa-angle-down btn-fa--collapse"></i></a>
</div>
<? endif;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<? endif;?>
<? endif;?>
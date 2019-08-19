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
$MapPlacmarks = array();
?>
<div class="contacts-list">
<? foreach($arResult["ITEMS"] as $k=>$arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="contacts-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <table width="100%">
            <tr>
                <td valign="top">
                    <div class="contacts-item--address"><?=$arItem['PROPERTIES']['INDEX']['VALUE']?$arItem['PROPERTIES']['INDEX']['VALUE'].", ":"";?><?=$arItem['PROPERTIES']['ADDRESS']['VALUE'];?></div>
                    <div class="contacts-item--phone">
                    <? foreach ($arItem['PROPERTIES']['PHONE']['VALUE'] as $k=>$phone):?>
                    <div><i class="fa fa-phone"></i><?=$phone;?></div>
                    <? endforeach;?>
                    <? if($arItem['PROPERTIES']['FAX']['VALUE']):?><div><i class="fa fa-fax"></i><?=$arItem['PROPERTIES']['FAX']['VALUE'];?></div><?endif;?>
                    </div>
                    <? if ($arItem['PROPERTIES']['ICONS']['VALUE']):?>
                    <div class="contacts-item--icons">
                    <? foreach ($arItem['PROPERTIES']['ICONS']['VALUE_XML_ID'] as $k=>$icon):?>
                        <i data-text="<?=$arItem['PROPERTIES']['ICONS']['VALUE'][$k];?>" data-position="middle" class="icon-<?=$icon;?> js-toolTip"></i>
                    <? endforeach;?>
                    </div>
                    <? endif;?>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <br>
                    <table width="50%">
                        <tr>
                            <? if ($arItem['PROPERTIES']['TIME_INDIVIDUALS']['VALUE']):?>
                            <td valign="top">
                                <div class="contacts-item--time">
                                    <?
                                    $arTimeInd = "<p><b>Для физ. лиц</b></p><table>";
                                    foreach ($arItem['PROPERTIES']['TIME_INDIVIDUALS']['VALUE'] as $k=>$day):
                                        $time = $arItem['PROPERTIES']['TIME_INDIVIDUALS']['DESCRIPTION'][$k];
                                        $arTimeInd .= '<tr><td nowrap>'.$day.'</td><td nowrap>'.$time.'</td></tr>';
                                    endforeach;
                                    $arTimeInd .= "</table>";   
                                    ?>
                                    <?=$arTimeInd;?>
                                </div>
                            </td>
                            <? endif;?>
                            <? if ($arItem['PROPERTIES']['TIME_LEGAL']['VALUE']):?>
                            <td valign="top">
                                <div class="contacts-item--time">
                                    <?
                                    $arTimeLeg = "<p><b>Для юр. лиц</b></p><table>";
                                    foreach ($arItem['PROPERTIES']['TIME_LEGAL']['VALUE'] as $k=>$day):
                                        $time = $arItem['PROPERTIES']['TIME_LEGAL']['DESCRIPTION'][$k];
                                        $arTimeLeg .= '<tr><td nowrap>'.$day.'</td><td nowrap>'.$time.'</td></tr>';
                                    endforeach;
                                    $arTimeLeg .= "</table>";                    
                                    ?>
                                    <?=$arTimeLeg;?>
                                </div>
                            </td>
                            <? endif;?>
                        </tr>
                    </table>
                </td>
            </tr>
            <? if($arItem['PREVIEW_TEXT']):?>
            <tr>
                <td>
                    <br><br>
                    <div class="contacts-item--text"><?=$arItem['PREVIEW_TEXT'];?></div>
                </td>
            </tr>
            <? endif;?>
        </table>
    </div>
<? 
    $coord = explode(',',$arItem['PROPERTIES']['COORDS']['VALUE']);
    $MapPlacmarks = array(
        'CENTER'=>array($coord[0],$coord[1]),
    );
endforeach;?>
<br><br>
<div id="print-map" style="width: 100%; height: 400px;"></div>
<script>
    PrintMapMarker = <?=json_encode($MapPlacmarks);?>;
    ymaps.ready(function () {
        var myMap;
        myMap = new ymaps.Map('print-map', {
            center: PrintMapMarker.CENTER,
            zoom: 14,
            behaviors: ['default', 'scrollZoom']
        });
        myMap.behaviors.disable('scrollZoom');
        myMap.controls.remove('searchControl');
        var placemark = new ymaps.Placemark(PrintMapMarker.CENTER);        
        myMap.geoObjects.add(placemark)
        setTimeout(function(){
            window.print();
            parent.$.fancybox.close();
        },600);
    });
</script>
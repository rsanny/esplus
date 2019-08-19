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
<div class="contacts-main">
    <div class="row">
    <? foreach ($arResult['ITEMS'] as $k=>$arItem):?>
        <div class="col col-12 col-md-6">
            <div class="contacts-main--title"><?=$arItem['NAME'];?></div>
            <div class="contacts-item--address"><i class="fa fa-map-marker"></i><?=$arItem['PROPERTIES']['INDEX']['VALUE']?$arItem['PROPERTIES']['INDEX']['VALUE'].", ":"";?><a href="#" class="dashed js-OpenOnMap" data-id="<?=$arItem['ID'];?>"><?=$arItem['PROPERTIES']['ADDRESS']['VALUE'];?></a></div>
            <div class="contacts-item--phone">
            <? foreach ($arItem['PROPERTIES']['PHONE']['VALUE'] as $k=>$phone):?>
            <div><i class="fa fa-phone"></i><?=$phone;?></div>
            <? endforeach;?>
            <? if($arItem['PROPERTIES']['FAX']['VALUE']):?><div><i class="fa fa-fax"></i><?=$arItem['PROPERTIES']['FAX']['VALUE'];?></div><?endif;?>
            </div>
            
            <div class="row">
            
            <? if ($arItem['PROPERTIES']['TIME_INDIVIDUALS']['VALUE']):?>
            <div class="col col-12 <? if ($arItem['PROPERTIES']['TIME_LEGAL']['VALUE']):?>col-sm-6<? endif;?>">
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
            <div class="col col-12  <? if ($arItem['PROPERTIES']['TIME_INDIVIDUALS']['VALUE']):?>col-sm-6<? endif;?>">
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
            <div class="contacts-item--timeline">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <? if (in_array("work", $arItem['PROPERTIES']['ICONS']['VALUE_XML_ID'])):?><span></span><? else:?><b></b><? endif;?>
                <b></b>
            </div>
            <div class="contacts-item--text"><?=$arItem['PREVIEW_TEXT'];?></div>
            <div class="contacts-item--action">
                <a href="#" class="btn btn-grey w-170">Обратная связь</a>
                <a href="#" class="btn btn-transparent-border w-280"><i class="fa fa-print btn-fa"></i>Распечатать карту проезда</a>
            </div>
        </div>
    <? 
    if ($arTimeInd && $arTimeLeg) {
        $TIME = '<div class="row"><div class="col col-6">'.$arTimeInd.'</div><div class="col col-6">'.$arTimeLeg.'</div></div>';
    }
    else $TIME = $arTimeLeg.$arTimeInd;
    $coord = explode(',',$arItem['PROPERTIES']['COORDS']['VALUE']);
    $MapPlacmarks[] = array(
        'CENTER'=>array($coord[0],$coord[1]),
        "ID"=>$arItem['ID'],
        "REGION"=>$arItem['PROPERTIES']['REGION']['VALUE'],
        "CONTENT"=>array(
            "ADDRESS" => $arItem['PROPERTIES']['INDEX']['VALUE'].", ".$arItem['PROPERTIES']['ADDRESS']['VALUE'],
            "PHONE" => implode(",<br>",$arItem['PROPERTIES']['PHONE']['VALUE']),
            "FAX" => $arItem['PROPERTIES']['FAX']['VALUE'],
            "TIME" => $TIME,
            "TEXT" => $arItem['PREVIEW_TEXT']
        )
    );
    endforeach;?>
    </div>
</div>
<script>
    ContactsPlaceMarksMain = <?=json_encode($MapPlacmarks);?>;
</script>
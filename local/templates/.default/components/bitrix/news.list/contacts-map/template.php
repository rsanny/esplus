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
<? if (count($arResult["ITEMS"])):?>
<? foreach($arResult["ITEMS"] as $k=>$arItem):
    $TIME = 
    $arTimeInd = 
    $arTimeLeg = "";
    if ($arItem['PROPERTIES']['TIME_INDIVIDUALS']['VALUE']):
        $arTimeInd = "<p>Для физ. лиц</p><table>";
        foreach ($arItem['PROPERTIES']['TIME_INDIVIDUALS']['VALUE'] as $k=>$day):
            $time = $arItem['PROPERTIES']['TIME_INDIVIDUALS']['DESCRIPTION'][$k];
            $arTimeInd .= '<tr><td nowrap>'.$day.'</td><td nowrap>'.$time.'</td></tr>';
        endforeach;
        $arTimeInd .= "</table>";   
    endif;
    if ($arItem['PROPERTIES']['TIME_LEGAL']['VALUE']):
        $arTimeLeg = "<p>Для юр. лиц</p><table>";
        foreach ($arItem['PROPERTIES']['TIME_LEGAL']['VALUE'] as $k=>$day):
            $time = $arItem['PROPERTIES']['TIME_LEGAL']['DESCRIPTION'][$k];
            $arTimeLeg .= '<tr><td nowrap>'.$day.'</td><td nowrap>'.$time.'</td></tr>';
        endforeach;
        $arTimeLeg .= "</table>";                    
    endif;
    if ($arTimeInd && $arTimeLeg) {
        $TIME = '<div class="row"><div class="col col-6">'.$arTimeInd.'</div><div class="col col-6">'.$arTimeLeg.'</div></div>';
    }
    else $TIME = $arTimeLeg.$arTimeInd;
    $pointColor = $arItem['PROPERTIES']['VIEW']['VALUE_XML_ID'];
    if (strpos($pointColor, "other") !== false){
        $pointColor = "grey";
    }
    $arPhones = "";
    foreach ($arItem['PROPERTIES']['PHONE']['VALUE'] as $k=>$phone) {
        if ($arItem['PROPERTIES']['PHONE']['DESCRIPTION'][$k])
            $arPhones[] = $phone." <small>".$arItem['PROPERTIES']['PHONE']['DESCRIPTION'][$k].'</small>';
        else
            $arPhones[] = $phone;
    }

    $coord = explode(',',$arItem['PROPERTIES']['COORDS']['VALUE']);
    $MapPlacmarks[] = array(
        'CENTER'=>array($coord[0],$coord[1]),
        "ID"=>$arItem['ID'],
        "REGION"=>$arItem['PROPERTIES']['REGION']['VALUE'],
        "COLOR"=>$pointColor,
        "CONTENT"=>array(
            "ADDRESS" => $arItem['PROPERTIES']['INDEX']['VALUE'].", ".$arItem['PROPERTIES']['ADDRESS']['VALUE'],
            "PHONE" => implode(",<br>",$arPhones),
            "FAX" => $arItem['PROPERTIES']['FAX']['VALUE'],
            "TIME" => $TIME,
            "TEXT" => $arItem['PREVIEW_TEXT']
        )
    );
endforeach;?>
<script>
    <? if ($arParams['LOAD_MORE']):?>
    ContactsPlaceMarksList.push(<?=json_encode($MapPlacmarks);?>);
    <? else:?>
    ContactsPlaceMarksList = <?=json_encode($MapPlacmarks);?>;
    <? endif;?>
</script>
<? endif;?>
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
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<companies>
<? foreach($arResult["ITEMS"] as $k=>$arItem):?>
    <company>
        <company-id><?=$arItem['ID'];?></company-id>
        <name lang="ru">ЭнергосбыТ Плюс <?=$arParams['BRANCH'];?></name>
        <address lang="ru"><?=$arItem['PROPERTIES']['ADDRESS']['VALUE'];?></address>
        <country lang="ru">Россия</country>
        <?
        foreach ($arItem['PROPERTIES']['PHONE']['VALUE'] as $k=>$phone):
        ?><phone>
            <number><?=$phone;?></number>
            <? if ($arItem['PROPERTIES']['PHONE']['DESCRIPTION'][$k]):
            ?><info><?=$arItem['PROPERTIES']['PHONE']['DESCRIPTION'][$k];?></info>
            <? endif;
        ?><type>phone</type>
        </phone>
        <? 
        endforeach;
        if($arItem['PROPERTIES']['FAX']['VALUE']):
        ?><phone>
            <number><?=$arItem['PROPERTIES']['FAX']['VALUE'];?></number>
            <type>fax</type>
        </phone>
        <? 
        endif;
        ?><url><?=$arParams['URL'];?></url>
        <? 
        if ($arItem['PROPERTIES']['TIME_INDIVIDUALS']['DESCRIPTION']):
            $arWorkingTime = [];
            foreach ($arItem['PROPERTIES']['TIME_INDIVIDUALS']['DESCRIPTION'] as $k => $time) {
                if ($time == 'выходной')
                    continue;
                $timeDate = str_replace(":","", $arItem['PROPERTIES']['TIME_INDIVIDUALS']['VALUE'][$k]);
                $arWorkingTime[] = $timeDate." ".$time;
            }
        ?><working-time lang="ru"><?=implode(', ', $arWorkingTime);?>, Физ. лица</working-time>
        <? 
        endif;
        if ($arItem['PROPERTIES']['TIME_LEGAL']['DESCRIPTION']):
            $arWorkingTime = [];
            foreach ($arItem['PROPERTIES']['TIME_LEGAL']['DESCRIPTION'] as $k => $time) {
                if ($time == 'выходной')
                    continue;
                $timeDate = str_replace(":","", $arItem['PROPERTIES']['TIME_LEGAL']['VALUE'][$k]);
                $arWorkingTime[] = $timeDate." ".$time;
            }
        ?><working-time lang="ru"><?=implode(', ', $arWorkingTime);?>, Юр. лица</working-time>
        <? 
        endif;
        ?><rubric-id>31576</rubric-id>
        <rubric-id>31079</rubric-id>
        <rubric-id>30492</rubric-id>
        <photos>
            <photo url="<?=$arParams['URL'].MEDIA_PATH;?>images/logo.png" alt=""/>
        </photos>
        <inn>5612042824</inn> 
        <ogrn>1055612021981</ogrn>
        <actualization-date><?=time();?></actualization-date>
        <? 
        if ($arItem['PROPERTIES']['COORDS']['VALUE']):
        $coord = explode(',',$arItem['PROPERTIES']['COORDS']['VALUE']);
        ?><coordinates><lon><?=$coord[1];?></lon><lat><?=$coord[0];?></lat></coordinates>
    <? 
        endif;
    ?></company>
<? endforeach;
?></companies>
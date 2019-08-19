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
<div class="faq-list">
<? foreach ($arResult['SECTIONS'] as $branch=>$arSection):?>
    <div class="faq-item<? if ($arParams['CURRENT_BRANCH'] == $branch):?> is-opened<? endif;?>">
        <div class="faq-item--name"><i></i><span><?=$arResult['BRANCH_NAME'][$branch];?></span></div>
        <div class="faq-item--text<? if ($arParams['CURRENT_BRANCH'] != $branch):?> none<? endif;?>">
        <?foreach($arSection["ITEMS"] as $arItem):?>
            <br>
            <? if ($arItem['PROPERTIES']['NAME']['VALUE']):?>
            <span class="fs-18 color-black"><b><?=$arItem['PROPERTIES']['NAME']['VALUE'];?></b></span><br>
            <? endif;?>
            <? if ($arItem['PROPERTIES']['POSITION']['VALUE']):?>
            <?=$arItem['PROPERTIES']['POSITION']['VALUE'];?><br>
            <? endif;?>
            <? if ($arItem['PROPERTIES']['EMAIL']['VALUE'] && $arItem['PROPERTIES']['PHONE']['VALUE']):?>
            <table class="no-border">
            <? if ($arItem['PROPERTIES']['EMAIL']['VALUE']):?>
            <tr>
                <td><b>E-mail:</b></td>
                <td><div class="ml-10"><a href="mailto:<?=$arItem['PROPERTIES']['EMAIL']['VALUE'];?>" class="color-orange"><?=$arItem['PROPERTIES']['EMAIL']['VALUE'];?></a></div></td>
            </tr>
            <? endif;?>
            <? if ($arItem['PROPERTIES']['PHONE']['VALUE']):?>
            <tr>
                <td><b>Телефон:</b></td>
                <td><div class="ml-10"><a href="tel:<?=str_replace(array("-","(",")"," "),"",$arItem['PROPERTIES']['PHONE']['VALUE']);?>" class="color-orange"><?=$arItem['PROPERTIES']['PHONE']['VALUE'];?></a></div></td>
            </tr>
            <? endif;?>
            </table>
            <br>
            <? endif;?>
        <? endforeach;?>
        </div>
    </div>
<? endforeach;?>
</div>
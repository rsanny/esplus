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
<ul class="no-list sections-menu">
<? foreach ($arResult['SECTIONS'] as &$arSection):
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    $selected = false;
    if ($arSection['ACTIVE']=="Y" || $arSection['OPENED'])
        $selected = true;
?>      
    <li<?if (count($arSection['CHILDREN'])):?> class="has-child"<? endif;?>>
        <a href="<?=$arSection['SECTION_PAGE_URL']; ?>"<? if($selected):?> class="is-selected"<? endif;?>>
            <?=$arSection['NAME']; ?>
            <? if ($arParams['COUNT_ELEMENTS'] == "Y"):?><span>(<?=$arSection['ELEMENT_CNT']; ?>)</span><? endif;?>
            <?if (count($arSection['CHILDREN'])):?>
            <? if($selected):?><i class="fa fa-angle-down"></i><? endif;?>
            <? endif;?>
        </a>
        <? if (count($arSection['CHILDREN'])):?>
        <ul class="no-list second-level<? if (!$arSection['OPENED'] == 'Y'):?> none<?endif?>">
            <?foreach ($arSection['CHILDREN'] as $arChild):?>
            <li>
                <a href="<?=$arChild['SECTION_PAGE_URL']?>" <? if ($arChild['ACTIVE']=="Y"):?> class="is-selected"<?endif;?>>
                    <?=$arChild['NAME']?>
                    <? if ($arParams['COUNT_ELEMENTS'] == "Y"):?><span>(<?=$arChild['ELEMENT_CNT']; ?>)</span><? endif;?>
                </a>
            </li>
            <?endforeach?>
        </ul>
        <? endif;?>
    </li>
<? endforeach;?>
</ul>
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
<div class="hidden-md-down">
    <div class="news-filter">
        <span>Показать новости за:</span>
        <? foreach ($arResult['YEARS'] as $k=>$arYears):
            $is_selected = false; 
            $link = $APPLICATION->GetCurPageParam('year='.$arYears,array('year'));
            if ($arParams['CURRENT']['YEAR'] == $arYears) $is_selected = true;
        ?>
        <a href="<?=$link;?>" class="<? if ($is_selected):?> is-selected<? endif;?>"><?=$arYears;?></a>
        <? 
        endforeach;?>
        <a href="/news/"<? if (!$arParams['CURRENT']['YEAR']):?> class="is-selected"<? endif;?>>Архив</a>
    </div>
    <? if ($arResult['TAGS']):?>
    <div class="news-filter news-item__section">
        <span>Показать по хэштегам:</span>
        <? foreach ($arResult['TAGS'] as $arTag):
            $is_selected = false; 
            $link = $APPLICATION->GetCurPageParam('tag='.$arTag['ID'],array('tag'));
            if ($arParams['CURRENT']['TAG'] == $arTag['ID']) $is_selected = true;
        ?>
        <a href="<?=$link;?>" class="<? if ($is_selected):?> is-selected<? endif;?>" style="background-color: #<?=$arTag['COLOR'];?>">#<?=$arTag['NAME'];?></a>
        <? endforeach;?>
    </div>
    <? endif;?>
</div>
<div class="hidden-md-up mb-30">
    <div class="news-filter news-item__section">
        <span class="block mb-10">Показать новости за:</span>
        <div class="form-select js-select">
            <select class="js-SelecLink">
                <option data-href="/news/" selected>Все</option>
                <? foreach ($arResult['YEARS'] as $k=>$arYears):
                    $is_selected = false; 
                    $link = $APPLICATION->GetCurPageParam('year='.$arYears,array('year'));
                    if ($arParams['CURRENT']['YEAR'] == $arYears) $is_selected = true;
                ?>
                <option data-href="<?=$link;?>"<? if ($is_selected):?> selected<? endif;?>><?=$arYears;?></option>
                <? endforeach;?>
                <option data-href="/news/"<? if (!$arParams['CURRENT']['YEAR']):?> is-selected<? endif;?>>Архив</option>
            </select>
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
    <? if ($arResult['TAGS']):?>
    <div class="news-filter news-item__section">
        <span class="block mb-10">Показать по хэштегам:</span>
        <div class="form-select js-select js-SelecLink">
            <select class="js-SelecLink">
                <option data-href="/news/" selected>Все</option>
                <? foreach ($arResult['TAGS'] as $arTag):
                    $is_selected = false; 
                    $link = $APPLICATION->GetCurPageParam('tag='.$arTag['ID'],array('tag'));
                    if ($arParams['CURRENT']['TAG'] == $arTag['ID']) $is_selected = true;
                ?>
                <option data-href="<?=$link;?>"<? if ($is_selected):?> selected<? endif;?>>#<?=$arTag['NAME'];?></option>
                <? endforeach;?>
            </select>
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
    <? endif;?>
</div>
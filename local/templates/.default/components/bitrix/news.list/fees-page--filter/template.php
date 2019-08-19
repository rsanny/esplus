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

<? foreach ($arResult['YEARS'] as $k=>$arYears):
    $is_selected = false;
    $link = $APPLICATION->GetCurPageParam('year='.$arYears,array('year','SECTION_CODE_PATH'));
     
    if (is_array($arYears)) {
        $link = $APPLICATION->GetCurPageParam('year='.implode(',',$arYears),array('year','SECTION_CODE_PATH'));
        $arYears = $k;
    }
    if ($arParams['CURRENT_YEAR'] == $arYears) $is_selected = true;
    if (is_array($arParams['CURRENT_YEAR']) && $arYears == $arResult['ARCHIVE_NAME'])  $is_selected = true;
    
?>
<a href="<?=$link;?>" class="<? if ($is_selected):?> is-selected<? endif;?>"><?=$arYears;?></a>
<? 
endforeach;?>


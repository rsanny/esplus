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
global $OptimalGroup;
include($_SERVER["DOCUMENT_ROOT"].INCLUDE_PATH."site/".$OptimalGroup['SITE']['CODE']."/clients/".$OptimalGroup['GROUP']."-menu.php");
?>
<? foreach ($arClientsMenu as $GroupName => $arMenuGroup):?>
<div class="fs-24 color-orange mb-20"><b><?=$GroupName;?></b></div>
<div class="row mb-10">
    <? foreach ($arMenuGroup as $menuIcon => $arMenu):?>
    <div class="col col-12 col-md-6 col-lg-4 mb-30">
        <a href="<?=$arMenu['LINK'];?>" class="client-section js-matchHeight">
            <i><img src="<?=MEDIA_PATH;?>icons/icon-<?=$menuIcon;?>.png" alt=""></i>
            <span><?=$arMenu['NAME'];?></span>
        </a>
    </div>
    <? endforeach;?>
</div>
<? endforeach;?>
<? include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/clients_bottom.php");?>
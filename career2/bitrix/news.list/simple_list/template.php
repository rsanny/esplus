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
    <div class="file-list--small">
        <?if($arResult["UK"]["ACTIVE"]=="Y"):?>
            <div><b>Вакансии Управляющей компании (Москва)</b></div>
            <?foreach($arResult["UK"]["ITEMS"] as $arItemUk):
                $icon = "career";
                if (strpos(strtolower($arSection['NAME']),'гпх') !== false)
                $icon = "career_gph";
                ?>
                <a href="<?=$arItemUk['DETAIL_PAGE_URL'];?>" class="file-item--small" id="<?=$this->GetEditAreaId($arItemUk['ID']);?>">
                    <span><i class="icon-file--career-2"></i></span>
                    <b><?=$arItemUk['NAME'];?></b>
                </a>
            <? endforeach;?>
        <?endif?>
        <? foreach ($arResult['SECTIONS'] as $idSect => $arSection):?>
            <?
            $res = CIBlockSection::GetByID($idSect);
            if($ar_res = $res->GetNext()) {
                $sectionName=$ar_res['NAME'];
            }
            if(!empty($arSection["ITEMS"])):
            ?>
            <div><b>Вакансии <?=$sectionName;?></b></div>
        <?endif;?>
    <?foreach($arSection["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $icon = "career";
        if (strpos(strtolower($arSection['NAME']),'гпх') !== false)
            $icon = "career_gph";
        ?>
        <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="file-item--small" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <span><i class="icon-file--career-2"></i></span>
            <b><?=$arItem['NAME'];?></b>
        </a>
    <? endforeach;?>
        <?endforeach;?>
        <?if($arResult["UK"]["ACTIVE"]=="N"):?>
            <div><b>Вакансии Управляющей компании (Москва)</b></div>
            <?foreach($arResult["UK"]["ITEMS"] as $arItemUk):
                $icon = "career";
                if (strpos(strtolower($arSection['NAME']),'гпх') !== false)
                    $icon = "career_gph";
                ?>
                <a href="<?=$arItemUk['DETAIL_PAGE_URL'];?>" class="file-item--small" id="<?=$this->GetEditAreaId($arItemUk['ID']);?>">
                    <span><i class="icon-file--career-2"></i></span>
                    <b><?=$arItemUk['NAME'];?></b>
                </a>
            <?endforeach;?>
        <?endif?>
    </div>
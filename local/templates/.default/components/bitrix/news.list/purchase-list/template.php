<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
CJSCore::Init(array('date'));
?>
<form class="purchase-filter project-filter" action="<?=$arParams['SEARCH_URL'];?>">
    <div class="row">
        <div class="col col-12 col-md-12 col-lg-8">
            <div class="project-filter--row__label date-inputs--label">Период поиска:</div>
            <div class="overflow clearfix date-inputs">
                <div class="form-control--middle">с</div>
                <div class="form-control--date" onclick="BX.calendar({node: this, field: 'date[FROM]', bTime: false});">
                    <i class="fa fa-calculator ink-reaction"></i>
                    <input type="text" name="date[FROM]" value="<?=$arParams['FROM'];?>" readonly class="form-control is-small" placeholder="Дата начала">
                </div>
                <div class="form-control--middle">по</div>
                <div class="form-control--date" onclick="BX.calendar({node: this, field: 'date[TILL]', bTime: false});">
                    <i class="fa fa-calculator ink-reaction"></i>
                    <input type="text" name="date[TILL]" value="<?=$arParams['TILL'];?>" readonly class="form-control is-small" placeholder="Дата оканчания" onclick="BX.calendar({node: this, field: this, bTime: false});">
                </div>
            </div>
        </div>
        <div class="col col-12 col-md-12 col-mt-md-20 col-lg-4">
            <div class="purchase-search">
                <input type="text" class="form-control is-small" name="q" placeholder="Поиск закупок" value="<?=$arParams['Q'];?>">
                <button class="btn btn-orange" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-md-12 col-lg-8 col-xl-6">
            <div class="project-filter--row">
                <div class="project-filter--row__label">Год:</div>
                <div class="overflow">
                    <a href="<?=$arResult['LIST_PAGE_URL'];?>"  class="dotted<? if(empty($arParams['PARENT_SECTION'])):?> is-selected<? endif;?>">Все время</a>
                    <? foreach ($arResult['SECTIONS'] as $arSection):?>
                    <a href="<?=$arSection['SECTION_PAGE_URL'];?>" class="dotted<? if (!empty($arParams['PARENT_SECTION']) && $arParams['PARENT_SECTION'] == $arSection['ID']):?> is-selected<? endif;?>"><?=$arSection['NAME'];?></a>
                    <? endforeach;?>
                </div>                    
            </div>
        </div>
        <div class="col col-12 col-lg-4 col-xl-6 text-center text-lg-right col-mt-md-20">
            <button type="submit" class="btn btn-orange w-170">Искать</button>
        </div>
    </div>
</form>
<? if (count($arResult['ITEMS'])):?>
<div class="table-overflow">
    <table class="table purchase-table table-hover table-striped">
        <thead>
            <th>Дата публикации</th>
            <th>Название закупки</th>
            <th>Официальный источник публикаций</th>
            <th>Извещение</th>
            <th>Итоги закупки</th>
        </thead>
        <tbody>
    <? foreach ($arResult['ITEMS'] as $arItem):?>
            <tr class="fs-14">
                <td width="10%"><?=$arItem['PROPERTIES']['DATE_POST']['VALUE'];?></td>
                <td width="25%"><?=$arItem['NAME'];?></td>
                <td width="25%"><?=$arItem['PROPERTIES']['SOURCE']['~VALUE'];?></td>
                <td width="15%">
                    <? 
                    foreach ($arItem['PROPERTIES']['NOTICE']['VALUE'] as $k=>$arNotice):
                        $link = CFile::GetPath($arNotice);
                        $text = $arItem['PROPERTIES']['NOTICE']['DESCRIPTION'][$k];
                    ?>
                        <div><a href="<?=$link;?>" target="_blank" class="color-orange"><?=$text?$text:"Закупочная документация";?></a></div>
                    <? endforeach;?>
                </td>
                <td width="10%">
                <? 
                    foreach ($arItem['PROPERTIES']['PROTOCOL']['VALUE'] as $k=>$arProtocol):
                        $link = CFile::GetPath($arProtocol);
                        $text = $arItem['PROPERTIES']['PROTOCOL']['DESCRIPTION'][$k];
                    ?>
                        <div><a href="<?=$link;?>" target="_blank" class="color-orange"><?=$text?$text:"Протокол";?></a></div>
                    <? endforeach;?></td>
            </tr>
    <? endforeach;?>
        </tbody>
    </table>
</div>
<? else:?>
<div class="z5 text-center purchase-item">Нет информации о закупках</div>
<? endif;?>
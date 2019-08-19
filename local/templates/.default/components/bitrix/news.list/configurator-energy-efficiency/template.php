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
$arDefault = array(
    "QUANTITY" => 500,
    "TIME" => 8,
    "PRICE" => 4.56
);
if ($arParams['PARENT_SECTION'] == 186)
    $arDefault = array(
        "QUANTITY" => 700,
        "TIME" => 8,
        "PRICE" => 4.7
    );
$selectedLed = reset($arResult['ITEMS']);
?>
<div class="content-container energy-efficiency-block">
    <div class="row no-gutters counters-key electric-config">
        <div class="col col-12 col-lg-4">
            <i class="fa fa-caret-right"><b></b></i>
            <div class="counters-calc">
                <div class="counters-calc--index">01</div>
                <div class="counters-calc--title">Укажите параметры<small>Выберите тип и мощность установленных ламп</small></div>
                <div class="form-select js-select form-group">			
                    <select id="ee-lamp-item" class="ee-lamp-select">
                    <? foreach($arResult['ITEMS'] as $arItem): ?>
                    <option 
                        value="<?=$arItem['ID']?>" 
                        data-parent-id="<?=$arItem['IBLOCK_SECTION_ID']?>" 
                        data-lamp-power="<?=$arItem['PROPERTIES']['LAMP_POWER']['VALUE']?>" 
                        data-led-power="<?=$arItem['PROPERTIES']['LED_POWER']['VALUE']?>" 
                        data-lamp-luminous="<?=$arItem['PROPERTIES']['LAMP_LUMINOUS']['VALUE']?>" 
                        data-led-luminous="<?=$arItem['PROPERTIES']['LED_LUMINOUS']['VALUE']?>"
                        data-led-name="<?=$arItem['PROPERTIES']['LED_ANALOG']['VALUE']?>"
                    ><?=$arItem['NAME']?></option>
                    <?endforeach?>
                    </select>
                    <i class="fa fa-chevron-down"></i>
                </div>
                <div class="row flex-vertical form-group">
                    <div class="col col-12 col-md-7 col-xl-8 text-md-right text-left form-label fs-14">Введите количество
установленных ламп, шт.</div>
                    <div class="col col-12 col-md-5 col-xl-4"><input class="form-control text-center fs-14 pl-0 pr-0" value="<?=$arDefault['QUANTITY'];?>" placeholder="" id="ee-lamp-quantity" maxlength="6"></div>
                </div>
                <div class="row flex-vertical form-group">
                    <div class="col col-12 col-md-7 col-xl-8 text-md-right text-left form-label fs-14">Введите среднее число
часов горения в сутки, час.</div>
                    <div class="col col-12 col-md-5 col-xl-4">
                        <div class="form-select js-select form-group">
                            <select id="ee-lamp-hours">
                            <? for ($opt=1;$opt<=24;$opt++):?>
                                <option<? if ($arDefault['TIME'] == $opt):?> selected<? endif;?> value="<?=$opt;?>"><?=$opt;?></option>
                            <? endfor;?>
                            </select>
                        </div>
                    </div>
                </div>                   
                <div class="row flex-vertical form-group">
                    <div class="col col-12 col-md-7 col-xl-8 text-md-right text-left form-label fs-14">Введите среднемесячную
цену в руб. за 1 кВт.ч</div>
                    <div class="col col-12 col-md-5 col-xl-4"><input class="form-control text-center fs-14 pl-0 pr-0" value="<?=$arDefault['PRICE'];?>" placeholder="" onkeyup="validate(this)" id="ee-lamp-cost"></div>
                </div>                
            </div>
        </div>
        <div class="col col-12 col-lg-8">
            <div class="counters-calc">
                <div class="counters-calc--index">02</div>
                <div class="counters-calc--title">Сравните эффективность</div>
                
                <div class="row electric-config--compare mt-40">
                    <div class="col col-12 col-md-6">
                        <div class="electric-config--compare_title fs-14 mb-20">
                            <div class="fs-18">До замены на светодиоды</div>
                            <a class="dashed-in"><span class="lamp-name"><?=$selectedLed['NAME'];?></span><i class="fa fa-question-circle-o"></i></a>
                        </div>
                        <div class="fs-14 mb-20 color-grey"><div class="fs-24" id="ee-lamp-power"><?=$arResult['LAMP_POWER']?></div>Мощность ламп, Вт</div>
                        <div class="fs-14 mb-20 color-grey"><div class="fs-24" id="ee-lamp-luminous"><?=$arResult['LAMP_LUMINOUS']?></div>Светвой поток ламп, Лм</div>
                        <div class="fs-14 mb-20 color-grey"><div class="fs-24 lamp-efficiency"></div>Энергопотребление, кВт.ч</div>
                        <div class="fs-14 color-grey"><div class="fs-24 lamp-spending"></div>Затраты на освещение, руб. в год</div>
                    </div>                    
                    <div class="col col-12 col-md-6 mt-40 mt-md-0">
                        <div class="electric-config--compare_title fs-14 mb-20">
                            <div class="fs-18 color-orange">После замены на светодиоды</div>
                            <a class="dashed-in color-orange"><span class="led-name"><?=$selectedLed['PROPERTIES']['LED_ANALOG']['VALUE'];?></span><i class="fa fa-question-circle-o"></i></a>
                        </div>
                        <div class="fs-14 mb-20 color-grey"><div class="fs-24 color-orange" id="ee-led-power"><?=$arResult['LED_POWER']?></div>Мощность ламп, Вт</div>
                        <div class="fs-14 mb-20 color-grey"><div class="fs-24 color-orange" id="ee-led-luminous"><?=$arResult['LED_LUMINOUS']?></div>Светвой поток ламп, Лм</div>
                        <div class="fs-14 mb-20 color-grey"><div class="fs-24 color-orange led-efficiency"></div>Энергопотребление, кВт.ч</div>
                        <div class="fs-14 color-grey"><div class="fs-24 color-orange led-spending"></div>Затраты на освещение, руб. в год</div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="bg-info bg-message text-center color-grey mb-20">
        <div class="fs-18 fw-500 mb-10">Ожидаемый эффект от замены ламп на светодиоды</div>
        <div class="row flex-bottom fs-14">
            <div class="col col-12 col-md-6 text-left text-md-right">Экономия затрат в год:</div>
            <div class="col col-12 col-md-6 color-orange text-left"><span class="fs-24 cost-economy"></span> руб.</div>
            <div class="col col-12 col-md-6 text-left text-md-right">Экономия электроэнергии в год:</div>
            <div class="col col-12 col-md-6 color-orange text-left"><span class="fs-24 energy-economy"></span> кВт.ч</div>
        </div>
    </div>      
    
    <div class="text-center">
        <a href="#" class="btn btn-orange w-230 js-popUpData" data-fancybox-href="<?=AJAX_PATH;?>form/service-order.php"><span class="fa-angle-btn">Заказать услугу</span></a>

        <div class="fs-14 color-grey mt-20">Оперативно перезвоним в рабочее время для уточнения деталей</div>
    </div>                        
                
</div>
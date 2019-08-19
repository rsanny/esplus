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
if ($arResult['GRID']['ROW']):
?>
<div class="none">
    <div id="how-see" class="popup-form">
    <div class="section-title text-center"><span>Как определить ?</span></div>
    Счетчики бывают однофазными и трехфазными. Как правило, в многоквартирных домах используются однофазные, но в современных и элитных домах все чаще встречаются трехфазные.<br>
Как определить, какой счетчик у Вас стоит? Если к счетчику подведено две или три жилы проводов (или двух-, трехжильный кабель), то счетчик однофазный. Если жил больше, то трехфазный.</div>
</div>
<div class="row no-gutters counters-key">
    <div class="col col-12 col-md-6 col-lg-4">
        <i class="fa fa-caret-right"><b></b></i>
        <div class="counters-calc">
            <div class="counters-calc--index">01</div>
            <div class="counters-calc--title">Выберите тип электросчетчика</div>
            <div class="one-radio js-OneRadio one-ratio--gray" id="radio-tariff">
                <label data-value="1" class="is-selected"><i></i>Однотарифный</label>
                <label data-value="2" class=""><i></i>Многотарифный</label>
                <input type="hidden" value="1" name="tariff">
                <span class="is-selected-0"></span>
            </div>
            <div class="counters-calc--tarrif clearfix">
                <div class="counters-calc--tarrif__text">Определите тип прибора учета, рассчитав экономию с помощью <a href="#configurator" class="counters-calc--tarrif__link dashed-in color-orange js-ScrollTo"><span>калькулятора тарифов</span><i class="fa fa-calculator"></i></a></div>
            </div>
            <div class="one-radio js-OneRadio one-ratio--gray" id="radio-phase">
                <label data-value="1" class="is-selected"><i></i>Однофазный</label>
                <label data-value="2" class=""><i></i>Трехфазный</label>
                <input type="hidden" value="1" name="phase">
                <span class="is-selected-0"></span>
            </div>
            <div class="counters-calc--question">
                <a href="#how-see" class="dashed-in js-popUp"><i class="fa fa-question"></i><span>Как определить ?</span></a>
            </div>
        </div>
    </div>
    <div class="col col-12 col-md-6 col-lg-4">
        <i class="fa fa-caret-right"><b></b></i>
        <div class="counters-calc">
            <div class="counters-calc--index">02</div>
            <div class="counters-calc--title">Выберите модель электросчетчика</div>
            <div class="counters-calc--item">
                <div class="counters-calc--item__img"><img alt=""></div>
                <div class="clearfix">
                    <div class="counters-calc--item__name pull-left"><b></b><span></span></div>
                    <div class="counters-calc--item__other pull-right">
                        <div class="dropdown">
                            <span data-fancybox-href="#counter-list" class="dropdown--label fs-14 js-popUp"><span>Выбрать другой</span><i class="fa-angle-down fa"></i></span>
                        </div>                                                
                    </div>
                </div>
                <div class="none">
                    <div class="js-SwitchCounter inline-product--list popup-form overflow" id="counter-list">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-12 col-md-12 col-lg-4">
        <div class="counters-calc">
            <div class="counters-calc--index">03</div>
            <div class="counters-calc--title">Стоимость комплексной услуги<br>«Замена электросчетчика»</div>
            <div class="counters-calc--discount"><span></span></div>
            <div class="counters-calc--price"></div>
            <div class="counters-calc--total">
                <p>Стоимость включает в себя:</p>
                <ul class="list-checked">
                    <li>новый прибор учета</li>
                    <li>работы по установке</li>
                    <li>бесплатную опломбировку</li>
                </ul>
            </div>                    
            <div class="counters-calc--btn"><a href="#" class="btn btn-orange w-170 btn-small js-ElectBuy">Заказать</a></div>
            <div class="counters-calc--text">Продолжительность работ не более 30 минут</div>
        </div>
    </div>
</div>
<script>
ElectItems = <?=CUtil::PhpToJSObject($arResult['GRID']['ROW'])?>;
</script>
<? endif;?>
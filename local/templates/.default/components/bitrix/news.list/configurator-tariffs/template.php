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

if(!empty($arResult["ITEMS"])):
?>
<input type="hidden" value="<?=$arParams['CURRENT_REGION'];?>" id="tariff-branch-id">
<input type="hidden" value="50" id="tariff-peak">
<input type="hidden" value="20" id="tariff-half-peak">
<input type="hidden" value="30" id="tariff-night-peak">
<div class="text-center fs-16 mb-10">Укажите Ваш среднемесяцный расход электроэнергии </div>
<div class="text-center mb-30">
    <div class="form-control--container ib w-230">
        <input type="text" value="500" class="monthly-consumption-js form-control">
        <span class="form-control--label">кВт*ч</span>
    </div>
</div>
<div class="text-center fs-16 mb-10">Выберите тип Вашей плиты:</div>
<div class="text-center configurator-type">
    <label class="configurator-type--gaz">
        <input type="radio" class="plate-type-js" name="plate_type" value="415" checked>
        <i></i>
        <span>Газовая плита</span>
    </label>
    <label class="configurator-type--elec">
        <input type="radio" class="plate-type-js" name="plate_type" value="416">
        <i></i>
        <span>Электроплита</span>
    </label>
</div>

<div class="text-center fs-16 mb-10 mt-20">Определите параметры Вашего энергопотребления в течении дня (перемещайте оранжевые точки).</div>
	
<div id="tariffs-configurator" class="configurator-range">
    <input type="hidden" id="power_consumption" value="" name="range" />
</div>
		<div class="row mb-20">
			<div class="col col-md-4 text-center tariffs-column column_1 tariffs-digs--bottom">
				<div class="fs-24">Пик</div>
                <div class="fs-16 mt-10 mb-10">7:00 - 10:00 и 17:00 - 21:00</div>
				<div class="peak-js fs-30 color-red"><span>50</span>%</div>
			</div>
			<div class="col col-md-4 text-center tariffs-column column_2 tariffs-digs--bottom">
				<div class="fs-24">Полупик</div>
                <div class="fs-16 mt-10 mb-10">10:00 - 17:00 и 21:00 - 23:00</div>
				<div class="half-load-peak-js fs-30 color-green"><span>20</span>%</div>
			</div>
			<div class="col col-md-4 text-center tariffs-column column_3 tariffs-digs--bottom">
				<div class="fs-24">Ночь</div>
                <div class="fs-16 mt-10 mb-10">23:00 - 7:00</div>
				<div class="peak-night-js fs-30 color-blue"><span>30</span>%</div>
			</div>
		</div>
		<div class="row mb-30">
			<div class="col-md-4 text-center tariffs-column column_1">
			    <div class="tariff-label">
				    <b class="fs-24">1 тарифный учет</b>
				    <div>
				        <span class="fs-16">Ваш среднемесячный счет: </span><br>
				        <span class="one-tariff-account-js fs-24"><span>0</span> руб</span>
                    </div>
                </div>
				
			</div>
			<div class="col-md-4 text-center tariffs-column column_2 mt-30 mt-md-0">
				<div class="tariff-label">
				    <b class="fs-24">2-х тарифный учет</b>
				    <div>
				        <span class="fs-16">Ваш среднемесячный счет:</span><br>
                        <span class="two-tariff-account-js fs-24"><span>0</span> руб</span>
                    </div>
                </div>
			</div>
			<div class="col-md-4 text-center tariffs-column column_3 mt-30 mt-md-0">
				<div class="tariff-label">
				    <b class="fs-24">3-х тарифный учет</b>
				    <div>
				        <span class="fs-16">Ваш среднемесячный счет:</span><br>
				        <span class="three-tariff-account-js fs-24"><span>0</span> руб</span>
                    </div>
                </div>
			</div>
		</div>	
		<div class="tariff-details hidden-md-down">
			<?foreach($arResult["ITEMS"] as $arItem):?>	
			<div class="row">
				<div class="col-md-4 tariffs-column column_1">
					<div class="tariffs-table--label fs-14 color-black mb-10">Детализация:</div>
					<div class="mb-20">
						<table class="table-tarrif-one table fs-14">
						    <thead>
                                <tr>
                                    <th>Тарифная зона</th>
                                    <th>Расход (кВт.ч)</th>
                                    <th>Тариф (руб./кВт.ч)</th>
                                    <th>Стоимость (руб.)</th>
                                </tr>
                            </thead>
                            <tbody>    
                                <tr class="tariff-tr">
                                    <td>Пик</td>
                                    <td class="tariff-peak-outgo-js tariff-outgo-js">250</td>
                                    <td class="tariff-kw"><?=$arItem['PROPERTIES']['TARIFF_ONE']['VALUE']?></td>
                                    <td class="tariff-sum-js"></td>
                                </tr>
                                <tr class="tariff-tr">
                                    <td>Полупик</td>
                                    <td class="tariff-half-peak-outgo-js tariff-outgo-js">100</td>
                                    <td class="tariff-kw"><?=$arItem['PROPERTIES']['TARIFF_ONE']['VALUE']?></td>
                                    <td class="tariff-sum-js"></td>
                                </tr>
                                <tr class="tariff-tr">
                                    <td>Ночь</td>
                                    <td class="tariff-night-peak-outgo-js tariff-outgo-js">150</td>
                                    <td class="tariff-kw"><?=$arItem['PROPERTIES']['TARIFF_ONE']['VALUE']?></td>
                                    <td class="tariff-sum-js"></td>
                                </tr>
                            </tbody>
						</table>
					</div>
				</div>
				<div class="col-md-4 tariffs-column column_2">
					<div class="tariffs-table--label fs-14 color-black mb-10">Детализация:</div>
					<div class="mb-20">
						<table class="table-tarrif-two table fs-14">
							<thead>
                                <tr>
                                    <th>Тарифная зона</th>
                                    <th>Расход (кВт.ч)</th>
                                    <th>Тариф (руб./кВт.ч)</th>
                                    <th>Стоимость (руб.)</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr class="tariff-tr">
                                    <td>Пик</td>
                                    <td class="tariff-peak-outgo-js tariff-outgo-js">250</td>
                                    <td class="tariff-kw"><?=$arItem['PROPERTIES']['TARIFF_TWO']['VALUE']?></td>
                                    <td class="tariff-sum-js"></td>
                                </tr>
                                <tr class="tariff-tr">
                                    <td>Полупик</td>
                                    <td class="tariff-half-peak-outgo-js tariff-outgo-js">100</td>
                                    <td class="tariff-kw"><?=$arItem['PROPERTIES']['TARIFF_TWO']['VALUE']?></td>
                                    <td class="tariff-sum-js"></td>
                                </tr>
                                <tr class="tariff-tr">
                                    <td>Ночь</td>
                                    <td class="tariff-night-peak-outgo-js tariff-outgo-js">150</td>
                                    <td class="tariff-kw"><?=$arItem['PROPERTIES']['NIGHT_PEAK']['VALUE']?></td>
                                    <td class="tariff-sum-js"></td>
                                </tr>
                            </tbody>
						</table>
					</div>
				</div>
				<div class="col-md-4 tariffs-column column_3">
					<div class="tariffs-table--label fs-14 color-black mb-10">Детализация:</div>
					<div class="mb-20">
						<table class="table-tarrif-three table fs-14">
							<thead>
                                <tr>
                                    <th>Тарифная зона</th>
                                    <th>Расход (кВт.ч)</th>
                                    <th>Тариф (руб./кВт.ч)</th>
                                    <th>Стоимость (руб.)</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr class="tariff-tr">
                                    <td>Пик</td>
                                    <td class="tariff-peak-outgo-js tariff-outgo-js">250</td>
                                    <td class="tariff-kw"><?=$arItem['PROPERTIES']['PEAK']['VALUE']?></td>
                                    <td class="tariff-sum-js"></td>
                                </tr>
                                <tr class="tariff-tr">
                                    <td>Полупик</td>
                                    <td class="tariff-half-peak-outgo-js tariff-outgo-js">100</td>
                                    <td class="tariff-kw"><?=$arItem['PROPERTIES']['HALF_PEAK']['VALUE']?></td>
                                    <td class="tariff-sum-js"></td>
                                </tr>
                                <tr class="tariff-tr">
                                    <td>Ночь</td>
                                    <td class="tariff-night-peak-outgo-js tariff-outgo-js">150</td>
                                    <td class="tariff-kw"><?=$arItem['PROPERTIES']['NIGHT_PEAK']['VALUE']?></td>
                                    <td class="tariff-sum-js"></td>
                                </tr>
                            </tbody>
						</table>
					</div>
				</div>
			</div>
			<?endforeach?>
		</div>
		<div class="row hidden-md-down js-ScrollRadio">
            <div class="col-md-4 tariffs-column column_1">
                <a href="#calc" class="btn btn-grey--dark block" data-value="1">Перейти на однотарифный учет</a>
            </div>
            <div class="col-md-4 tariffs-column column_2">
                <a href="#calc" class="btn btn-grey--dark block" data-value="2">Перейти на двухтарифный учет</a>
            </div>
            <div class="col-md-4 tariffs-column column_3">
                <a href="#calc" class="btn btn-grey--dark block" data-value="2">Перейти на трехтарифный учет</a>
            </div>
        </div>
<?else:?>
	Тарифов для данного филиала не найдено
<?endif?>
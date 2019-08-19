<?
define("STOP_STATISTICS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$tariff_peak = round($_POST['monthly_consumption']*$_POST['tariff_peak']/100);
$tariff_half_peak = round($_POST['monthly_consumption']*$_POST['tariff_half_peak']/100);
$tariff_night_peak = round($_POST['monthly_consumption']*$_POST['tariff_night_peak']/100);

CModule::IncludeModule('iblock');
$IBLOCK_ID = 11;
$arSelect = Array("ID", "NAME", 'PROPERTY_TARIFF_ONE', 'PROPERTY_TARIFF_TWO', 'PROPERTY_NIGHT_PEAK', 'PROPERTY_PEAK', 'PROPERTY_HALF_PEAK');
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", 'PROPERTY_PLATE_TYPE'=>$_POST['plate_type'], 'PROPERTY_BRANCH'=>$_POST['sec_id']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
	$arTariffInfo = $ob->GetFields();
}
?>
<div class="row">
	<div class="col-md-4 tariffs-column column_3">
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
                        <td class="tariff-peak-outgo-js tariff-outgo-js"><?=$tariff_peak?></td>
                        <td class="tariff-kw"><?=$arTariffInfo['PROPERTY_TARIFF_ONE_VALUE']?></td>
                        <td class="tariff-sum-js"></td>
                    </tr>
                    <tr class="tariff-tr">
                        <td>Полупик</td>
                        <td class="tariff-half-peak-outgo-js tariff-outgo-js"><?=$tariff_half_peak?></td>
                        <td class="tariff-kw"><?=$arTariffInfo['PROPERTY_TARIFF_ONE_VALUE']?></td>
                        <td class="tariff-sum-js"></td>
                    </tr>
                    <tr class="tariff-tr">
                        <td>Ночь</td>
                        <td class="tariff-night-peak-outgo-js tariff-outgo-js"><?=$tariff_night_peak?></td>
                        <td class="tariff-kw"><?=$arTariffInfo['PROPERTY_TARIFF_ONE_VALUE']?></td>
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
                        <td class="tariff-peak-outgo-js tariff-outgo-js"><?=$tariff_peak?></td>
                        <td class="tariff-kw"><?=$arTariffInfo['PROPERTY_TARIFF_TWO_VALUE']?></td>
                        <td class="tariff-sum-js"></td>
                    </tr>
                    <tr class="tariff-tr">
                        <td>Полупик</td>
                        <td class="tariff-half-peak-outgo-js tariff-outgo-js"><?=$tariff_half_peak?></td>
                        <td class="tariff-kw"><?=$arTariffInfo['PROPERTY_TARIFF_TWO_VALUE']?></td>
                        <td class="tariff-sum-js"></td>
                    </tr>
                    <tr class="tariff-tr">
                        <td>Ночь</td>
                        <td class="tariff-night-peak-outgo-js tariff-outgo-js"><?=$tariff_night_peak?></td>
                        <td class="tariff-kw"><?=$arTariffInfo['PROPERTY_NIGHT_PEAK_VALUE']?></td>
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
                        <td class="tariff-peak-outgo-js tariff-outgo-js"><?=$tariff_peak?></td>
                        <td class="tariff-kw"><?=$arTariffInfo['PROPERTY_PEAK_VALUE']?></td>
                        <td class="tariff-sum-js"></td>
                    </tr>
                    <tr class="tariff-tr">
                        <td>Полупик</td>
                        <td class="tariff-half-peak-outgo-js tariff-outgo-js"><?=$tariff_half_peak?></td>
                        <td class="tariff-kw"><?=$arTariffInfo['PROPERTY_HALF_PEAK_VALUE']?></td>
                        <td class="tariff-sum-js"></td>
                    </tr>
                    <tr class="tariff-tr">
                        <td>Ночь</td>
                        <td class="tariff-night-peak-outgo-js tariff-outgo-js"><?=$tariff_night_peak?></td>
                        <td class="tariff-kw"><?=$arTariffInfo['PROPERTY_NIGHT_PEAK_VALUE']?></td>
                        <td class="tariff-sum-js"></td>
                    </tr>
                </tbody>
			</table>
		</div>
	</div>
</div>
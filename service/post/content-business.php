<?
$APPLICATION->SetTitle("Как передать показания");
?>
<div class="service-form service-tabs">    
    <div class="form-group--title text-left text-md-center">как Передать показания</div>
    <div class="row">
        <div class="col col-12 col-md-5 offset-xl-1 col-xl-4 js-Tabs post-value--business__tabs" data-container=".post-value--tab">
            <a href="#post-value-tab-1" class="btn btn-grey-light btn-middle block w-300 text-left block is-selected mlra">
                <i class="icon-elect">
                    <img src="<?=MEDIA_PATH;?>icons/icon-contract--elect.png" alt="" class="is-normal">
                    <img src="<?=MEDIA_PATH;?>icons/icon-contract--elect-white.png" alt="" class="is-white">
                </i>ЭЛЕКТРОЭНЕРГИЯ
            </a>
            <a href="#post-value-tab-2" class="btn btn-grey-light btn-middle block w-300 text-left block mlra">
                <i class="icon-water">
                    <img src="<?=MEDIA_PATH;?>icons/icon-contract--water.png" alt="" class="is-normal">
                    <img src="<?=MEDIA_PATH;?>icons/icon-contract--water-white.png" alt="" class="is-white">
                </i>ПОСТАВКА ГОРЯЧЕЙ ВОДЫ
            </a>
            <a href="#post-value-tab-3" class="btn btn-grey-light btn-middle block w-300 text-left block mlra">
                <i class="icon-heat">
                    <img src="<?=MEDIA_PATH;?>icons/icon-contract--heat.png" alt="" class="is-normal">
                    <img src="<?=MEDIA_PATH;?>icons/icon-contract--heat-white.png" alt="" class="is-white">
                </i>ТЕПЛОСНАБЖЕНИЕ
            </a>
        </div>
        <div class="col col-12 col-md-7 col-xl-6 mt-20 mt-md-0">
            <div class="form-content rounded">
                <div class="post-value--tab" id="post-value-tab-1">
                    <div class="form-group--title text-left mb-20">ЭЛЕКТРОЭНЕРГИЯ</div>
                    Для определения величины потребленной электрической энергии Потребителю (Покупателю) необходимо снимать показания расчетных приборов учета по состоянию на 00 часов 00 минут 1-го дня месяца, следующего за расчетным и передавать Гарантирующему поставщику и сетевой организации по факсу или электронной почте, указанным в договоре энергоснабжения (купли-продажи электрической энергии (мощности)), до окончания 1-го дня месяца, следующего за расчетным, а также Гарантирующему поставщику в письменной форме в виде акта снятия показаний расчетных приборов учета в течение 3 рабочих дней.
                </div>
                <div class="post-value--tab none" id="post-value-tab-2">
                    <div class="form-group--title text-left mb-20">ПОСТАВКА ГОРЯЧЕЙ ВОДЫ</div>
                    Для определения объема поданной горячей воды необходимо снимать показания приборов учета объемов потребления горячей воды на последнее число расчетного периода и передавать указанные сведения не позднее даты, указанной в договоре. Передача показаний приборов учета производится любыми доступными способами (почтовым отправлением, телеграммой, факсограммой, телефонограммой или с использованием информационно-телекоммуникационной сети "Интернет"), позволяющими подтвердить получение показаний приборов учета.
                </div>
		<div class="post-value--tab none" id="post-value-tab-3">
                    <div class="form-group--title text-left mb-20">ТЕПЛОСНАБЖЕНИЕ</div>
                    Для определения количества потребленной тепловой энергии и теплоносителя необходимо передавать в Теплоснабжающую организацию ежемесячно, до окончания 2-ого дня месяца, следующего за расчетным месяцем, сведения о показаниях приборов учета по состоянию на 1-е число месяца, следующего за расчетным, а также сведения о текущих показаниях приборов учета в течение 2 (двух) рабочих дней после получения запроса о предоставлении таких сведений от Теплоснабжающей организации. Показания предоставляются в виде подписанного отчета о теплопотреблении.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="service-form service-tabs">
    <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/form/online-pay.php', Array(), Array("MODE"=> "html"));?>
</div>

<div class="index-section">

<div class="section-title text-center"><span>Как оплатить другими способами</span></div>

    <div class="row text-center">
        <div class="col col-12 col-md-4">
            <div class="mb-20 text-center"><img src="<?=MEDIA_PATH;?>icons/icon-pay--pc.png" alt="" class="img-responsive ib"></div>
            <div class="z5 color-orange text-uppercase mb-30">Личный кабинет</div>
            <div class="mb-20" style="height:12%">
                <b>Оплачивайте Ваши квитанции с помощью личного кабинета</b>
            </div>
            <a href="/service/pc/" class="btn btn-orange w-170"><span class="fa-angle-btn">Подробнее</span></a>
        </div>
        <div class="col col-12 col-md-4 mt-md-0 mt-40">
            <div class="mb-20 text-center"><img src="<?=MEDIA_PATH;?>icons/icon-pay--office.png" class="img-responsive ib"></div>
            <div class="z5 color-orange text-uppercase mb-30">Офис компании</div>
            <div class="mb-20" style="height:12%"><b>Выберите ближайший для Вас офис обслуживания</b></div>
            <a href="/offices/" class="btn btn-orange w-170"><span class="fa-angle-btn">Подробнее</a>
        </div>
        <div class="col col-12 col-md-4 mt-md-0 mt-40">
            <div class="mb-20 text-center"><img src="<?=MEDIA_PATH;?>icons/icon-pay--partners.png" alt="" class="img-responsive ib"></div>
            <div class="z5 color-orange text-uppercase mb-30">Партнеры</div>
            <div class="mb-20" style="height:12%" ><b>Оплачивайте услуги через наших партнеров</b></div>
            <a href="/partners/" class="btn btn-orange w-170"><span class="fa-angle-btn">Подробнее</a>
        </div>
    </div>
</div>
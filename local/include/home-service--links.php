<? 
global $OptimalGroup;
?>
<? if ($OptimalGroup['GROUP'] == "hide_shop_menu"):?>
<section class="index-section index-service__list bg-grey index-section">
    <div class="container">
        <div class="section-title text-center"><span>Информация</span></div>
        <div class="service-tabs--selector text-center row">
            <div class="col col-6 col-md-3 mb-20 mb-md-0">
                <a href="/clients/kak-oplatit/" class="icon-wallet"><i><span></span></i><span>Как оплатить</span></a>
            </div>
            <div class="col col-6 col-md-3 mb-20 mb-md-0">
                <a href="/clients/kak-peredat/" class="icon-transfer"><i><span></span></i><span>как передать показания</span></a>
            </div>
            <div class="col col-6 col-md-3">
                <a href="/clients/kak-zaklyuchit-dogovor/" class="icon-contract"><i><span></span></i><span>Как заключить договор</span></a>
            </div>
            <div class="col col-6 col-md-3">
                <a href="/clients/zadolzhennost/" class="icon-accounting"><i><span></span></i><span>Как проверить задолженность</span></a>
            </div>
        </div>
    </div>
</section>
<? elseif($OptimalGroup['GROUP'] == "all"):?>
<section class="index-section index-service__list bg-grey index-section">
    <div class="container">
        <div class="section-title text-center"><span>Информация</span></div>
        <div class="service-tabs--selector text-center clearfix">
            <div class="row">
                <div class="col col-4 col-md-2 mb-20 mb-sm-0">
                <a href="/service/pay/" class="icon-wallet"><i><span></span></i><span>Оплатить онлайн</span></a>
                </div>
                <div class="col col-4 col-md-2 mb-20 mb-sm-0">
                <a href="/service/post/" class="icon-transfer"><i><span></span></i><span>Передать показания</span></a>
                </div>
                <div class="col col-4 col-md-2 mb-20 mb-sm-0">
                <a href="/service/get/" class="icon-accounting"><i><span></span></i><span>Узнать задолженность</span></a>
                </div>
                <div class="col col-4 col-md-2 mb-20 mb-sm-0">
                <a href="/service/email/" class="icon-email"><i><span></span></i><span>Квитанция по e-mail</span></a>
                </div>
                <div class="col col-4 col-md-2 mb-20 mb-sm-0">
                <a href="/service/contract/" class="icon-contract"><i><span></span></i><span>Заключить договор</span></a>
                </div>
                <div class="col col-4 col-md-2 mb-20 mb-sm-0">
                <a href="/service/pc/" class="icon-pc"><i><span></span></i><span>Личный кабинет Клиента</span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<? endif;?>
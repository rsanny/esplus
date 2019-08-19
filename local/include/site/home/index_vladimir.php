<section class="index-section index-service__list bg-grey border-top-bottom index-section">
    <div class="container">
        <? \Optimalgroup\Template::OfferBanners();?>

        <div class="section-title text-center"><span>Сервисы</span></div>
        <div class="service-tabs--selector text-center row">
            <div class="col col-6 col-md-3 mb-20 mb-md-0">
                <a href="/service/pay/" class="icon-wallet"><i><span></span></i><span>Как оплатить</span></a>
            </div>
            <div class="col col-6 col-md-3 mb-20 mb-md-0">
                <a href="/service/post/" class="icon-transfer"><i><span></span></i><span>Как передать показания</span></a>
            </div>
            <div class="col col-6 col-md-3 mb-20 mb-md-0">                
                <a href="/service/contract/" class="icon-contract"><i><span></span></i><span>Договор</span></a>
            </div>
            <div class="col col-6 col-md-3 mb-20 mb-md-0">
                <a href="/service/pc/" class="icon-pc"><i><span></span></i><span>Личный кабинет Клиента</span></a>
            </div>
        </div>
    </div>
</section>

<section class="popular-products index-section">
    <div class="container">
        <div class="section-title text-center"><span>Хиты продаж</span></div>
        <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/site/shop/hit-list.php', array("LINK_TO_STORE"=>true), Array("MODE"=> "html"));?>
        <div class="section--btn text-center"><a href="<?=OptimalGroup\Url::Shop();?>" class="btn btn-transparent-border w-210">Интернет-магазин</a></div>
    </div>
</section>
<hr>
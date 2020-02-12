<? 
global $OptimalGroup;
?>
<? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/inline-auth.php', array(), Array("MODE"=> "html"));?>
<section class="index-section index-service__list bg-grey border-top-bottom index-section">
    <div class="container">
        <? \Optimalgroup\Template::OfferBanners();?>
        <div class="section-title text-center"><span>Онлайн сервисы</span></div>
        <div class="service-tabs--selector text-center js-Tabs clearfix service-mobile--row" data-container=".service-tab">
            <a href="#form1" class="is-selected icon-wallet js-MobileHref" data-mobile-href="/service/pay/"><i><span></span></i><span>Онлайн оплата</span></a>
            <a href="#form2" class="icon-transfer js-MobileHref" data-mobile-href="/service/post/"><i><span></span></i><span>Передать показания</span></a>
            <a href="#form3" class="icon-accounting js-MobileHref" data-mobile-href="/service/get/"><i><span></span></i><span>Узнать задолженность</span></a>
        </div>
        <div class="content-container hidden-sm-down">
            <div class="service-tab" id="form1">
                <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/form/online-pay-without-registration-kirov.php', Array(), Array("MODE"=> "html"));?>
            </div>
            <div class="service-tab none" id="form2">
                <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/form/post-value.php', Array(), Array("MODE"=> "html"));?>
            </div>
            <div class="service-tab none" id="form3">
                <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/form/get-balance.php', Array(), Array("MODE"=> "html"));?>
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
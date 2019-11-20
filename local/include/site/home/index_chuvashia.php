<?
global $OptimalGroup;
?>
<? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/inline-auth.php', array(), Array("MODE"=> "html"));?>
<? if ($OptimalGroup['DOMAIN'] == "chuvashia"):?>
    <section class="index-section index-service__list bg-grey border-top-bottom index-section">
        <div class="container">
            <div class="section-title text-center"><span>Онлайн сервисы</span></div>
            <div class="service-tabs--selector text-center js-Tabs clearfix service-mobile--row" data-container=".service-tab">
                <a href="#form1" class="is-selected icon-wallet js-MobileHref" data-mobile-href="/service/pay/"><i><span></span></i><span>оплатить онлайн</span></a>
                <a href="#form2" class="icon-transfer js-MobileHref" data-mobile-href="/service/post/"><i><span></span></i><span>Передать показания</span></a>
                <a href="#form3" class="icon-accounting js-MobileHref" data-mobile-href="/service/get/"><i><span></span></i><span>Узнать задолженность</span></a>
            </div>
            <div class="content-container hidden-sm-down">
                <div class="service-tab" id="form1">
                    <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/form/online-pay.php', Array(), Array("MODE"=> "html"));?>
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
<?

use \OptimalGroup\Url;

?>
<div class="row footer-top">
    <div class="col col-12 col-md-3">
        <div class="footer-menu--title text-md-left text-center js-FooterSection  js-FooterService">ЭнергосбыТ плюс
        </div>
        <ul class="no-list footer-menu">
            <? $APPLICATION->IncludeComponent(
                "optimalgroup:menu",
                "li",
                Array(
                    "MENU_TYPE" => $OptimalGroup['SITE']['CODE'],
                    "IN_SHOP" => false,
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "left",
                    "CACHE_SELECTED_ITEMS" => "N",
                    "USE_EXT" => "N"
                )
            ); ?>
        </ul>
    </div>
    <div class="col col-12 col-md-3">
        <div class="footer-menu--title text-md-left text-center js-FooterSection">Для дома</div>
        <ul class="no-list footer-menu js-switchSite">
            <? if ($OptimalGroup['SITE']['CODE'] == "shop"): ?>
                <li><a href="<?= Url::Site("/ee/", array("site_section" => "home")); ?>">Электроэнергия</a></li>
                <li><a href="<?= Url::Site("/hot-water/", array("site_section" => "home")); ?>">Горячая вода</a></li>
                <li><a href="<?= Url::Site("/heating/", array("site_section" => "home")); ?>">Отопление</a></li>
            <? else: ?>
                <li><a href="/ee/" data-code="home">Электроэнергия</a></li>
                <li><a href="/hot-water/" data-code="home">Горячая вода</a></li>
                <li><a href="/heating/" data-code="home">Отопление</a></li>
            <? endif; ?>
        </ul>
        <div class="footer-align--bottom">
            <div class="footer-menu--title text-md-left text-center js-FooterSection">Для бизнеса</div>
            <ul class="no-list footer-menu js-switchSite">
                <? if ($OptimalGroup['SITE']['CODE'] == "shop"): ?>
                    <li><a href="<?= Url::Site("/services/energosnabzhenie-biznesa/"); ?>" data-code="business">Электроэнергия</a>
                    </li>
                    <li><a href="<?= Url::Site("/services/goryachee-vodosnabzhenie/"); ?>" data-code="business">Горячая
                            вода</a></li>
                    <li><a href="<?= Url::Site("/services/otoplenie/"); ?>" data-code="business">Отопление</a></li>
                    <li><a href="<?= Url::Site("/services/par/"); ?>" data-code="business">Пар</a></li>
                    <li><a href="<?= Url::Site("/services/"); ?>" data-code="business">Услуги</a></li>
                    <?
                    if (in_array($OptimalGroup['DOMAIN'], $ZhkuDomainsFooter)) {
                        ?>
                        <li><a href="<?= Url::Site("/zhku/"); ?>" data-code="business">ЖКУ</a></li>
                        <?
                    }
                    ?>

                <? else: ?>
                    <li><a href="/services/energosnabzhenie-biznesa/" data-code="business">Электроэнергия</a></li>
                    <li><a href="/services/goryachee-vodosnabzhenie/" data-code="business">Горячая вода</a></li>
                    <li><a href="/services/otoplenie/" data-code="business">Отопление</a></li>
                    <li><a href="/services/par/" data-code="business">Пар</a></li>
                    <li><a href="/services/" data-code="business">Услуги</a></li>
                    <?
                    if (in_array($OptimalGroup['DOMAIN'], $ZhkuDomainsFooter)) {
                        ?>
                        <li><a href="<?= Url::Site("/zhku/"); ?>" data-code="business">ЖКУ</a></li>
                        <?
                    }
                    ?>
                <? endif; ?>
            </ul>
        </div>
    </div>
    <div class="col col-12 col-md-3 js-FooterService">
        <? if ($OptimalGroup['SITE']['CODE'] == "home" && $OptimalGroup['DOMAIN'] != "vladimir"): ?>
            <div class="footer-menu--title text-md-left text-center js-FooterSection">Онлайн сервисы</div>
        <? else: ?>
            <div class="footer-menu--title text-md-left text-center js-FooterSection">Сервисы</div>
        <? endif; ?>
        <ul class="no-list footer-menu  js-switchSite">
            <? if ($OptimalGroup['DOMAIN'] == "vladimir"): ?>
                <li><a href="/service/post/">Как передать показания</a></li>
                <li><a href="/service/pay/">Как оплатить</a></li>
                <li><a href="/service/contract/">Заключить договор онлайн</a></li>
            <? elseif ($OptimalGroup['SITE']['CODE'] == "home"): ?>
                <li><a href="/service/post/">Передать показания</a></li>
                <li><a href="/service/pay/">Оплатить</a></li>
                <li><a href="/service/get/">Проверить баланс</a></li>
                <li><a href="/service/email/">Подписка на электронную квитанцию</a></li>
                <li><a href="/service/contract/">Заключить договор онлайн</a></li>
                <li><a href="/service/pc/">Личный кабинет клиента</a></li>
                <li><a href="#">Мобильное приложение</a></li>
            <? elseif ($OptimalGroup['SITE']['CODE'] == "shop"): ?>
                <li><a href="<?= Url::Site("/service/post/", array("site_section" => "home")); ?>">Передать
                        показания</a></li>
                <li><a href="<?= Url::Site("/service/pay/", array("site_section" => "home")); ?>">Оплатить</a></li>
                <li><a href="<?= Url::Site("/service/get/", array("site_section" => "home")); ?>">Проверить баланс</a>
                </li>
                <li><a href="<?= Url::Site("/service/email/", array("site_section" => "home")); ?>">Подписка на
                        электронную квитанцию</a></li>
                <li><a href="<?= Url::Site("/service/contract/", array("site_section" => "home")); ?>">Заключить договор
                        онлайн</a></li>
                <li><a href="<?= Url::Site("/service/pc/", array("site_section" => "home")); ?>">Личный кабинет
                        клиента</a></li>
                <li><a href="#">Мобильное приложение</a></li>
            <? else: ?>
                <li><a href="/business/service/post/">Как передать показания</a></li>
                <li><a href="/business/service/pay/">Как оплатить</a></li>
                <li><a href="/business/service/doc/">Электронный документооборот</a></li>
                <li><a href="/business/service/contract/">Заключить договор онлайн</a></li>
                <? if (
                        ($OptimalGroup['DOMAIN'] != "oren" && $OptimalGroup['SITE']['CODE'] != "business")
                        ||
                        (in_array($OptimalGroup['DOMAIN'], array("ekb", "udm", "kirov")) && $OptimalGroup['SITE']['CODE'] == "business")
                    ): ?>
                    <li><a href="/business/service/pc/">Личный кабинет клиента</a></li>
                <? endif; ?>
            <? endif; ?>
        </ul>
        <? if ($OptimalGroup['SITE']['CODE'] == "home" && $OptimalGroup['DOMAIN'] != "vladimir" || $OptimalGroup['SITE']['CODE'] == "shop"): ?>
            <div class="footer-apps text-md-left text-center mb-md-0 mb-40 footer-align--bottom">
                <div>
                    <a href="https://play.google.com/store/apps/details?id=ru.iesholding.webmobile" target="_blank"><img
                                src="<?= MEDIA_PATH; ?>icons/icon-android.jpg" alt=""></a></div>
                <div class="mt-20">
                    <a href="https://itunes.apple.com/ru/app/%D0%BC%D0%BE%D0%B1%D0%B8%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9-%D0%BB%D0%B8%D1%87%D0%BD%D1%8B%D0%B9-%D0%BA%D0%B0%D0%B1%D0%B8%D0%BD%D0%B5%D1%82/id1223296530"
                       target="_blank"><img src="<?= MEDIA_PATH; ?>icons/icon-apple.jpg" alt=""></a>
                </div>
            </div>
        <? endif; ?>
    </div>

    <div class="col col-12 col-md-3">
        <div class="footer-menu--title js-FooterSection text-md-left text-center">ИНТЕРНЕТ-МАГАЗИН</div>
        <ul class="no-list footer-menu">
            <? $APPLICATION->IncludeComponent(
                "optimalgroup:menu",
                "li",
                Array(
                    "MENU_TYPE" => $OptimalGroup['SITE'],
                    "IN_SHOP" => true,
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "shop",
                    "CACHE_SELECTED_ITEMS" => "N",
                    "USE_EXT" => "N"
                )
            ); ?>
        </ul>
        <? if ($OptimalGroup['BRANCH']['PHONE']): ?>
            <div class="footer-address text-md-left text-center footer-align--bottom">
                <div class="mb-10">
                    <a href="/press/" class="fs-16">Пресс-центр</a>
                </div>
                Телефон филиала<br>
                <a href="tel:<?= str_replace(array("-", "(", ")", " "), "", $OptimalGroup['BRANCH']['PHONE']); ?>"><?= $OptimalGroup['BRANCH']['PHONE']; ?></a>
                <? if ($OptimalGroup['BRANCH']['PHONE_ADD']):
                    foreach ($OptimalGroup['BRANCH']['PHONE_ADD'] as $phone_add):?>
                        <br>
                        <? if (preg_match('/^[\d\s-()]{2,}$/', $phone_add)): ?>
                            <a href="tel:<?= str_replace(array("-", "(", ")", " "), "", $phone_add); ?>"><?= $phone_add; ?></a>
                        <? else: ?>
                            <?= $phone_add; ?>
                        <? endif; ?>
                    <?endforeach;
                endif; ?>
            </div>
        <? endif; ?>
    </div>
</div>
<div class="footer-middle">
    <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/footer-btns.php', Array(), Array("MODE" => "html")); ?>
</div>
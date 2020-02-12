<!--<div class="row footer-top">
    <div class="col col-12 col-md-4 col-lg-3 text-sm-left text-center js-FooterService">
        <div class="footer-menu--title text-md-left text-center js-FooterSection">ЭнергосбыТ плюс</div>
        <ul class="no-list footer-menu">
            <? $APPLICATION->IncludeComponent(
    "bitrix:menu",
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
        "USE_EXT" => "N"
    )
); ?>
        </ul>
    </div>
    <div class="col col-12 col-md-4 col-lg-3">
        <div class="footer-menu--title text-md-left text-center js-FooterSection">Для дома</div>
        <ul class="no-list footer-menu js-switchSite">
            <? if ($OptimalGroup['GROUP'] == "all"): ?>
                <li><a href="/ee/" data-code="home">Электроэнергия</a></li>
            <? endif; ?>
            <li><a href="/hot-water/" data-code="home">Горячая вода</a></li>
            <li><a href="/heating/" data-code="home">Отопление</a></li>
        </ul>
        <div class="footer-align--bottom">
            <div class="footer-menu--title footer-magic-margin text-md-left text-center js-FooterSection">Для бизнеса
            </div>
            <ul class="no-list footer-menu js-switchSite">
                <? if ($OptimalGroup['GROUP'] == "all"): ?>
                    <li><a href="/services/energosnabzhenie-biznesa/" data-code="business">Электроэнергия</a></li>
                <? endif; ?>
                <li><a href="/services/goryachee-vodosnabzhenie/" data-code="business">Горячая вода</a></li>
                <li><a href="/services/otoplenie/" data-code="business">Отопление</a></li>
                <li><a href="/services/par/" data-code="business">Пар</a></li>
                <li><a href="/services/" data-code="business">Услуги</a></li>
                <?
if (in_array($OptimalGroup['DOMAIN'], $ZhkuDomainsFooter)) {
    ?>
                    <li><a href="/zhku/" data-code="business">ЖКУ</a></li>
                    <?
}
?>
            </ul>
        </div>
    </div>
    <div class="col col-12 col-md-4 col-lg-3">
        <? if ($OptimalGroup['GROUP'] == "all"): ?>
            <div class="footer-menu--title text-md-left text-center js-FooterSection">Онлайн сервисы</div>
        <? else: ?>
            <div class="footer-menu--title text-md-left text-center js-FooterSection">Сервисы</div>
        <? endif; ?>
        <ul class="no-list footer-menu">
            <? if ($OptimalGroup['SITE']['CODE'] == "home" && $OptimalGroup['GROUP'] != "hide_shop_menu"): ?>
                <li><a href="/service/post/">Как передать показания</a></li>
                <li><a href="/service/pay/">Как оплатить</a></li>
            <? elseif ($OptimalGroup['GROUP'] == "hide_shop_menu" && $OptimalGroup['SITE']['CODE'] == "home"): ?>
                <li><a href="/clients/kak-oplatit/">Как оплатить</a></li>
                <li><a href="/clients/kak-peredat/">Как передать показания</a></li>
            <? elseif ($OptimalGroup['GROUP'] == "hide_shop_menu" && $OptimalGroup['SITE']['CODE'] == "business"): ?>
                <li><a href="/business/clients/kak-oplatit/">Как оплатить</a></li>
                <li><a href="/business/clients/kak-peredat-pokazaniya/">Как передать показания</a></li>
            <? else: ?>
                <li><a href="/business/service/post/">Как передать показания</a></li>
                <li><a href="/business/service/pay/">Как оплатить</a></li>
            <? endif; ?>
            <? if ($OptimalGroup['SITE']['CODE'] == "business"): ?>
                <li><a href="/business/clients/">Информация для клиентов</a></li>
            <? else: ?>
                <li><a href="/clients/">Информация для клиентов</a></li>
            <? endif; ?>
        </ul>

        <? if ($OptimalGroup['BRANCH']['PHONE']): ?>
            <div class="footer-address text-md-left text-center footer-align--bottom">
                <div class="">
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
                    <? endforeach;
endif; ?>
            </div>
        <? endif; ?>
    </div>

    <div class="col col-12 hidde-md-down col-lg-3">
        <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/footer-btns.php', array("is_column" => true), Array("MODE" => "html")); ?>
    </div>
</div>-->
<div class="row footer-top">
    <div class="col col-12 col-md-4 col-lg-3 text-sm-left text-center js-FooterService">
        <div class="footer-menu--title text-md-left text-center js-FooterSection">ЭнергосбыТ плюс</div>
        <ul class="no-list footer-menu">
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
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
                    "USE_EXT" => "N"
                )
            ); ?>
        </ul>
    </div>
    <div class="col col-12 col-md-4 col-lg-3">
        <div class="footer-menu--title text-md-left text-center js-FooterSection">Для дома</div>
        <ul class="no-list footer-menu js-switchSite">
            <? if ($OptimalGroup['GROUP'] == "all"): ?>
                <li><a href="/ee/" data-code="home">Электроэнергия</a></li>
            <? endif; ?>
            <li><a href="/hot-water/" data-code="home">Горячая вода</a></li>
            <li><a href="/heating/" data-code="home">Отопление</a></li>
        </ul>
        <div class="footer-align--bottom">
            <div class="footer-menu--title footer-magic-margin text-md-left text-center js-FooterSection">Для бизнеса
            </div>
            <ul class="no-list footer-menu js-switchSite">
                <? if ($OptimalGroup['GROUP'] == "all"): ?>
                    <li><a href="/services/energosnabzhenie-biznesa/" data-code="business">Электроэнергия</a></li>
                <? endif; ?>
                <li><a href="/services/goryachee-vodosnabzhenie/" data-code="business">Горячая вода</a></li>
                <li><a href="/services/otoplenie/" data-code="business">Отопление</a></li>
                <li><a href="/services/par/" data-code="business">Пар</a></li>
                <li><a href="/services/" data-code="business">Услуги</a></li>
                <?
                if (in_array($OptimalGroup['DOMAIN'], $ZhkuDomainsFooter)) {
                    ?>
                    <li><a href="/zhku/" data-code="business">ЖКУ</a></li>
                    <?
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="col col-12 col-md-4 col-lg-3">
        <? if ($OptimalGroup['GROUP'] == "all"): ?>
            <div class="footer-menu--title text-md-left text-center js-FooterSection">Онлайн сервисы</div>
        <? elseif (
        ($OptimalGroup['DOMAIN'] == "chuvashia" && $OptimalGroup['SITE']['CODE'] == "home")
        ||
        ($OptimalGroup['DOMAIN'] == "saratov" && $OptimalGroup['SITE']['CODE'] == "home")): ?>
            <div class="footer-menu--title text-md-left text-center js-FooterSection">Онлайн сервисы</div>

        <? else: ?>
            <div class="footer-menu--title text-md-left text-center js-FooterSection">Сервисы</div>
        <? endif; ?>
        <ul class="no-list footer-menu">
            <? if ($OptimalGroup['SITE']['CODE'] == "home" && $OptimalGroup['GROUP'] != "hide_shop_menu"): ?>
                <li><a href="/service/post/">Как передать показания</a></li>
                <li><a href="/service/pay/">Как оплатить</a></li>
            <? elseif ($OptimalGroup['DOMAIN'] == "saratov" && $OptimalGroup['SITE']['CODE'] == "home"): ?>
                <li><a href="/service/post/">Передать показания</a></li>
                <li><a href="/service/pay/">Оплатить</a></li>
                <li><a href="/service/get/">Проверить баланс</a></li>
                <li><a href="/service/email/">Подписка на электронную квитанцию </a></li>
                <li><a href="/service/contract/">Заключить договор онлайн </a></li>
                <li><a href="/service/pc/">Личный кабинет клиента </a></li>
            <? elseif ($OptimalGroup['GROUP'] == "hide_shop_menu" && $OptimalGroup['SITE']['CODE'] == "home" && $OptimalGroup['DOMAIN'] != "chuvashia"): ?>
                <li><a href="/clients/kak-oplatit/">Как оплатить</a></li>
                <li><a href="/clients/kak-peredat/">Как передать показания</a></li>
            <? elseif ($OptimalGroup['DOMAIN'] == "chuvashia" && $OptimalGroup['SITE']['CODE'] == "home"): ?>
                <li><a href="/service/post/">Передать показания</a></li>
                <li><a href="/service/pay/">Оплатить</a></li>
                <li><a href="/service/get/">Проверить баланс</a></li>
                <li><a href="/service/email/">Подписка на электронную квитанцию </a></li>
                <li><a href="/service/contract/">Заключить договор онлайн </a></li>
                <li><a href="/service/pc/">Личный кабинет клиента </a></li>

            <? elseif ($OptimalGroup['GROUP'] == "hide_shop_menu" && $OptimalGroup['SITE']['CODE'] == "business" && $OptimalGroup['DOMAIN'] != "chuvashia"): ?>
                <li><a href="/business/clients/kak-oplatit/">Как оплатить</a></li>
                <li><a href="/business/clients/kak-peredat-pokazaniya/">Как передать показания</a></li>
            <? elseif ($OptimalGroup['GROUP'] == "hide_shop_menu" && $OptimalGroup['SITE']['CODE'] == "business" && $OptimalGroup['DOMAIN'] == "chuvashia"): ?>
                <li><a href="/business/clients/kak-peredat-pokazaniya/">Как передать показания</a></li>
                <li><a href="/business/clients/kak-oplatit/">Как оплатить</a></li>
                <li><a href="/business/service/doc/">Электронный документооборот</a></li>
                <li><a href="/business/service/contract/">Заключить договор онлайн</a></li>
            <? else: ?>
                <li><a href="/business/service/post/">Как передать показания</a></li>
                <li><a href="/business/service/pay/">Как оплатить</a></li>
            <? endif; ?>
            <? if ($OptimalGroup['SITE']['CODE'] == "business" && $OptimalGroup['DOMAIN'] == "perm") { ?>
                <li><a href="/business/service/contract/">Заключить договор онлайн</a></li>
                <li><a href="/business/service/pc/">Личный кабинет клиента</a></li>
                <li><a href="/business/service/doc/">Электронный документооборот</a></li>
            <? } ?>
            <? if ($OptimalGroup['SITE']['CODE'] == "home" && $OptimalGroup['DOMAIN'] == "perm") { ?>
                <li><a href="/business/service/contract/">Заключить договор онлайн</a></li>
            <? } ?>
            <? if ($OptimalGroup['SITE']['CODE'] == "business" && $OptimalGroup['DOMAIN'] != "chuvashia"): ?>
                <li><a href="/business/clients/">Информация для клиентов</a></li>
            <? elseif ($OptimalGroup['DOMAIN'] != "chuvashia" && $OptimalGroup['DOMAIN'] != "saratov"): ?>
                <li><a href="/clients/">Информация для клиентов</a></li>
            <? endif; ?>
        </ul>

        <? if ($OptimalGroup['BRANCH']['PHONE']): ?>
            <div class="footer-address text-md-left text-center footer-align--bottom">
                <div class="">
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
                    <? endforeach;
                endif; ?>
            </div>
        <? endif; ?>
    </div>

    <div class="col col-12 hidde-md-down col-lg-3">
        <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/footer-btns.php', array("is_column" => true), Array("MODE" => "html")); ?>
    </div>
</div>

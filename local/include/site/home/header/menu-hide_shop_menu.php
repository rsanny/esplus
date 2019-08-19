<li>
    <a href="#" class="main-menu--link">Горячая вода</a>
    <div class="menu-list">
        <ul class="no-list">
            <li><a href="/hot-water/">Водоснабжение</a></li>
            <li><a href="/clients/kak-peredat/">Как передать показания</a></li>
            <li><a href="/clients/kak-oplatit/">Как оплатить</a></li>
            <li><a href="<?=$tariffLink;?>">Тарифы и нормативы</a></li>
            <li><a href="/clients/">Информация для клиентов</a></li>
            <? if ($OptimalGroup['DOMAIN'] == "penza"):?><li><a href="/service/contract/hot_water_supply/new/">Заключить договор онлайн</a></li><? endif;?>
            <li><a href="/service/contract/">Заключить договор онлайн</a></li>
        </ul>
    </div>
</li>
<li>
    <a href="#" class="main-menu--link">Отопление</a>
    <div class="menu-list">
        <ul class="no-list">
            <li><a href="/heating/">Теплоснабжение</a></li>
            <li><a href="/clients/kak-peredat/">Как передать показания</a></li>
            <li><a href="/clients/kak-oplatit/">Как оплатить</a></li>
            <li><a href="<?=$tariffLink;?>">Тарифы и нормативы</a></li>
            <li><a href="/clients/">Информация для клиентов</a></li>
            <? if ($OptimalGroup['DOMAIN'] == "penza"):?><li><a href="/service/contract/heating_supply/new/">Заключить договор онлайн</a></li><? endif;?>
            <? if ($OptimalGroup['DOMAIN'] != "ulianovsk" && $OptimalGroup['DOMAIN'] != "chuvashia"):?>
            <li><a href="/service/contract/">Заключить договор онлайн</a></li>
            <? endif;?>
        </ul>
    </div>
</li>
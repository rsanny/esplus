<div class="row footer-top">
    <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"footer-hide--all", 
	array(
		"IN_SHOP" => false,
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "footer-hide--all"
	),
	false
); ?>
    <div class="col col-12 col-md-3 hidden-sm-down">
        <? if ($OptimalGroup['BRANCH']['PHONE']): ?>
            <div class="footer-address">
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

    <div class="col col-12 hidden-md-down col-lg-3 hidden-sm-down">
        <a href="/feedback/" class="btn btn-label block"><span><i class="fa fa-envelope"></i></span>Обратная связь</a>
        <a href="/about/quality-of-services/" class="btn btn-label block"><span><i
                        class="icon-rating btn-icon"></i></span>Оценить качество услуг</a>
    </div>
</div>
<div class="footer-middle">
</div>
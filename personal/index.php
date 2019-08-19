<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
global $USER;
?>
<? if (!$USER->IsAuthorized()):?>
<? $APPLICATION->IncludeFile(INCLUDE_PATH . '/page/auth.php', Array(), Array("MODE"=> "html"));?>
<? else:?>
<div class="row">
    <div class="col col-12 col-md-4 col-lg-3">
        <div class="pc-menu mb-20">
            <div class="catalog-section--title">Интернет-магазин</div>
            <a href="/personal/edit/" class="btn btn-label btn-transparent-border block"><span><i class="fa fa-address-book-o"></i></span>Персональные данные</a>
            <a href="/personal/" class="btn btn-label btn-transparent-border block is-selected"><span><i class="fa fa-list-alt"></i></span>Мои заказы</a>
            <a href="/?logout=yes" class="btn btn-label btn-transparent-border block"><span><i class="fa fa-sign-out"></i></span>Выход</a>
        </div>
        <div class="pc-menu mb-20">
            <a href="/feedback/" class="btn btn-label btn-transparent-border block"><span><i class="fa fa-envelope"></i></span>Обратная связь</a>
        </div>
        <?
        /*
        <a href="#" class="btn btn-label btn-transparent-border block"><span><i class="fa fa-bar-chart-o"></i></span>Сравнение</a>
            <a href="#" class="btn btn-label btn-transparent-border block"><span><i class="fa fa-heart-o"></i></span>Избранное</a>
            <a href="#" class="btn btn-label btn-transparent-border block"><span><i class="fa fa-cog"></i></span>Управление подпиской</a>
        <div class="pc-menu mb-20">
            <div class="catalog-section--title">Онлайн-сервисы</div>
            <a href="#" class="btn btn-label btn-transparent-border block"><span><i class="icon-auth btn-icon"></i></span>Перейти в ЛК клиента</a>
            <a href="/service/post/" class="btn btn-label btn-transparent-border block"><span><i class="icon-post btn-icon"></i></span>Передать показания</a>
            <a href="/service/pay/" class="btn btn-label btn-transparent-border block"><span><i class="icon-pay btn-icon"></i></span>Оплатить онлайн</a>
            <a href="/service/contract/" class="btn btn-label btn-transparent-border block"><span><i class="icon-offer btn-icon"></i></span>Заключить договор</a>
        </div>        
        <div class="pc-menu mb-20">
            <a href="/feedback/" class="btn btn-label btn-transparent-border block"><span><i class="fa fa-envelope"></i></span>Обратная связь</a>
        </div>
        */?>
    </div>
    <div class="col col-12 col-md-8 col-lg-9">
            <div class="catalog-section--title">&nbsp;</div>
            <?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order", 
	".default", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ALLOW_INNER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CUSTOM_SELECT_PROPS" => array(
		),
		"DETAIL_HIDE_USER_INFO" => array(
			0 => "0",
		),
		"HISTORIC_STATUSES" => array(
			0 => "F",
		),
		"NAV_TEMPLATE" => "",
		"ONLY_INNER_FULL" => "N",
		"ORDERS_PER_PAGE" => "20",
		"ORDER_DEFAULT_SORT" => "ID",
		"PATH_TO_BASKET" => "/cart/",
		"PATH_TO_CATALOG" => "/catalog/",
		"PATH_TO_PAYMENT" => "/personal/payment.php",
		"PROP_1" => array(
		),
		"RESTRICT_CHANGE_PAYSYSTEM" => array(
			0 => "CH",
			1 => "F",
		),
		"SAVE_IN_SESSION" => "Y",
		"SEF_FOLDER" => "/personal/",
		"SEF_MODE" => "Y",
		"SET_TITLE" => "Y",
		"STATUS_COLOR_CA" => "gray",
		"STATUS_COLOR_F" => "gray",
		"STATUS_COLOR_N" => "green",
		"STATUS_COLOR_OK" => "gray",
		"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
		"COMPONENT_TEMPLATE" => ".default",
		"REFRESH_PRICES" => "N",
		"STATUS_COLOR_CH" => "gray",
		"SEF_URL_TEMPLATES" => array(
			"list" => "index.php",
			"detail" => "detail/#ID#/",
			"cancel" => "cancel/#ID#/",
		)
	),
	false
);?>
    </div>
</div>
<? endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
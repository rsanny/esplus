<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональные данные");
global $USER;
define("NEED_AUTH", true);
//Bitrix\Main\Loader::includeModule('sale');
//$db_sales = CSaleOrderUserProps::GetList(
//    array("DATE_UPDATE" => "DESC"),
//    array("USER_ID" => $USER->GetID())
//);
//if ($ar_sales = $db_sales->Fetch());
    
?>
<div class="row">
    <div class="col col-12 col-md-4 col-lg-3">
        <div class="hidden-md-up mb-20"><a href="#sidebar-menu" class="btn btn-transparent-border block js-SlideToggle">Интернет-магазин</a></div>
        <div class="hide-sm-down" id="sidebar-menu">
            <div class="pc-menu mb-20">
                <div class="catalog-section--title hidden-sm-down">Интернет-магазин</div>
                <a href="/personal/edit/" class="btn btn-label btn-transparent-border block is-selected"><span><i class="fa fa-address-book-o"></i></span>Персональные данные</a>
                <a href="/personal/" class="btn btn-label btn-transparent-border block"><span><i class="fa fa-list-alt"></i></span>Мои заказы</a>
                <a href="/?logout=yes" class="btn btn-label btn-transparent-border block"><span><i class="fa fa-sign-out"></i></span>Выход</a>
            </div>
                
            <div class="pc-menu mb-20">
                <a href="/feedback/" class="btn btn-label btn-transparent-border block"><span><i class="fa fa-envelope"></i></span>Обратная связь</a>
            </div>
        </div>
    </div>
    <div class="col col-12 col-md-8 col-lg-9">
        <div class="catalog-section--title">&nbsp;</div>
        <? /*if ($ar_sales['ID']):?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:sale.personal.profile.detail",
            "personal",
            Array(
                "COMPATIBLE_LOCATION_MODE" => "N",
                "ID" => $ar_sales['ID'],
                "PATH_TO_DETAIL" => "/personal/edit/",
                "PATH_TO_LIST" => "/personal/edit/",
                "SET_TITLE" => "N",
                "USE_AJAX_LOCATIONS" => "N"
            )
        );?>
        <? else:*/?>
        <?$APPLICATION->IncludeComponent("bitrix:main.profile", "", Array(
            "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
            ),
            false
        );?>
        
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
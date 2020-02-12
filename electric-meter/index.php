<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Электросчетчик");
use DorrBitt\dbCity\DBCITY;
OptimalGroup\SiteSection::Check("shop");
//$_REQUEST['show_config'] = "Y";
$dostupListDomen = [
    "kirov",
    "udm",
    "ekb",
    "vladimir"
];

$dostupListDomenText = [
    "ekb"
];
$act_region_text = (DBCITY::inarray($dostupListDomenText,$OptimalGroup['DOMAIN']) == 1) ? 1 : 0;
$act_region = (DBCITY::inarray($dostupListDomen,$OptimalGroup['DOMAIN']) == 1) ? 1 : 0;

//if ($_REQUEST['show_config'] == "Y"):
    if ($act_region == 1 || $_REQUEST['show_config'] == "Y"):
?>
<section class="counters-offer index-section" id="calc">
    <div class="container">
        <div class="section-title text-center"><small>Замена электросчетчика</small><span>по выгодной цене</span></div>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "configurator-elect",
            Array(
                "PRICE_ID" => $_SESSION['BXExtra']['PRICE']['ID'],
                "ACTIVE_DATE_FORMAT" => "d F Y г.",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array("", ""),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "44",
                //"IBLOCK_ID" => "41",
                "IBLOCK_TYPE" => "1c_catalog",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "100",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array("TARIFF", ""),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N"
            )
        );?>
    </div>
</section>
<? endif;?>
<section class="electric-meter--order bg-grey index-section border-top-bottom">
    <div class="container">
        <div class="text-center section-title"><span>Сделать заказ просто!</span></div>
        <div class="row">
            <div class="col col-12 col-md-6 col-lg-3 mt-30 mt-lg-0">
                <div class="easy-order">
                    <i><img src="<?=MEDIA_PATH;?>icons/installation-icon-1.png" alt=""><b>1</b></i>
                    <span>Заказ</span>
                    <div>Оставьте заявку: выберите нужный счетчик или просто оставьте контакты, и мы поможем Вам с выбором</div>
                </div>
            </div>
            <div class="col col-12 col-md-6 col-lg-3 mt-30 mt-lg-0">
                <div class="easy-order">
                    <i><img src="<?=MEDIA_PATH;?>icons/installation-icon-2.png" alt=""><b>2</b></i>
                    <span>Подтверждение заказа</span>
                    <div>Наши менеджеры перезвонят Вам и согласуют все детали заказа, а также удобное время визита мастера</div>
                </div>
            </div>
            <div class="col col-12 col-md-6 col-lg-3 mt-30 mt-lg-0">
                <div class="easy-order">
                    <i><img src="<?=MEDIA_PATH;?>icons/installation-icon-3.png" alt=""><b>3</b></i>
                    <span>Оплата</span>
                    <div>Выберите удобный для Вас способ оплаты: в офисе компании, по счету в офисе банка или через Ваш интернет-банк</div>
                </div>
            </div>
            <div class="col col-12 col-md-6 col-lg-3 mt-30 mt-lg-0">
                <div class="easy-order">
                    <i class="no-border"><img src="<?=MEDIA_PATH;?>icons/installation-icon-4.png" alt=""><b>4</b></i>
                    <span>Выезд мастера</span>
                    <div>Наш специалист демонтирует старый счетчик, установит и опломбирует новый, и сам передаст все документы</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="index-section">
    <div class="container">
        <div class="section-title text-center"><small>Не знаете как выбрать электросчетчик?</small><span>Расскажем подробно</span></div>
        <div class="row">
            <div class="col col-12 col-md-7 col-lg-8">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "faq",
                    Array(
                        "COLS"=>4,
                        "ACTIVE_DATE_FORMAT" => "d F Y г.",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "N",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "N",
                        "DISPLAY_PREVIEW_TEXT" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array("", ""),
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "15",
                        "IBLOCK_TYPE" => "info",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "10",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Новости",
                        "PARENT_SECTION" => "313",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array("BRANCH", ""),
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER1" => "DESC",
                        "SORT_ORDER2" => "ASC",
                        "STRICT_SECTION_CHECK" => "N"
                    )
                );?>

            </div>
            <div class="col col-12 col-md-5 col-lg-4">
                <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/page/more-question.php', Array(), Array("MODE"=> "html"));?>

            </div>
        </div>
    </div>
</section>
<?php
//if ($_REQUEST['show_config'] == "Y"):
    if ($act_region == 1 || $_REQUEST['show_config'] == "Y"):
    ?>
<section class="electric-meter--calc bg-grey index-section border-top-bottom" id="configurator">
    <div class="container">
        <div class="section-title text-center"><span>Калькулятор расчета выгоды при многотарифном учете</span></div>
        <?
        \OptimalGroup\Core::AddJs(array(
            "optimalgroup/numbers",
            "lib/ion.range/ion.rangeSlider",
            "tariff-config",
        ));
        \Bitrix\Main\Page\Asset::getInstance()->addCss(MEDIA_PATH .'js/lib/ion.range/ion.rangeSlider.css');
        global $arrTariffFilter;
        $arrTariffFilter = array('PROPERTY_BRANCH' => $_SESSION['BXExtra']['REGION']['IBLOCK']['ID'], 'PROPERTY_PLATE_TYPE'=>415);
        ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "configurator-tariffs",
            Array(
                "CURRENT_REGION"=> $_SESSION['BXExtra']['REGION']['IBLOCK']['ID'],
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array("",""),
                "FILTER_NAME" => "arrTariffFilter",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "11",
                "IBLOCK_TYPE" => "tarif",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "20",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array("PLATE_TYPE","TARIFF_ONE","TARIFF_TWO","NIGHT_PEAK","PEAK","HALF_PEAK",""),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N"
            )
        );?>
        <div class="mt-30">Обращаем Ваше внимание на то, что расчет, сформированный при помощи Калькулятора, носит исключительно информационный характер и ни при 
        каких условиях не является публичной офертой. Для получения подробных расчетов, пожалуйста, обращайтесь в ближайший офис обслуживания ЭнергосбыТ Плюс.
        <?php if($act_region_text == 1):?>
            Расчет производится без учета исключительных (выходных и праздничных) дней.
        <?php endif;?>
        </div>
    </div>
</section>
<?php endif;?>
<section class="index-section">
    <div class="container">
        <div class="section-title text-center"><span>Почему выбирают нас?</span></div>
        <div class="row text-center mb-50">
            <div class="col col-12 col-md-6 col-lg-3 mt-30 mt-lg-0">
                <div class="why-we">
                    <i><img src="<?=MEDIA_PATH;?>icons/icon-why-we-1.png" alt=""></i>
                    <div>Экономия времени</div>
                    <span>Услуга оказывается в согласованное с Вами время. Вам не придется идти в энергоснабжающую компанию, чтобы передать документы для ввода
                    в эксплуатацию нового счетчика – за Вас это сделает наш мастер, после оказания услуги</span>
                </div>
            </div>
            <div class="col col-12 col-md-6 col-lg-3 mt-30 mt-lg-0">
                <div class="why-we">
                    <i><img src="<?=MEDIA_PATH;?>icons/icon-why-we-2.png" alt=""></i>
                    <div>Безопасность</div>
                    <span>Работы выполняются квалифицированными специалистами компании в соответствии с нормами законодательства при соблюдении техники безопасности
                    и правил установки приборов учета</span>
                </div>
            </div>
            <div class="col col-12 col-md-6 col-lg-3 mt-30 mt-lg-0">
                <div class="why-we">
                    <i><img src="<?=MEDIA_PATH;?>icons/icon-why-we-3.png" alt=""></i>
                    <div>Экономия денег</div>
                    <span>Возможность перейти на многотарифный учет.<br>
Приобретая пакетное предложение (счетчик с услугой по установке) Вы экономите еще больше</span>
                </div>
            </div>
            <div class="col col-12 col-md-6 col-lg-3 mt-30 mt-lg-0">
                <div class="why-we">
                    <i><img src="<?=MEDIA_PATH;?>icons/icon-why-we-4.png" alt=""></i>
                    <div>Опломбировка сразу</div>
                    <span>После установки новый прибор учета в обязательном порядке опломбируется и вводится в эксплуатацию</span>
                </div>
            </div>
        </div>
        <? \Optimalgroup\Template::OfferBanners(
            array(
                "arSettings" => array(
                    "NEWS_COUNT" => 2,
                    "BY_PAGE"=> "Y"
                )
            )
        );?>
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
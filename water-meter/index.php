<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Установка счетчиков воды");
$APPLICATION->IncludeFile(INCLUDE_PATH . 'catalog-scripts.php', Array(), Array("SHOW_BORDER"=> false));
OptimalGroup\Core::AddJs(array("optimalgroup/numbers"));
use DorrBitt\dbCity\DBCITY;

$dostupListDomen = [
    "kirov",
    "udm",
    "ekb"
];
$act_region = (DBCITY::inarray($dostupListDomen,$OptimalGroup['DOMAIN']) == 1) ? 1 : 0;
//if ($_REQUEST['show_config'] == "Y"):
    if ($act_region == 1 || $_REQUEST['show_config'] == "Y"):
?>
<section class="index-section">
    <div class="container">
        <div class="section-title text-center"><span>Конфигуратор пакетного предложения</span></div>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "configurator-water",
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
                "IBLOCK_ID" => "43",
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
                "PROPERTY_CODE" => array("BRAND", ""),
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
                    <?php if($OptimalGroup['DOMAIN'] == "vladimir"):?>
                        <div>Наш специалист при необходимости демонтирует старый прибор учета и установит новый</div>
                    <?php elseif($OptimalGroup['DOMAIN'] == "udm"):?>
                        <div>Наш специалист при необходимости демонтирует старый прибор учета, установит новый и выполнит его опломбировку</div>
                    <?php elseif($OptimalGroup['DOMAIN'] == "kirov"):?>
                        <div>Наш специалист при необходимости демонтирует старый прибор учета, установит новый и выполнит опломбировку*</div>
                    <?php elseif($OptimalGroup['DOMAIN'] == "oren"):?>
                        <div>Наш специалист демонтирует старый прибор учета, установит новый и выполнит опломбировку*</div>
                    <?php else:?>
                        <div>Наш специалист при необходимости демонтирует старый прибор учета, установит новый и выполнит опломбировку счётчика горячей воды</div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="index-section">
    <div class="container">
        <div class="section-title text-center"><span>Остались вопросы?</span></div>
        <div class="row mb-50">
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
                        "NEWS_COUNT" => "4",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Новости",
                        "PARENT_SECTION" => "314",
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
<?php
if($OptimalGroup['DOMAIN'] == "vladimir"){
    $class_col = "col-lg-3-33";
    $act_block = 0;
}
else{
    $class_col = "col-lg-3";
    $act_block = 1;
}
?>
<?php
if($OptimalGroup['DOMAIN'] == "vladimir"){
    $class_col = "col-lg-3-33";
    $act_block = 0;
}
else{
    $class_col = "col-lg-3";
    $act_block = 1;
}

?>
<section class="index-section">
    <div class="container">
        <div class="section-title text-center"><span>Почему выбирают нас?</span></div>
        <div class="row text-center mb-50">
            <div class="col col-12 col-md-6 <?=$class_col?> mt-30 mt-lg-0" >
                <div class="why-we">
                    <i><img src="<?=MEDIA_PATH;?>icons/icon-why-we-1.png" alt=""></i>
                    <div>Экономия времени</div>
                    <?php if($OptimalGroup['DOMAIN'] == "vladimir"):?>
                        <span>
                        Услуга оказывается в согласованное с Вами время
                        </span>
                    <?php elseif($OptimalGroup['DOMAIN'] == "udm"):?>
                        <span>
                        Услуга оказывается в согласованное с Вами время. Вам не придется идти в ресурсоснабжающую компанию, чтобы передать документы для ввода
                        в эксплуатацию нового счетчика – за Вас это сделает наш мастер, после оказания услуги
                        </span>
                    <?php elseif($OptimalGroup['DOMAIN'] == "kirov"):?>
                        <span>
                        Услуга оказывается в согласованное с Вами время. Вам не придется идти в ресурсоснабжающую компанию, чтобы передать документы для ввода
                        в эксплуатацию нового счетчика горячей воды* – за Вас это сделает наш мастер, после оказания услуги
                        </span>
                    <?php elseif($OptimalGroup['DOMAIN'] == "oren"):?>
                        <span>
                        Услуга оказывается в согласованное с Вами время. Вам не придется идти в ресурсоснабжающую компанию, чтобы передать документы для ввода в
                        эксплуатацию нового счетчика горячей воды* – за Вас это сделает наш мастер, после оказания услуги
                        </span>
                    <?php else:?>
                        <span>Услуга оказывается в согласованное с Вами время. Вам не придется идти в ресурсоснабжающую компанию, чтобы передать документы для ввода
                              в эксплуатацию нового счетчика горячей воды – за Вас это сделает наш мастер, после оказания услуги</span>
                    <?php endif;?>

                </div>
            </div>
            <div class="col col-12 col-md-6 <?=$class_col?> mt-30 mt-lg-0" >
                <div class="why-we">
                    <i><img src="<?=MEDIA_PATH;?>icons/icon-why-we-2.png" alt=""></i>
                    <div>Безопасность</div>
                    <span>Работы выполняются квалифицированными специалистами в соответствии с нормами законодательства при соблюдении техники безопасности и
                    правил установки приборов учета</span>
                </div>
            </div>
            <div class="col col-12 col-md-6 <?=$class_col?> mt-30 mt-lg-0" >
                <div class="why-we">
                    <i><img src="<?=MEDIA_PATH;?>icons/icon-why-we-3.png" alt=""></i>
                    <div>Экономия денег</div>
                    <span>Приобретая пакетное предложение (счетчик с услугой по установке/замене) Вы экономите еще больше</span>
                </div>
            </div>
            <?php if($act_block == 1):?>
            <div class="col col-12 col-md-6 col-lg-3 mt-30 mt-lg-0">
                <div class="why-we">
                    <i><img src="<?=MEDIA_PATH;?>icons/icon-why-we-4.png" alt=""></i>
                    <div>Опломбировка сразу</div>
                    <?php if($OptimalGroup['DOMAIN'] == "udm"):?>
                    <span>После установки новый прибор учета в обязательном порядке опломбируется и вводится в эксплуатацию</span>
                    <?php elseif($OptimalGroup['DOMAIN'] == "kirov"):?>
                        <span>После установки новый прибор учета в обязательном порядке опломбируется* и вводится в эксплуатацию
                        * - только счетчики горячей воды в г. Киров и Кирово-Чепецк</span>
                    <?php elseif($OptimalGroup['DOMAIN'] == "oren"):?>
                        <span>После установки новый прибор учета в обязательном порядке опломбируется* и вводится в эксплуатацию
                              * - только счетчики горячей воды в г. Оренбург и Медногорск"</span>
                    <?php else:?>
                    <span>После установки новый прибор учета в обязательном порядке опломбируется и вводится в эксплуатацию (только для счётчиков горячей воды)</span>
                    <?php endif;?>
                </div>
            </div>
            <?php endif;?>
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
<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arTemplate = $arResult['arResult'];
?>
<? if ($arTemplate['PROPERTIES']['BANNER_IMG']['VALUE']):?>
<section class="page-banner">
    <div class="page-banner--item">
        <div class="page-banner--item-vmiddle">
            <div class="container">
                <div class="row row-vertical">
                    <div class="col col-12 col-lg-7 col-xl-8">
                        <div class="page-banner--text">
                            <div class="page-banner--title"><?=$arTemplate['PROPERTIES']['BANNER_TITLE']['~VALUE'];?></div>
                            <div class="page-banner--text text-left"><?=$arTemplate['PROPERTIES']['BANNER_TEXT']['~VALUE']['TEXT'];?></div>
                            <? if ($arTemplate['IBLOCK_SECTION_ID'] != SERVICE_EXCLUDE_SECTION):?>
                            <div class="mt-20 text-left">
                                <a href="#order-count" class="btn btn-orange js-ScrollTo w-170"><span class="fa-angle-btn">Заказать</span></a>
                            </div>
                            <? endif;?>
                        </div>
                    </div>
                </div>                                                                    
            </div>
        </div>
        <div class="page-banner--img js-parallax" data-swiper-parallax="100%" style="background-image: url(<?=CFile::GetPath($arTemplate['PROPERTIES']['BANNER_IMG']['VALUE']);?>)"></div>
    <!--/index slide-->
</div>
</section>
<? endif;?>
<? if ($arTemplate['IBLOCK_SECTION_ID'] != SERVICE_EXCLUDE_SECTION):?>
<section class="index-section">
    <div class="container">
        <div class="row">
            <? if ($arTemplate['PROPERTIES']['USE']['~VALUE']['TEXT']):?>
            <div class="col col-12 col-md-3 col-lg-2">
                <div class="one-radio one-radio--verical js-Tabs" data-container=".service-text">
                    <a href="#service-text-1" class="is-selected">Описание</a>
                    <a href="#service-text-2" class="">Применение</a>
                    <span class="is-selected-0"></span>
                </div>
            </div>
            <div class="col col-12 col-md-8">
            <? else:?>
            <div class="col col-12">
            <? endif;?>
                <div class="service-preview_text fs-16">
                    <div class="service-text" id="service-text-1">
                        <div id="service-text-1--preview"><?=$arTemplate['PREVIEW_TEXT'];?></div>
                        <div class="none" id="service-text-1--more"><?=$arTemplate['DETAIL_TEXT'];?></div>
                        <div class="service-text--more mt-30">
                            <a href="#service-text-1--more" class="js-ServiceText">
                                <span>Подробное описание</span>
                                <span class="none">Скрыть описание</span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="service-text none" id="service-text-2"><?=$arTemplate['PROPERTIES']['USE']['~VALUE']['TEXT'];?></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="index-section bg-grey border-top-bottom">
    <div class="container">
        <div class="section-title text-center"><span>Наши преимущества</span></div>
        <div class="row mb-30">
        <? foreach ($arTemplate['PROPERTIES']['BENEFITS']['VALUE'] as $k=>$benefits):?>
            <div class="col col-12 col-md-6 col-lg-3 benefit-item mb-10 mb-lg-0">
                <div class="color-orange mb-30 benefit-item--num">0<?=$k+1;?></div>
                <div class="fs-18 benefit-item--name"><b><?=$benefits;?></b></div>
            </div>
        <? endforeach;?>
        </div>
    </div>
</section>
<? 
if ($arTemplate['PROPERTIES']['LED_CONFIG']['VALUE']):
    \OptimalGroup\Core::addJs(array('optimalgroup/numbers'));
?>
<section class="index-section bg-grey border-top-bottom">
    <div class="container">
        <div class="section-title text-center"><span>Конфигуратор энергоэффективности</span></div>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"configurator-energy-efficiency",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("", ""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "20",
		"IBLOCK_TYPE" => "info",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "500",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => $arTemplate['PROPERTIES']['LED_CONFIG']['VALUE'],
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("LAMP_POWER","LED_POWER","LAMP_LUMINOUS","LED_LUMINOUS",""),
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
</section>
<? endif;?>
<section class="index-section">
    <div class="container">
    <? if ($arTemplate['PROPERTIES']['FAQ']['VALUE']):?>
        <div class="section-title text-center"><span>Популярные вопросы</span></div>
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
                        "NEWS_COUNT" => "10",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Новости",
                        "PARENT_SECTION" => $arTemplate['PROPERTIES']['FAQ']['VALUE'],
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
        <? endif;?>

        
        <div class="section-title text-center"><span>Как начать сотрудничество</span></div>
        <div class="row">
            <div class="col col-12 col-md-6 col-lg-3 mt-30 mt-lg-0">
                <div class="easy-order">
                    <i><img src="<?=MEDIA_PATH;?>icons/installation-icon-1--orange.png" alt=""><b>1</b></i>
                    <span>Заказ</span>
                    <div><a href="#order-count" class="color-orange js-ScrollTo">Оставьте заявку</a></div>
                </div>
            </div>
            <div class="col col-12 col-md-6 col-lg-3 mt-30 mt-lg-0">
                <div class="easy-order">
                    <i><img src="<?=MEDIA_PATH;?>icons/installation-icon-2--orange.png" alt=""><b>2</b></i>
                    <span>Подтверждение заказа</span>
                    <div>Наш менеджер согласует с вами все детали</div>
                </div>
            </div>
            <div class="col col-12 col-md-6 col-lg-3 mt-30 mt-lg-0">
                <div class="easy-order">
                    <i><img src="<?=MEDIA_PATH;?>icons/installation-icon-5--orange.png" alt=""><b>3</b></i>
                    <span>Примите решение о сотрудничестве</span>
                </div>
            </div>
            <div class="col col-12 col-md-6 col-lg-3 mt-30 mt-lg-0">
                <div class="easy-order">
                    <i class="no-border"><img src="<?=MEDIA_PATH;?>icons/installation-icon-6--orange.png" alt=""><b>4</b></i>
                    <span>Заключите договор</span>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?
$EmailSendService = $_SESSION['BXExtra']['REGION']['IBLOCK']['E_SERVICE_LEGAL'];
if ($_SESSION['BXExtra']['REGION']['IBLOCK']['E_SERVICE'])
    $EmailSendService = $_SESSION['BXExtra']['REGION']['IBLOCK']['E_SERVICE'];
$Analytics = array(
    "ga" => array(
        "category" => "busin-uslugi",
        "action" => "biz-service"
    ),
    "ym" => "biz-service"
);
?>
<section class="index-section bg-grey border-top-bottom" id="order-count">
    <div class="container">
        <div class="section-title text-center"><span>Рассчитать стоимость услуги<small>Заполните поля ниже, и наш специалист оперативно ответит вам</small></span></div>
        <? $APPLICATION->IncludeComponent("bitrix:form.result.new", "service", Array(
            "ANALYTICS" => $Analytics,
            "EMAIL_SEND" => $EmailSendService,
            "URL" => $APPLICATION->GetCurPage(),
            "TITLE" => $arTemplate['NAME'],
            "WEB_FORM_ID" => "16",	// ID веб-формы
            "IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
            "USE_EXTENDED_ERRORS" => "Y",	// Использовать расширенный вывод сообщений об ошибках
            "SEF_MODE" => "N",	// Включить поддержку ЧПУ
            "VARIABLE_ALIASES" => array(
                "WEB_FORM_ID" => "WEB_FORM_ID",
                "RESULT_ID" => "RESULT_ID",
            ),
            "CACHE_TYPE" => "N",	// Тип кеширования
            "CACHE_TIME" => "3600",	// Время кеширования (сек.)
            "LIST_URL" => "",	// Страница со списком результатов
            "EDIT_URL" => "",	// Страница редактирования результата
            "SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
            "CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
            "CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
            "AJAX_MODE" => "Y",
            "AJAX_OPTION_JUMP" => "N",
        ),
        false
        );?>
    </div>        
</section>
<? else:?>
<div class="content bg-grey">
    <div class="container">
        <div class="form-content mt-40 mb-20">
            <?=$arTemplate['DETAIL_TEXT'];?>
        </div>
    </div>
</section>
<? endif;?>
<section class="index-section">
    <div class="container">
       <? 
       global $BusinessFilter;
       $BusinessFilter['!ID'] = $arTemplate['ID'];
       ?>
        <div class="section-title text-center"><span>Смотрите также</span></div>
        <? $APPLICATION->IncludeComponent("bitrix:news.list", "service", Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
                "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                "AJAX_MODE" => "N",	// Включить режим AJAX
                "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                "AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
                "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
                "CACHE_GROUPS" => "Y",	// Учитывать права доступа
                "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                "CACHE_TYPE" => "A",	// Тип кеширования
                "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
                "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
                "DISPLAY_DATE" => "N",	// Выводить дату элемента
                "DISPLAY_NAME" => "Y",	// Выводить название элемента
                "DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
                "DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
                "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                "FIELD_CODE" => array(	// Поля
                    0 => "",
                    1 => "",
                ),
                "FILTER_NAME" => "BusinessFilter",	// Фильтр
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
                "IBLOCK_ID" => "26",	// Код информационного блока
                "IBLOCK_TYPE" => "info",	// Тип информационного блока (используется только для проверки)
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
                "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
                "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
                "NEWS_COUNT" => "4",	// Количество новостей на странице
                "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
                "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
                "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
                "PAGER_TITLE" => "Новости",	// Название категорий
                "PARENT_SECTION" => "",	// ID раздела
                "PARENT_SECTION_CODE" => "",	// Код раздела
                "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
                "PROPERTY_CODE" => array(	// Свойства
                    0 => "TYPE",
                    1 => "",
                    2 => "",
                ),
                "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
                "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
                "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
                "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
                "SET_STATUS_404" => "N",	// Устанавливать статус 404
                "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                "SHOW_404" => "N",	// Показ специальной страницы
                "SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
                "SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
                "SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
                "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
                "STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
                "COMPONENT_TEMPLATE" => "news"
            ),
            false
        );?>
    </div>
</section>    
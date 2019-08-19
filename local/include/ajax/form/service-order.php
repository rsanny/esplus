<?
define("STOP_STATISTICS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
CJSCore::Init(array('ajax', 'window')) ;
?>
<div class="popup-form overflow">
    <? $APPLICATION->IncludeComponent("bitrix:form.result.new", "show_more", Array(        
        "ANALYTICS" => array(
            "ga" => array(
                "category" => "busin-uslugi",
                "action" => "biz-serv"
            ),
            "ym" => "biz-serv"
        ),
        "EMAIL_SEND" => $_SESSION['BXExtra']['REGION']['IBLOCK']['E_SHOP'],
        "BRANCH_HIDDEN" => true,
        "IN_COLUMN" => true,
        "TITLE" => $_REQUEST['title'],
        "URL" => $_REQUEST['url'],
		"WEB_FORM_ID" => 17,	// ID веб-формы
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
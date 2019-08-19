<?
define("STOP_STATISTICS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
CJSCore::Init(array('ajax', 'window'));
if (preg_match("#eletrical-work#", $_REQUEST['url'])){
    $Analytics = array(
        "ga" => array(
            "category" => "im-form",
            "action" => "eletrical-work"
        ),
        "ym" => "eletrical-work"
    );
}
if (preg_match("#electric-meter#", $_REQUEST['url'])){
    $Analytics = array(
        "ga" => array(
            "category" => "im-form",
            "action" => "eletrical-meter"
        ),
        "ym" => "eletrical-meter"
    );
}
if (preg_match("#water-meter#", $_REQUEST['url'])){
    $Analytics = array(
        "ga" => array(
            "category" => "im-form",
            "action" => "water-meter"
        ),
        "ym" => "water-meter"
    );
}
?>
<div class="popup-form overflow mw-600">
    <? $APPLICATION->IncludeComponent("bitrix:form.result.new", "", Array(
        "ANALYTICS" => $Analytics,
        "IN_COLUMN" => false,
        "BRANCH_EMAIL" => "E_SERVICE_INDV",
        "BRANCH_CNAHGE_EMAIL" => "Y",
        "EMAIL_SEND" => $_SESSION['BXExtra']['REGION']['IBLOCK']['E_SERVICE_INDV'],
        "TITLE" => $_REQUEST['title'],
        "URL" => $_REQUEST['url'],
        "WEB_FORM_ID" => 26,	// ID веб-формы
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
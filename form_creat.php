<?php
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(CModule::IncludeModule("form")) {


    $rsForms = CForm::GetList($by="s_id", $order="asc");
    while ($arForm = $rsForms->Fetch()) {

        $arANSWER = array();

        $arANSWER[] = array(
            "MESSAGE" => "Согласен",                           // параметр ANSWER_TEXT
            "C_SORT" => 100,                            // порядок фортировки
            "ACTIVE" => "Y",                            // флаг активности
            "FIELD_TYPE" => "checkbox",                        // тип ответа
            "FIELD_PARAM" => ""  // параметры ответа
        );

// формируем массив полей
        $arFields = array(
            "FORM_ID" => $arForm["ID"],                     // ID веб-формы
            "ACTIVE" => "Y",                     // флаг активности
            "TITLE" => "Согласие", // текст вопроса
            "TITLE_TYPE" => "text",                // тип текста вопроса
            "SID" => "SIMPLE_QUESTION_" . substr(md5(microtime()), -4),          // символьный идентификатор вопроса
            "C_SORT" => 350,                   // порядок сортировки
            "ADDITIONAL" => "N",                   // мы добавляем вопрос веб-формы
            "REQUIRED" => "N",                   // ответ на данный вопрос обязателен
            "IN_RESULTS_TABLE" => "Y",                   // добавить в HTML таблицу результатов
            "IN_EXCEL_TABLE" => "Y",                   // добавить в Excel таблицу результатов
            "FILTER_TITLE" => "Желаю получать информационные и рекламные сообщения об акциях и сервисах компании",       // подпись к полю фильтра
            "RESULTS_TABLE_TITLE" => "Желаю получать информационные и рекламные сообщения об акциях и сервисах компании",       // заголовок столбца фильтра
            "arFILTER_ANSWER_TEXT" => array("checkbox"),     // тип фильтра по ANSWER_TEXT
            "arANSWER" => $arANSWER,             // набор ответов
            "COMMENTS" => "Желаю получать информационные и рекламные сообщения об акциях и сервисах компании",
        );

// добавим новый вопрос
        $NEW_ID = CFormField::Set($arFields);
        if ($NEW_ID > 0) echo "Добавлен вопрос с ID=" . $NEW_ID;
        else // ошибка
        {
            // выводим текст ошибки
            global $strError;
            echo $strError;
        }
    }
    //CFormField::Delete(580);
}
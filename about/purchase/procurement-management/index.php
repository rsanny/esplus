<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Управление закупочной деятельностью");
?>

<div class="row">
    <div class="col col-12 col-md-4 col-lg-3">
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "left",
            Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "section",
                "DELAY" => "N",
                "MAX_LEVEL" => "2",
                "MENU_CACHE_GET_VARS" => array(""),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "left",
                "USE_EXT" => "N"
            )
        );?>
    </div>
    <div class="col col-12 col-md-8 col-lg-9">

<p>
Целью закупочной деятельности является своевременное и полное обеспечение деятельности АО «ЭнергосбыТ Плюс» и компаний, находящихся 
под управлением АО «ЭнергосбыТ Плюс» товарами, работами, услугами и иными благами по минимально возможным рыночным ценам с требуемыми 
показателями качества.
</p>

<p>В Обществе внедрена единая регламентирующая среда (нормативно-методическая база) закупочной деятельности, основанная на применения обязательных 
процедур при выборе подрядных организаций и поставщиков. Регламентация закупочной деятельности основана на соблюдении единства правил закупок 
для всех участников и направлена на повышение прозрачности и открытости закупочных процедур.</p>

<p>В соответствии с Федеральным законом РФ от 18.07.2011 № 223-ФЗ «О закупках товаров, работ, услуг отдельными видами юридических лиц», 
официальные публикации документов, объявляющие о начале проведения регламентированных закупок товаров, работ и услуг для нужд 
АО «ЭнергосбыТ Плюс» и компаний, находящихся под управлением АО «ЭнергосбыТ Плюс» размещаются на сайте 
<a href="http://www.zakupki.gov.ru/" target="_blank">zakupki.gov.ru</a></p>

<p>Основной электронной торговой площадкой для проведения в электронной форме закупок Общества является площадка по адресу 
<a href="https://www.b2b-energo.ru/" target="_blank">www.b2b-energo.ru</a></p>

<p>
Набор предусмотренных нормативными документами процедур закупок включает в себя: конкурс, запрос предложений/цен, 
конкурентные переговоры, закупку у единственного источника. Закупки также могут проходить в несколько этапов и с 
применением специальных процедур (таких как переторжка или предквалификация). 
Приоритетными для АО «ЭнергосбыТ Плюс» являются открытые конкурентные способы выбора поставщиков и подрядчиков.
</p>

<p>
Непосредственный выбор победителей закупочных процедур проводят закупочные комиссии филиалов.
</p>

<p>Отдельно в АО «ЭнергосбыТ Плюс» выделены закупки централизованных номенклатур, выбор победителей которых осуществляет 
Центральный закупочный орган АО «ЭнергосбыТ Плюс».</p>

<p>Любой участник конкурентных закупочных процедур имеет право подать заявление о рассмотрении разногласий, связанных с проведением закупок, 
по телефону «горячей линии» 8 (800) 700-0606 (звонок бесплатный).</p>

<div class="file-list--small">
        <a href="/upload/doc/Poryadok_oformleniya_i_rassmotreniya_obrashcheniy_uchastnikov.docx" class="file-item--small">
            <span><i class="icon-file--doc"></i></span>
            <b>Порядок оформления и рассмотрения обращений участников закупочных процедур</b>
        </a>

        <a href="/upload/doc/Politika_v_oblasti_zakupok.docx" class="file-item--small">
            <span><i class="icon-file--doc"></i></span>
            <b>Политика в области закупок</b>
        </a>

        <a href="/upload/doc/Положение о закупках ЭСБ_01.10.2018.zip" class="file-item--small">

            <span><i class="icon-file--zip"></i></span>
            <b>Положение о закупках</b>
        </a>
</div>

        <div class="row">
            <div class="col col-12 offset-md-1 col-lg-11 offset-lg-0 col-xl-9 offset-xl-2">
        <?$APPLICATION->IncludeComponent(
            "dorrbitt:form.result.new",
            "",
            Array(
                "EMAIL_SEND" => $_SESSION['BXExtra']['REGION']['IBLOCK']['E_PURCHASE'],
                "BRANCH_HIDDEN" => true,
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "N",
                "CHAIN_ITEM_LINK" => "",
                "CHAIN_ITEM_TEXT" => "",
                "EDIT_URL" => "",
                "IGNORE_CUSTOM_TEMPLATE" => "N",
                "ANALYTICS" => array(
                    "ga" => array(
                        "category" => "dom-about",
                        "action" => "zakup-q"
                    ),
                    "ym" => "zakup-q"
                ),
                "LIST_URL" => "",
                "SEF_MODE" => "N",
                "SUCCESS_URL" => "",
                "USE_EXTENDED_ERRORS" => "Y",
                "VARIABLE_ALIASES" => array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID",),
                "WEB_FORM_ID" => 3
            )
        );?>
            </div>
        </div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
    global $arContractSection;
    global $APPLICATION;
    global $OptimalGroup;
    $arContractSection = array(
        "PROPERTY_TYPE" => $_SESSION['BXExtra']['SITE']['ID'],
        "PROPERTY_BRANCH" => $_SESSION['BXExtra']['REGION']['IBLOCK']['ID']
    );
    ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "contract-sections",
        Array(
            "UF_BRANCH" => $OptimalGroup['BRANCH']['ID'],
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
            "DETAIL_URL" => $APPLICATION->GetCurPage()."#SECTION_CODE#/#ELEMENT_CODE#/",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "N",
            "DISPLAY_PREVIEW_TEXT" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array("", ""),
            "FILTER_NAME" => "arContractSection",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "31",
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
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array("TYPE", ""),
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
    <br><br>
    <div class="row">
        <div class="col col-12 col-lg-10 offset-lg-1">
            <div class="form-description bg-message bg-info fs-15">
                <div class="mb-10 color-orange"><b>Информация</b><i class="icon-info--orange"></i></div>
                <? if ($OptimalGroup['SITE']['CODE']=="home"):?>
                Заключение договора в письменной форме не требуется. Предоставление коммунальных услуг осуществляется в соответствии с Постановлением Правительства Российской Федерации №354 от 06.05.2011г., путем совершения клиентом конклюдентных действий (действий, свидетельствующих о намерении потреблять коммунальные услуги или о фактическом потреблении таких услуг).
                <? else:?>
                Обращаем Ваше внимание, что сервис доступен только для промышленных потребителей, исполнителей коммунальных услуг и прочих субъектов хозяйственной деятельности.<br>
Данный сервис не позволяет заключать договор с государственными или муниципальными унитарными предприятиями, теплосетевыми и теплоснабжающими организациями.
                    <? if($OptimalGroup['GROUP'] == "hide_shop_menu"):?>
                    <br><br><a href="/business/clients/kak-zaklyuchit-dogovor/" class="btn btn-orange">Как заключить договор</a>
                    <? endif;?>
                <? endif;?>
            </div>
        </div>
    </div>
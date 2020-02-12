<?
//условия акции
global $arrFilter;
if(!empty($OptimalGroup['BRANCH']['ID'])) {
    $arrFilter['=PROPERTY_REGION'] = $OptimalGroup['BRANCH']['ID'];
}
else {
    $arrFilter['=PROPERTY_REGION'] = 23;
}
?>
<section class="section section--effect">
    <div class="container">
<?
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "blocks_s2",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
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
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array("", ""),
        "FILTER_NAME" => "arrFilter",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "58",
        "IBLOCK_TYPE" => "promo",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
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
        "PROPERTY_CODE" => array("TIME", "REGION", "FOR"),
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
<section class="section section--effect section--gray">
    <div class="container">
    <div class="slider-flow slider-flow--x-3-slides">
            <div class="title"><h2>Плюсы для участников акции</h2></div>
        <div class="swiper-container">
            <div class="swiper-wrapper swiper-no-swiping">
                    <div class="swiper-slide">
                        <div class="card card--nohover card--transparent">
                            <div class="card__img">
                               <img src="/local/templates/delement/frontend/assets/images/present1.png" style="width: 90px;">
                            </div>
                            <div class="card__label">
                                <div class="card__desc">
                                   Розыгрыш призов <br>среди участников акции <br> &nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card card--nohover card--transparent">
                            <div class="card__img">
                                <img src="/local/templates/delement/frontend/assets/images/present2.png" style="width: 90px;">
                            </div>
                            <div class="card__label">
                                <div class="card__desc">
                                    Приятный бонус -  <br>списание пеней при <br>оплате задолженности
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card card--nohover card--transparent">
                            <div class="card__img">
                                <img src="/local/templates/delement/frontend/assets/images/present3.png" style="width: 90px;">
                            </div>
                            <div class="card__label">
                                <div class="card__desc">
                                    Участвуйте в акции -  <br>встречайте Новый год без  <br>долгов и с подарками!
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="slider-flow-pagination"></div>
        </div>
    </div>
    </div>
</section>
<section id="price" class="section section--price">
<div class="container">
    <header class="section__title">
        <h2>Как стать участником акции</h2>
    </header>
    <div class="section__col section__col--full">
        <div class="slider-offers">
            <div class="swiper-container">
                <div class="swiper-wrapper swiper-no-swiping">
                        <div class="swiper-slide">
                            <a class="link-wrapper link-wrapper--flex">
                                <figure class="price-card price-card--nohover">
                                    <div class="price-card__img ">
                                        <img src="/local/templates/delement/frontend/assets/images/tree1.JPG" alt="" />
                                    </div>
                                    <figcaption class="price-card__label">
                                        <div class="price-card__title">
                                            Шаг 1
                                        </div>
                                            <div class="price-card__desc">
                                                Заполните анкету участника акции*
                                            </div>
                                            <div class="price-card__price">
                                                *Рекомендуем заполнить Анкету с контактными данными. Это поможет нам связаться с победителем акции.
                                            </div>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                    <div class="swiper-slide">
                        <a class="link-wrapper link-wrapper--flex">
                            <figure class="price-card price-card--nohover">
                                <div class="price-card__img ">
                                    <img src="/local/templates/delement/frontend/assets/images/tree2.JPG" alt="" />
                                </div>
                                <figcaption class="price-card__label">
                                    <div class="price-card__title">
                                        Шаг 2
                                    </div>
                                    <div class="price-card__desc">
                                        Оплатите квитанцию за ноябрь и декабрь до конца года
                                    </div>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a class="link-wrapper link-wrapper--flex">
                            <figure class="price-card price-card--nohover">
                                <div class="price-card__img ">
                                    <img src="/local/templates/delement/frontend/assets/images/tree3.JPG" alt="" />
                                </div>
                                <figcaption class="price-card__label">
                                    <div class="price-card__title">
                                        Шаг 3
                                    </div>
                                    <div class="price-card__desc">
                                        Если у вас есть задолженность - погасите её до конца года без пени
                                    </div>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a class="link-wrapper link-wrapper--flex">
                            <figure class="price-card price-card--nohover">
                                <div class="price-card__img ">
                                    <img src="/local/templates/delement/frontend/assets/images/tree4.JPG" alt="" />
                                </div>
                                <figcaption class="price-card__label price-card__label--last">
                                    <div class="price-card__title">
                                        Шаг 4
                                    </div>
                                    <div class="price-card__desc">
                                        Встречайте Новый год без долгов и с подарками
                                    </div>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section id="feedback" class="section section--contact">
    <div class="container">
        <div class="section__form data-js-form-validate="">
        <?php 
        $Analytics = array(
            "ym" => "FORM_PROMO_2"
        );
        ?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:form.result.new",
                    "participant",
                    Array(
                        "EMAIL_SEND" => $_SESSION['BXExtra']['REGION']['IBLOCK']['E_PURCHASE'],
                        "ANALYTICS" => $Analytics,
                        "BRANCH_HIDDEN" => true,
                        "AJAX_MODE" => "Y",
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
                            "ym" => "FORM_PROMO_2"
                        ),
                        "LIST_URL" => "",
                        "SEF_MODE" => "N",
                        "SUCCESS_URL" => "",
                        "USE_EXTENDED_ERRORS" => "Y",
                        "VARIABLE_ALIASES" => array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID",),
                        "WEB_FORM_ID" => 34,
                        "DOMAIN" => $OptimalGroup['DOMAIN'],
                        "URL_PD" => $_SESSION['BXExtra']['REGION']['IBLOCK']['LINK_PD'],
                    )
                );?>
            </div>
        </div>
</section>


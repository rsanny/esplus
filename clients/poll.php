<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Опрос: Как вы хотели бы платить за отопление?");
?><p class="color-orange">
 <b>Уважаемые клиенты!</b>
</p>
<p class="color-orange">
	 Сейчас в Самарской области установлен порядок ежемесячной оплаты отопления, в том числе и в летние месяцы, когда услуга отопления не предоставляется.
</p>
<p class="color-orange">
	 По желанию собственников жилья оплачивать отопление можно исключительно в отопительный период, а не круглый год. Среди главных преимуществ платежей за тепло в осенне-зимний период - контроль объемов начислений, исключение внесения корректировок в расчеты по итогам года, возможность управлять потреблением ресурсов.
</p>
<p class="color-orange">
	 Жители Самарской области уже сейчас могут оценить эти плюсы. Для этого достаточно на общем собрании собственников жилья принять решение о переходе на схему расчетов за услуги отопления во время отопительного периода.
</p>
<p>
 <a target="_blank" href="/upload/sravnitelnaya_tablica_metodik_oplati.pdf" >Сравнение двух методик оплаты отопления</a>
</p>
<p class="color-orange">
 <b>Нам важно ваше мнение, сообщите как вы хотели бы платить за отопление, приняв участие в онлайн-опросе:</b>
</p>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"city", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
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
		"COMPONENT_TEMPLATE" => "city",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "53",
		"IBLOCK_TYPE" => "poll",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "99999999999999",
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
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
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
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
$domen_pref = explode(".",$_SERVER["SERVER_NAME"])[0];
$menu_act = ($domen_pref == "komi" || $domen_pref == "ivanovo") ? 0 : 1;
if($menu_act == 1){
	$aMenuLinks = Array(
		Array(
			"О компании", 
			"/about/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"О филиале", 
			"/company/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Руководство", 
			"/company/guide/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Реквизиты", 
			"/company/requisites/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Закупки", 
			"/about/purchase/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Акционерам и инвесторам", 
			"/company/copies_providing/", 
			Array(), 
			Array(),
			"" 
		),
		Array(
			"Раскрытие информации", 
			"/company/disclosure_of_information/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Карьера", 
			"/career/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Новости", 
			"/news/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Акции для клиентов", 
			"/promo/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Стандарт качества обслуживания", 
			"/company/standard_of_quality_of_service/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Контакты", 
			"/offices/", 
			Array(), 
			Array(), 
			"" 
		)
	);
}
elseif($menu_act == 0){
	$aMenuLinks = Array(
		Array(
			"О компании", 
			"/about/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"О филиале", 
			"/company/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Руководство", 
			"/company/guide/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Реквизиты", 
			"/company/requisites/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Закупки", 
			"/about/purchase/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Акционерам и инвесторам", 
			"/company/copies_providing/", 
			Array(), 
			Array(),
			"" 
		),
		Array(
			"Раскрытие информации", 
			"/company/disclosure_of_information/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Карьера", 
			"/career/", 
			Array(), 
			Array(), 
			"" 
		),
	); 
}

?>
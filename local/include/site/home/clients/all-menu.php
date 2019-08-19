<?
$arClientsMenu = array(
    "empty" => array(
        "clients--odn" => array(
            "NAME" => "ОДН",
            "LINK" => "/clients/odn/"
        ),
        "clients--bill" => array(
            "NAME" => "О квитанции",
            "LINK" => "/clients/o-kvitantsii/"
        ),
        "clients--shop" => array(
            "NAME" => "Интернет-магазин",
            "LINK" => OptimalGroup\Url::Shop("/clients/")
        ),
        "clients--pc" => array(
            "NAME" => "Личный кабинет и сервисы",
            "LINK" => "/clients/lichnyy-kabinet-i-servisy/"
        ),
        "clients--counter" => array(
            "NAME" => "Счетчики",
            "LINK" => "/clients/schetchiki/"
        ),
        "clients--arrears" => array(
            "NAME" => "Задолженность",
            "LINK" => "/clients/zadolzhennost/"
        ),
    ),
    "По услугам энергоснабжения" => array(
        "clients--elect" => array(
            "NAME" => "Электроэнергия",
            "LINK" => "/clients/elektroenergiya/"
        ),
        "clients--water" => array(
            "NAME" => "Горячая вода",
            "LINK" => "/clients/goryachaya-voda/"
        ),
        "clients--heat" => array(
            "NAME" => "Отопление",
            "LINK" => "/clients/teplosnabzhenie/"
        ),
    )
);
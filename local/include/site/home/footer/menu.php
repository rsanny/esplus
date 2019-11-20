<?
$ZhkuDomainsFooter = array(
    "ekb",
    "kirov",
    "oren",
    "novgorod",
    "chuvashia",
    "vladimir",
    "udm",
);

if (empty($OptimalGroup['GROUP'])) {
    $OptimalGroup['GROUP'] = 'hide_shop_menu';
}

$FooterMenuPath = INCLUDE_PATH.'site/home/footer/menu-'.$OptimalGroup['GROUP'].'.php';

//print $_SERVER["DOCUMENT_ROOT"].$FooterMenuPath;
require($_SERVER["DOCUMENT_ROOT"].$FooterMenuPath);
?>
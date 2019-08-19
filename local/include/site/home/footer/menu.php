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
$FooterMenuPath = INCLUDE_PATH.'site/home/footer/menu-'.$OptimalGroup['GROUP'].'.php';
//print $_SERVER["DOCUMENT_ROOT"].$FooterMenuPath;
require($_SERVER["DOCUMENT_ROOT"].$FooterMenuPath);
?>
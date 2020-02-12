<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет Клиента");
require($_SERVER["DOCUMENT_ROOT"]."/service/header.php");
?>

<?

$listDomain = array(
    "oren",
    "ulianovsk",
    "saratov",
    "samara",
    //"perm",
    "penza",
    "novgorod",
    "mordovia",
    "chuvashia",
    "vladimir",
    //"kirov"
);

if(in_array($OptimalGroup['DOMAIN'], $listDomain) && $OptimalGroup['SITE']['CODE'] == "business") {
    CHTTP::SetStatus("404 Not Found");
    @define("ERROR_404", "Y");
    global $APPLICATION;
    $APPLICATION->RestartBuffer();
    include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/header.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/404.php';
    include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/footer.php';

}

if ($OptimalGroup['DOMAIN'] == "chuvashia")
$APPLICATION->IncludeFile($CurPath . '/content-'.chuvashia.'.php', Array(), Array("MODE"=> "html"));

else 
   $APPLICATION->IncludeFile($CurPath . '/content-'.$indexPage.'.php', Array(), Array("MODE"=> "html"));
?>



<!--<? $APPLICATION->IncludeFile($CurPath . '/content-'.$indexPage.'.php', Array(), Array("MODE"=> "html"));?>-->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
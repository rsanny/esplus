<?
$HeaderMenuPath = INCLUDE_PATH.'site/'.$OptimalGroup['SITE']['CODE'].'/header/menu-'.$OptimalGroup['GROUP'].'.php';
$tariffLink = "/tariffs/".$OptimalGroup['DOMAIN']."/fiz/";
if ($OptimalGroup['DOMAIN'] == "vladimir")
    $HeaderMenuPath = INCLUDE_PATH . 'site/'.$OptimalGroup['SITE']['CODE'].'/header/menu-vladimir.php';
if ($OptimalGroup['DOMAIN'] == "chuvashia")
    $HeaderMenuPath = INCLUDE_PATH . 'site/'.$OptimalGroup['SITE']['CODE'].'/header/menu-chuvashia.php';

if ($OptimalGroup['DOMAIN'] == "kirov")
    $HeaderMenuPath = INCLUDE_PATH . 'site/'.$OptimalGroup['SITE']['CODE'].'/header/menu-kirov.php';

?>
<div class="col col-8 hidden-md-down">
    <menu class="no-list main-menu" data-menu="<?=$OptimalGroup['SITE']['CODE'];?>-<?=$OptimalGroup['GROUP'];?>">
        <?
        if(file_exists($_SERVER["DOCUMENT_ROOT"].$HeaderMenuPath))
            require($_SERVER["DOCUMENT_ROOT"].$HeaderMenuPath);
        ?>
    </menu>
</div>
<div class="col col-5 text-right col-md-4 col-lg-2 offset-2 offset-md-0">
    <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/header-auth.php', Array(), Array("MODE"=> "html"));?>
</div>
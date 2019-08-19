<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");

@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");
?>
<div class="index-section bg-grey">
    <div class="page-404--sign fs-30 text-center mb-20">
        <div style="font-size: 300px;"><b>404</b></div>Страница не найдена!
    </div>
    <div class="text-center">
        <a href="/" class="btn btn-orange w-170">На главную</a>
    </div>
</div>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
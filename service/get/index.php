<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Узнать задолженность");
require($_SERVER["DOCUMENT_ROOT"]."/service/header.php");
if ($indexPage == "vladimir"):
    $APPLICATION->IncludeFile($CurPath . '/content-'.$indexPage.'.php', Array(), Array("MODE"=> "html"));
else:
?>
<div class="service-form service-tabs">
    <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/form/get-balance.php', Array(), Array("MODE"=> "html"));?>
</div>
<? endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
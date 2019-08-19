<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О филиале");
?>
<?
OptimalGroup\Core::SimplePage(
    array(
        "arSettings"=> array(
            "LEFT_MENU" => "Y"
        )
    )
);
?> 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
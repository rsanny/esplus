<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Выгоды для клиентов");
?>
<?
OptimalGroup\Core::SimplePage(
    array(
        "arSettings"=> array(
            "LEFT_MENU" => "Y",
            "MENU_ROOT" => "section"
        )
    )
);
?> 

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
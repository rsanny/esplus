<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Руководство");
?>
<?
OptimalGroup\Core::SimplePage(
    array(
        "arSettings"=> array(
            "LEFT_MENU" => "Y",
            "CACHE_SELECTED_ITEMS" => "Y"
        )
    )
);
?> 

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Акционерам и инвесторам");
?>
<?
OptimalGroup\Core::SimplePage(
    array(
        "arSettings"=> array(
            "LEFT_MENU" => "Y",
            "MENU_ROOT" => "left",
            "DEPTH_LEVEL" => "1",
            "CACHE_SELECTED_ITEMS" => "Y"
        )
    )
);
?> 

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
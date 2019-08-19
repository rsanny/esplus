<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Руководство");
LocalRedirect("/company/disclosure_of_information/disclosure_of_information-fz-426/");
?>

<div class="row">
    <div class="col col-12 col-md-4 col-lg-3">
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "left",
            Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "section",
                "DELAY" => "N",
                "MAX_LEVEL" => "2",
                "MENU_CACHE_GET_VARS" => array(""),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "left",
                "USE_EXT" => "Y"
            )
        );?>
    </div>
    <div class="col col-12 col-md-8 col-lg-9">
    </div>
</div>    

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
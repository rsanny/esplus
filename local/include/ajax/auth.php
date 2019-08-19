<?
$_GET['USER_LOGIN'] = $_POST['USER_LOGIN'] = $_REQUEST['USER_LOGIN'] = $_REQUEST['login'];
$_GET['USER_PASSWORD'] = $_POST['USER_PASSWORD'] = $_REQUEST['USER_PASSWORD'] = $_REQUEST['pass'];
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?><?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"json",
	Array(
		"FORGOT_PASSWORD_URL" => "",
		"PROFILE_URL" => "",
		"REGISTER_URL" => "",
		"SHOW_ERRORS" => "Y"
	)
);?>
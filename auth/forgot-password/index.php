<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Восстановление пароля");
?>
<?$APPLICATION->IncludeComponent(
  "bitrix:system.auth.form",
  "errors",
  Array(
     "REGISTER_URL" => "",
     "FORGOT_PASSWORD_URL" => "/auth/forgot-password",
     "PROFILE_URL" => "/personal/profile/",
     "SHOW_ERRORS" => "Y"
  )
);?>
<?$APPLICATION->IncludeComponent(
"bitrix:system.auth.forgotpasswd", 
".default",
Array()
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
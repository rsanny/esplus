<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
use DorrBitt\ClassDebug\ClassDebug;
//ClassDebug::debug($_SERVER);
?>
<?$APPLICATION->IncludeComponent(
   "bitrix:subscribe.edit",
   "",
   Array(
      "SHOW_HIDDEN" => "N",
      "ALLOW_ANONYMOUS" => "Y",
      "SHOW_AUTH_LINKS" => "Y",
      "CACHE_TIME" => "36000000",
      "SET_TITLE" => "Y"
   )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
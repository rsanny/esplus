<?
	require($_SERVER[ "DOCUMENT_ROOT" ] . "/bitrix/header.php");
	$APPLICATION->SetTitle("Подтверждение регистрации");

//	if (!isset($_REQUEST[ 'step' ])) {
//		$APPLICATION->IncludeComponent("buyonet:system.auth.confirmation", ".default", Array());
//	}
//	else {
		if ($_REQUEST[ 'step' ] == '1') {
			if (!CUser::IsAuthorized() || CUser::GetID() != $_REQUEST['confirm_user_id']) {
				if (CUser::IsAuthorized()) {
					CUser::Logout();
				}
				CUser::Authorize($_REQUEST['confirm_user_id']);
			}
			$APPLICATION->IncludeComponent("buyonet:main.profile", "change_password", Array(
				"AJAX_MODE" => "Y",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"SET_TITLE" => "N",
				"USER_PROPERTY" => array(),
				"SEND_INFO" => "N",
				"CHECK_RIGHTS" => "N",
				"USER_PROPERTY_NAME" => "",
				"AJAX_OPTION_ADDITIONAL" => ""
			));
		}
//	}

	require($_SERVER[ "DOCUMENT_ROOT" ] . "/bitrix/footer.php");?>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\DGAPI;
use DorrBitt\DataArefmetikaCapchy\DataArefmetikaCapchy;
use DorrBitt\IB\IBOT;
use OptimalGroup\Core;
//print DGAPI::ses()."<br>";
$ev = DGAPI::dev("4805c7621bc280bb538bce47a4bcb91a");
$OptimalGroup = Core::Settings();
$REQUEST_URI = trim(explode("?",$_SERVER["REQUEST_URI"])[0]);
define("POST_FORM_ACTION_URI_ABS",$REQUEST_URI);

if (CModule::IncludeModule("form"))
{
	$GLOBALS['strError'] = '';

	$arDefaultComponentParameters = array(
		"WEB_FORM_ID" => $_REQUEST["WEB_FORM_ID"],
		"SEF_MODE" => "N",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"CACHE_TIME" => "3600",
	);

	$user_ses = DGAPI::ses();
	$sol = md5("result");
	$solgo = DataArefmetikaCapchy::ses_sol();

	$arisave = DataArefmetikaCapchy::ar_save();
	$ariResult = "{$arisave[0]}-{$arisave[1]}-{$arisave[2]}";


	$provBota = DataArefmetikaCapchy::arf_proverka();
	if($ev == 1){
		//print $provBota;
		//ClassDebug::debug($_REQUEST);
		//print $ariResult;
	}


	//if($_POST["form_text_853"] == "capcha" || $provBota == 0) $_POST["form_text_853"] = "";
	if($_POST["form_text_853"] == "capcha" || $provBota == 0){
        $_POST["form_text_853"] = "";
	}
	elseif($_POST["form_text_854"] == "capcha" || $provBota == 0){
		$_POST["form_text_854"] = "";
	}
	elseif($_POST["form_text_855"] == "capcha" || $provBota == 0){
		$_POST["form_text_855"] = "";
	}
	elseif($_POST["form_text_858"] == "capcha" || $provBota == 0){
		$_POST["form_text_858"] = "";
	}
	elseif($_POST["form_text_857"] == "capcha" || $provBota == 0){
		$_POST["form_text_857"] = "";
	}
	elseif($_POST["form_text_856"] == "capcha" || $provBota == 0){
		$_POST["form_text_856"] = "";
	}
	elseif($_POST["form_text_859"] == "capcha" || $provBota == 0){
		$_POST["form_text_859"] = "";
	}
	elseif($_POST["form_text_860"] == "capcha" || $provBota == 0){
		$_POST["form_text_860"] = "";
	}
	elseif($_POST["form_text_861"] == "capcha" || $provBota == 0){
		$_POST["form_text_861"] = "";
	}
	elseif($_POST["form_text_862"] == "capcha" || $provBota == 0){
		$_POST["form_text_862"] = "";
	}
	elseif($_POST["form_text_863"] == "capcha" || $provBota == 0){
		$_POST["form_text_863"] = "";
	}
	elseif($_POST["form_text_864"] == "capcha" || $provBota == 0){
		$_POST["form_text_864"] = "";
	}
	elseif($_POST["form_text_865"] == "capcha" || $provBota == 0){
		$_POST["form_text_865"] = "";
	}
	elseif($_POST["form_text_866"] == "capcha" || $provBota == 0){
		$_POST["form_text_866"] = "";
	}
	elseif($_POST["form_text_867"] == "capcha" || $provBota == 0){
		$_POST["form_text_867"] = "";
	}
	elseif($_POST["form_text_868"] == "capcha" || $provBota == 0){
		$_POST["form_text_868"] = "";
	}
	elseif($_POST["form_text_869"] == "capcha" || $provBota == 0){
		$_POST["form_text_869"] = "";
	}
	elseif($_POST["form_text_870"] == "capcha" || $provBota == 0){
		$_POST["form_text_870"] = "";
	}
	elseif($_POST["form_text_871"] == "capcha" || $provBota == 0){
		$_POST["form_text_871"] = "";
	}
	elseif($_POST["form_text_872"] == "capcha" || $provBota == 0){
		$_POST["form_text_872"] = "";
	}
	elseif($_POST["form_text_873"] == "capcha" || $provBota == 0){
		$_POST["form_text_873"] = "";
	}
	elseif($_POST["form_text_874"] == "capcha" || $provBota == 0){
		$_POST["form_text_874"] = "";
	}

	if($_POST["form_text_856"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_853"] == $ariResult && $provBota == 1 ){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_854"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_855"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_856"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_857"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_858"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_859"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_860"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_861"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_862"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_863"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_864"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_865"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_866"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_867"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_868"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_869"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_870"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_871"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_872"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_873"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	elseif($_POST["form_text_874"] == $ariResult && $provBota == 1){
		$form_text_data = 1;
	}
	else{
		$form_text_data = 0;
	}
	if($form_text_data == 0){
		$_POST["form_text_853"] = ""; $_POST["form_text_854"] = ""; $_POST["form_text_855"] = "";
		$_POST["form_text_856"] = ""; $_POST["form_text_857"] = ""; $_POST["form_text_858"] = "";
		$_REQUEST["form_text_853"] = ""; $_REQUEST["form_text_854"] = ""; $_REQUEST["form_text_855"] = "";
		$_REQUEST["form_text_856"] = ""; $_REQUEST["form_text_857"] = ""; $_REQUEST["form_text_858"] = "";
	}
	if(isset($_REQUEST["RESILT_SUSSES"]) && !empty($_REQUEST["RESILT_SUSSES"])){
		$_REQUEST["WEB_FORM_ID"] = $_SESSION[$solgo]["arResultOk"]["WEB_FORM_ID"];
		$_REQUEST["RESULT_ID"] = $_SESSION[$solgo]["arResultOk"]["RESULT_ID"];
		$_REQUEST["formresult"] = $_SESSION[$solgo]["arResultOk"]["formresult"];
		unset($_SESSION[$solgo]);
	}
	
	if($ev == 1){
		/*print $provBota;
		print("asd =axASX ");
		print($form_text_data);
		print("asd =axASX ]");
		ClassDebug::debug($_REQUEST);
		print $ariResult;*/
	}

	foreach ($arDefaultComponentParameters as $key => $value) if (!is_set($arParams, $key)) $arParams[$key] = $value;

	$arDefaultUrl = array(
		'LIST' => $arParams["SEF_MODE"] == "Y" ? "list/" : "result_list.php",
		'EDIT' => $arParams["SEF_MODE"] == "Y" ? "edit/#RESULT_ID#/" : "result_edit.php"
	);
    //ClassDebug::debug($arDefaultUrl);
	foreach ($arDefaultUrl as $action => $url)
	{
		if (!is_set($arParams, $action.'_URL'))
		{
			if (!is_set($arParams, 'SHOW_'.$action.'_PAGE') || $arParams['SHOW_'.$action.'_PAGE'] == 'Y')
				$arParams[$action.'_URL'] = $url;
		}
	}

	if (isset($arParams['RESULT_ID']))
		unset($arParams['RESULT_ID']);

	//  insert chain item
	if (strlen($arParams["CHAIN_ITEM_TEXT"]) > 0)
	{
		$APPLICATION->AddChainItem($arParams["CHAIN_ITEM_TEXT"], $arParams["CHAIN_ITEM_LINK"]);
	}

	// check whether cache using needed
	$bCache = !(
		$_SERVER["REQUEST_METHOD"] == "POST"
		&&
		(
			!empty($_REQUEST["web_form_submit"])
			||
			!empty($_REQUEST["web_form_apply"])
		)
		||
		$_REQUEST['formresult'] == 'ADDOK'
	)
	&&
	!(
		$arParams["CACHE_TYPE"] == "N"
		||
		(
			$arParams["CACHE_TYPE"] == "A"
			&&
			COption::GetOptionString("main", "component_cache_on", "Y") == "N"
		)
		||
		(
			$arParams["CACHE_TYPE"] == "Y"
			&&
			intval($arParams["CACHE_TIME"]) <= 0
		)
	);

	// start caching
	if ($bCache)
	{
		// append arParams to cache ID;
		$arCacheParams = array();
		foreach ($arParams as $key => $value)
		{
			if($key !== "NEW_URL" && substr($key, 0, 1) != "~")
			{
				$arCacheParams[$key] = $value;
			}
		}
		// create CPHPCache class instance
		$obFormCache = new CPHPCache;
		// create cache ID and path
		$CACHE_ID = SITE_ID."|".$componentName."|".md5(serialize($arCacheParams))."|".$USER->GetGroups();
		if(($tzOffset = CTimeZone::GetOffset()) <> 0)
			$CACHE_ID .= "|".$tzOffset;
		$CACHE_PATH = "/".SITE_ID.CComponentEngine::MakeComponentPath($componentName);
	}

	// initialize cache
	if ($bCache && $obFormCache->InitCache($arParams["CACHE_TIME"], $CACHE_ID, $CACHE_PATH))
	{
		// if cache already exists - get vars
		$arCacheVars = $obFormCache->GetVars();
		$bVarsFromCache = true;

		$arResult = $arCacheVars["arResult"];

		if ($arParams["IGNORE_CUSTOM_TEMPLATE"] == "N"
			&& $arResult["arForm"]["USE_DEFAULT_TEMPLATE"] == "N"
			&& strlen($arResult["arForm"]["FORM_TEMPLATE"]) > 0)
		{
			$FORM = $arCacheVars["FORM"];
			if (!$FORM)
			{
				$bVarsFromCache = false;
			}
		}
		$arResult['FORM_NOTE'] = '';
		$arResult['isFormNote'] = 'N';

		$arParams['WEB_FORM_ID'] = $arResult['arForm']['ID'];
	}
	else
	{ 
/*************************************************************************************************/
		$bVarsFromCache = false;

		$arResult["bSimple"] = COption::GetOptionString("form", "SIMPLE", "Y") == "N" ? "N" : "Y";
		$arResult["bAdmin"] = defined("ADMIN_SECTION") && ADMIN_SECTION===true ? "Y" : "N";

		// if form taken from admin interface - check rights to form module
		if ($arResult["bAdmin"] == "Y")
		{
			$FORM_RIGHT = $APPLICATION->GetGroupRight("form");
			if($FORM_RIGHT<="D") $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
		}

		if (intval($arParams['WEB_FORM_ID']) <= 0 && strlen($arParams['WEB_FORM_ID']) > 0)
		{ 
			$obForm = CForm::GetBySID($arParams['WEB_FORM_ID']);
			if ($arForm = $obForm->Fetch())
			{
				$arParams['WEB_FORM_ID'] = $arForm['ID'];
			}
		}
		
		//ClassDebug::debug($arParams);
		// check WEB_FORM_ID and get web form data
		$arParams["WEB_FORM_ID"] = CForm::GetDataByID($arParams["WEB_FORM_ID"], $arResult["arForm"], $arResult["arQuestions"], $arResult["arAnswers"], $arResult["arDropDown"], $arResult["arMultiSelect"], $arResult["bAdmin"] == "Y" || $arParams["SHOW_ADDITIONAL"] == "Y" || $arParams["EDIT_ADDITIONAL"] == "Y" ? "ALL" : "N");

		$arResult["WEB_FORM_NAME"] = $arResult["arForm"]["SID"];

		// if wrong WEB_FORM_ID return error;
		if ($arParams["WEB_FORM_ID"] > 0)
		{
			// check web form rights;
			$arResult["F_RIGHT"] = intval(CForm::GetPermission($arParams["WEB_FORM_ID"]));

			// in no form access - return error
			if ($arResult["F_RIGHT"] < 10)
			{
				$arResult["ERROR"] = "FORM_ACCESS_DENIED";
			}
		}
		else
		{
			$arResult["ERROR"] = "FORM_NOT_FOUND";
		}

		//ClassDebug::debug($arResult);

		if ($bCache)
		{
			$obFormCache->StartDataCache();
			$GLOBALS['CACHE_MANAGER']->StartTagCache($CACHE_PATH);
			$GLOBALS['CACHE_MANAGER']->RegisterTag('forms');
			$GLOBALS['CACHE_MANAGER']->RegisterTag('form_'.$arParams['WEB_FORM_ID']);
			$GLOBALS['CACHE_MANAGER']->EndTagCache();
			$obFormCache->EndDataCache(
				array(
					"arResult" => $arResult,
				)
			);
		}
	}


	if (strlen($arResult["ERROR"]) <= 0)
	{  
		// ************************************************************* //
		// ****************** get/post processing ********************** //
		// ************************************************************* //
		$arResult["arrVALUES"] = array();
		if($ev == 1){ //print("ERROR");
			//ClassDebug::debug($arResult["ERROR"]);
			}
		if(isset($_REQUEST["ERROR"])){
			$arResult = $_SESSION[$solgo]["arResult"];
			unset($_SESSION[$solgo]["arResult"]);
		}
         
		if (($_POST['WEB_FORM_ID'] == $arParams['WEB_FORM_ID'] || $_POST['WEB_FORM_ID'] == $arResult['arForm']['SID']) && (strlen($_REQUEST["web_form_submit"])>0 || strlen($_REQUEST["web_form_apply"])>0))
		{
			$arResult["arrVALUES"] = $_REQUEST;
			if($ev == 1){ //print("arrVALUES");
			//ClassDebug::debug($arResult["arrVALUES"]);
			}
			// check errors
			$arResult["FORM_ERRORS"] = CForm::Check($arParams["WEB_FORM_ID"], $arResult["arrVALUES"], false, "Y", $arParams['USE_EXTENDED_ERRORS']);
			
			if (
				$arParams['USE_EXTENDED_ERRORS'] == 'Y' && (!is_array($arResult["FORM_ERRORS"]) || count($arResult["FORM_ERRORS"]) <= 0)
				||
				$arParams['USE_EXTENDED_ERRORS'] != 'Y' && strlen($arResult["FORM_ERRORS"]) <= 0
			)
			{

				if($ev == 1){ //print("FORM_ERRORS = [");
					//ClassDebug::debug($arResult["FORM_ERRORS"]);
					//print("FORM_ERRORS = ] ");
					}
				// check user session
				if (check_bitrix_sessid())
				{
					$return = false;
					if($ev == 1){ //print("arrVALUES 2");
						//ClassDebug::debug($arResult["arrVALUES"]);
						//ClassDebug::debug($arParams["WEB_FORM_ID"]);
						}
					// add result
					if($RESULT_ID = CFormResult::Add($arParams["WEB_FORM_ID"], $arResult["arrVALUES"]))
					{

						if($ev == 1){ 
                            //print("RESULTID = {$RESULT_ID}");
						}
						//$arResult["FORM_NOTE"] = GetMessage("FORM_DATA_SAVED1").$RESULT_ID.GetMessage("FORM_DATA_SAVED2");
						$arResult["FORM_RESULT"] = 'addok';
						// send email notifications
						CFormCRM::onResultAdded($arParams["WEB_FORM_ID"], $RESULT_ID);
						CFormResult::SetEvent($RESULT_ID);
						CFormResult::Mail($RESULT_ID);

						// choose type of user redirect and do it

						if ($arResult["F_RIGHT"] >= 15)
						{
							if (strlen($_REQUEST["web_form_submit"])>0 && strlen($arParams["LIST_URL"]) > 0)
							{
								if ($arParams["SEF_MODE"] == "Y")
								{
									//LocalRedirect($arParams["LIST_URL"]."?strFormNote=".urlencode($arResult["FORM_NOTE"]));
									print 11;
									/*LocalRedirect(
										str_replace(
											array('#WEB_FORM_ID#', '#RESULT_ID#'),
											array($arParams['WEB_FORM_ID'], $RESULT_ID),
											$arParams["LIST_URL"]
										)."?formresult=".urlencode($arResult["FORM_RESULT"])
									);*/
								}
								else
								{
									//LocalRedirect($arParams["LIST_URL"].(strpos($arParams["LIST_URL"], "?") === false ? "?" : "&")."WEB_FORM_ID=".$arParams["WEB_FORM_ID"]."&RESULT_ID=".$RESULT_ID."&strFormNote=".urlencode($arResult["FORM_NOTE"]));
									print 22;
									/*LocalRedirect(
										$arParams["LIST_URL"]
										.(strpos($arParams["LIST_URL"], "?") === false ? "?" : "&")
										."WEB_FORM_ID=".$arParams["WEB_FORM_ID"]
										."&RESULT_ID=".$RESULT_ID
										."&formresult=".urlencode($arResult["FORM_RESULT"])
									);*/
								}
							}
							elseif (strlen($_REQUEST["web_form_apply"])>0 && strlen($arParams["EDIT_URL"])>0)
							{
								if ($arParams["SEF_MODE"] == "Y")
								{
									//LocalRedirect(str_replace("#RESULT_ID#", $RESULT_ID, $arParams["EDIT_URL"])."?strFormNote=".urlencode($arResult["FORM_NOTE"]));
									print 33;
									/*LocalRedirect(
										str_replace(
											array('#WEB_FORM_ID#', '#RESULT_ID#'),
											array($arParams['WEB_FORM_ID'], $RESULT_ID),
											$arParams["EDIT_URL"]
										)
										.(strpos($arParams["EDIT_URL"], "?") === false ? "?" : "&")
										."formresult=".urlencode($arResult["FORM_RESULT"])
									);*/
								}
								else
								{
									print 44;
									/*LocalRedirect(
										$arParams["EDIT_URL"]
										.(strpos($arParams["EDIT_URL"], "?") === false ? "?" : "&")
										."WEB_FORM_ID=".$arParams["WEB_FORM_ID"]
										."&RESULT_ID=".$RESULT_ID
										."&formresult=".urlencode($arResult["FORM_RESULT"])
									);*/
								}
								die();
							}

							$arResult["return"] = true;
						}

						if (strlen($arParams["SUCCESS_URL"]) > 0)
						{
							if ($arParams['SEF_MODE'] == 'Y')
							{
								print 55;
								/*LocalRedirect(
									str_replace(
										array('#WEB_FORM_ID#', '#RESULT_ID#'),
										array($arParams['WEB_FORM_ID'], $RESULT_ID),
										$arParams["SUCCESS_URL"]
									)
									.(strpos($arParams["SUCCESS_URL"], "?") === false ? "?" : "&")
									."formresult=".urlencode($arResult["FORM_RESULT"])
								);*/
							}
							else
							{
								print 66;
								/*
								LocalRedirect(
									$arParams["SUCCESS_URL"]
									.(strpos($arParams["SUCCESS_URL"], "?") === false ? "?" : "&")
									."WEB_FORM_ID=".$arParams["WEB_FORM_ID"]
									."&RESULT_ID=".$RESULT_ID
									."&formresult=".urlencode($arResult["FORM_RESULT"])
								);
								*/
							}

							die();
						}
						elseif ($arParams["SEF_MODE"] == "Y")
						{
							print 77;
							/*
							LocalRedirect(
								$APPLICATION->GetCurPageParam(
									"formresult=".urlencode($arResult["FORM_RESULT"]),
									array('formresult', 'strFormNote', 'SEF_APPLICATION_CUR_PAGE_URL')
								)
							);
							*/

							die();
						}
						else
						{
							//print 88;
							/*print $APPLICATION->GetCurPageParam(
								"WEB_FORM_ID=".$arParams["WEB_FORM_ID"]
								."&RESULT_ID=".$RESULT_ID
								."&formresult=".urlencode($arResult["FORM_RESULT"]),
								array('formresult', 'strFormNote', 'WEB_FORM_ID', 'RESULT_ID')
							);*/
							$parmsUrl = "";
							$parmsUrl .= "WEB_FORM_ID=".$arParams["WEB_FORM_ID"];
							$parmsUrl .= "&RESULT_ID=".$RESULT_ID;
							$parmsUrl .= "&formresult=".urlencode($arResult["FORM_RESULT"]);

							$parmsUrlMd5 = md5($parmsUrl);
							$parmUrl = "?RESILT_SUSSES=".$parmsUrlMd5;

							$_SESSION[$solgo]["arResultOk"]["WEB_FORM_ID"] = $arParams["WEB_FORM_ID"];
							$_SESSION[$solgo]["arResultOk"]["RESULT_ID"] = $RESULT_ID;
							$_SESSION[$solgo]["arResultOk"]["formresult"] = urlencode($arResult["FORM_RESULT"]);
							LocalRedirect($parmUrl);
							/*LocalRedirect(
								$APPLICATION->GetCurPageParam(
									"WEB_FORM_ID=".$arParams["WEB_FORM_ID"]
									."&RESULT_ID=".$RESULT_ID
									."&formresult=".urlencode($arResult["FORM_RESULT"]),
									array('formresult', 'strFormNote', 'WEB_FORM_ID', 'RESULT_ID')
								)
							);*/

							die();
							//LocalRedirect($APPLICATION->GetCurPage()."?WEB_FORM_ID=".$arParams["WEB_FORM_ID"]."&strFormNote=".urlencode($arResult["FORM_NOTE"]));
						}
					}
					else
					{
						if ($arParams['USE_EXTENDED_ERRORS'] == 'Y')
							$arResult["FORM_ERRORS"] = array($GLOBALS["strError"]);
						else
							$arResult["FORM_ERRORS"] = $GLOBALS["strError"];
							/*ClassDebug::debug($arResult["FORM_ERRORS"]);
							ClassDebug::debug($_REQUEST);
							print $ariResult;*/

							if($ev == 1){ 
								//ClassDebug::debug($arResult["FORM_ERRORS"]);
							}

						/*$_SESSION[$solgo]["arResult"] = $arResult; $arResult = [];
						$data_error = "";
						foreach($arResult["FORM_ERRORS"] as $kerror=>$verror){
						$data_error .= $kerror;
						}
						$data_error_result = md5($data_error);*/
						//LocalRedirect("?ERROR={$data_error_result}");
				
					}
				}
			}
			else{
				/** 
				 * if error true
				*/
				$_SESSION[$solgo]["arResult"] = $arResult; $arResult = [];
				$data_error = "";
				foreach($arResult["FORM_ERRORS"] as $kerror=>$verror){
                    $data_error .= $kerror;
				}
				$data_error_result = md5($data_error);
                LocalRedirect("?ERROR={$data_error_result}");
			}
		}

		/*
		if (is_array($arResult["FORM_ERRORS"]))
		{
			$arResult["FORM_ERRORS"] = implode("<br />", $arResult["FORM_ERRORS"]);
		}
		*/

		//if (!empty($_REQUEST["strFormNote"])) $arResult["FORM_NOTE"] = $_REQUEST["strFormNote"];
		if (!empty($_REQUEST["formresult"]) && $_REQUEST['WEB_FORM_ID'] == $arParams['WEB_FORM_ID'])
		{
			$formResult = strtoupper($_REQUEST['formresult']);
			switch ($formResult)
			{
				case 'ADDOK':
					$arResult['FORM_NOTE'] = str_replace("#RESULT_ID#", $RESULT_ID, GetMessage('FORM_NOTE_ADDOK'));
			}
		}

		$arResult["isFormErrors"] =
			(
				$arParams['USE_EXTENDED_ERRORS'] == 'Y' && is_array($arResult["FORM_ERRORS"]) && count($arResult["FORM_ERRORS"]) > 0
				||
				$arParams['USE_EXTENDED_ERRORS'] != 'Y' && strlen($arResult["FORM_ERRORS"]) > 0
			)
			? "Y" : "N";

		// ************************************************************* //
		//                                             output                                                                    //
		// ************************************************************* //

		if ($arParams["IGNORE_CUSTOM_TEMPLATE"] == "N" && $arResult["arForm"]["USE_DEFAULT_TEMPLATE"] == "N" && strlen($arResult["arForm"]["FORM_TEMPLATE"]) > 0)
		{
			// use visual template
			if (!$bCache || $bCache && !$bVarsFromCache)
			{
				if ($bCache)
				{
					$obFormCache->StartDataCache();
					$GLOBALS['CACHE_MANAGER']->StartTagCache($CACHE_PATH);
					$GLOBALS['CACHE_MANAGER']->RegisterTag('forms');
					$GLOBALS['CACHE_MANAGER']->RegisterTag('form_'.$arParams['WEB_FORM_ID']);
				}

				// initialize template
				$FORM = new CFormOutput();

				$FORM->InitializeTemplate($arParams, $arResult);

				// cache image files paths
				$FORM->ShowFormImage();
				$FORM->getFormImagePath();

				if ($bCache)
				{
					$GLOBALS['CACHE_MANAGER']->EndTagCache();
					$obFormCache->EndDataCache(
						array(
							"arResult" => $arResult,
							"FORM" => $FORM,
						)
					);
				}
			}
			else
			{
				$FORM->strFormNote = $arResult['FORM_NOTE'];
				$FORM->isFormNote = (bool)$arResult['FORM_NOTE'];
			}

			// if form uses CAPCHA initialize it
			if ($arResult["arForm"]["USE_CAPTCHA"] == "Y") $FORM->CAPTCHACode = $arResult["CAPTCHACode"] = $APPLICATION->CaptchaGetCode();

			// get template
			if ($strReturn = $FORM->IncludeFormCustomTemplate())
			{
				// add icons
				$back_url = $_SERVER['REQUEST_URI'];

				$editor = "/bitrix/admin/fileman_file_edit.php?full_src=Y&site=".SITE_ID."&";
				$href = "javascript:window.location='".$editor."path=".urlencode($path)."&lang=".LANGUAGE_ID."&back_url=".urlencode($back_url)."'";

				if ($arParams['USE_EXTENDED_ERRORS'] == 'Y')
					$APPLICATION->SetAdditionalCSS($this->GetPath()."/error.css");

				// output template
				echo $strReturn;

				return;
			}
		}

		if ($arResult["arForm"]["USE_CAPTCHA"] == "Y") $arResult["CAPTCHACode"] = $APPLICATION->CaptchaGetCode();

		// define variables to assign
		$feedbackFizBiz = ($OptimalGroup['SITE']['CODE'] == "business") ? "feedback-biz" : "feedback-fiz";
		$arResult = array_merge(
			$arResult,
			array(
				"isFormNote"			=> strlen($arResult["FORM_NOTE"]) ? "Y" : "N", // flag "is there a form note"
				"isAccessFormParams"	=> $arResult["F_RIGHT"] >= 25 ? "Y" : "N", // flag "does current user have access to form params"
				"isStatisticIncluded"	=> CModule::IncludeModule('statistic') ? "Y" : "N", // flag "is statistic module included"

				"FORM_HEADER" => sprintf( // form header (<form> tag and hidden inputs)
					"<form name=\"%s\" action=\"%s\" method=\"%s\" enctype=\"multipart/form-data\" 
					       onsubmit=\"yaCounter{$OptimalGroup['BRANCH']['YA_COUNT_CODE']}.reachGoal('{$feedbackFizBiz}'); return true;\" >",
					$arResult["arForm"]["SID"], POST_FORM_ACTION_URI_ABS, "POST"
				).$res .= bitrix_sessid_post().'<input type="hidden" name="WEB_FORM_ID" value="'.$arParams['WEB_FORM_ID'].'" />',

				"FORM_TITLE"			=> trim(htmlspecialcharsbx($arResult["arForm"]["NAME"])), // form title

				"FORM_DESCRIPTION" => // form description
					$arResult["arForm"]["DESCRIPTION_TYPE"] == "html" ?
					trim($arResult["arForm"]["DESCRIPTION"]) :
					nl2br(htmlspecialcharsbx(trim($arResult["arForm"]["DESCRIPTION"]))),

				"isFormTitle"			=> strlen($arResult["arForm"]["NAME"]) > 0 ? "Y" : "N", // flag "does form have title"
				"isFormDescription"		=> strlen($arResult["arForm"]["DESCRIPTION"]) > 0 ? "Y" : "N", // flag "does form have description"
				"isFormImage"			=> intval($arResult["arForm"]["IMAGE_ID"]) > 0 ? "Y" : "N", // flag "does form have image"
				"isUseCaptcha"			=> $arResult["arForm"]["USE_CAPTCHA"] == "Y", // flag "does form use captcha"
				"DATE_FORMAT"			=> CLang::GetDateFormat("SHORT"), // current site date format
				"REQUIRED_SIGN"			=> CForm::ShowRequired("Y"), // "required" sign
				"FORM_FOOTER"			=> "</form>", // form footer (close <form> tag)
			)
		);

		/*
		if ($arResult["isFormNote"] == "Y")
		{
			ob_start();
			ShowMessage($arResult["FORM_NOTE"]);
			$arResult["FORM_NOTE"] = ob_get_contents();
			ob_end_clean();
		}
		*/

		// get template vars for form image
		if ($arResult["isFormImage"] == "Y")
		{
			$arResult["FORM_IMAGE"]["ID"] = $arResult["arForm"]["IMAGE_ID"];
			// assign form image url
			$arImage = CFile::GetFileArray($arResult["arForm"]["IMAGE_ID"]);
			$arResult["FORM_IMAGE"]["URL"] = $arImage["SRC"];

			// check image file existance and assign image data
			if (substr($arImage["SRC"], 0, 1) == "/")
			{
				$arSize = CFile::GetImageSize($_SERVER["DOCUMENT_ROOT"].$arImage["SRC"]);
				if (is_array($arSize))
				{
					list(
						$arResult["FORM_IMAGE"]["WIDTH"],
						$arResult["FORM_IMAGE"]["HEIGHT"],
						$arResult["FORM_IMAGE"]["TYPE"],
						$arResult["FORM_IMAGE"]["ATTR"]
					) = $arSize;
				}
			}
			else
			{
				$arResult["FORM_IMAGE"]["WIDTH"] = $arImage["WIDTH"];
				$arResult["FORM_IMAGE"]["HEIGHT"] = $arImage["HEIGHT"];
				$arResult["FORM_IMAGE"]["TYPE"] = false;
				$arResult["FORM_IMAGE"]["ATTR"] = false;
			}

			$arResult["FORM_IMAGE"]["HTML_CODE"] = CFile::ShowImage($arResult["arForm"]["IMAGE_ID"]);
		}

		$arResult["QUESTIONS"] = array();
		reset($arResult["arQuestions"]);

		// assign questions data
		foreach ($arResult["arQuestions"] as $key => $arQuestion)
		{
			$FIELD_SID = $arQuestion["SID"];
			$arResult["QUESTIONS"][$FIELD_SID] = array(
				"CAPTION" => // field caption
					$arResult["arQuestions"][$FIELD_SID]["TITLE_TYPE"] == "html" ?
					$arResult["arQuestions"][$FIELD_SID]["TITLE"] :
					nl2br(htmlspecialcharsbx($arResult["arQuestions"][$FIELD_SID]["TITLE"])),

				"IS_HTML_CAPTION"			=> $arResult["arQuestions"][$FIELD_SID]["TITLE_TYPE"] == "html" ? "Y" : "N",
				"REQUIRED"					=> $arResult["arQuestions"][$FIELD_SID]["REQUIRED"] == "Y" ? "Y" : "N",
				"IS_INPUT_CAPTION_IMAGE"	=> intval($arResult["arQuestions"][$FIELD_SID]["IMAGE_ID"]) > 0 ? "Y" : "N",
			);

			// ******************************** customize answers ***************************** //

			$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"] = array();

			if (is_array($arResult["arAnswers"][$FIELD_SID]))
			{
				$res = "";

				reset($arResult["arAnswers"][$FIELD_SID]);
				if (is_array($arResult["arDropDown"][$FIELD_SID])) reset($arResult["arDropDown"][$FIELD_SID]);
				if (is_array($arResult["arMutiselect"][$FIELD_SID])) reset($arResult["arMutiselect"][$FIELD_SID]);

				$show_dropdown = "N";
				$show_multiselect = "N";

				foreach ($arResult["arAnswers"][$FIELD_SID] as $key => $arAnswer)
				{
					if ($arAnswer["FIELD_TYPE"]=="dropdown" && $show_dropdown=="Y") continue;
					if ($arAnswer["FIELD_TYPE"]=="multiselect" && $show_multiselect=="Y") continue;

					$res = "";

					switch ($arAnswer["FIELD_TYPE"])
					{
						case "radio":
							if (strpos($arAnswer["FIELD_PARAM"], "id=") === false)
							{
								$ans_id = $arAnswer["ID"];
								$arAnswer["FIELD_PARAM"] .= " id=\"".$ans_id."\"";
							}
							else
							{
								$ans_id = "";
							}

							$value = CForm::GetRadioValue($FIELD_SID, $arAnswer, $arResult["arrVALUES"]);

							if ($arResult["isFormErrors"] == 'Y')
							{
								if (
									strpos(strtolower($arAnswer["FIELD_PARAM"]), "selected")!==false
									||
									strpos(strtolower($arAnswer["FIELD_PARAM"]), "checked")!==false)
									{
										$arAnswer["FIELD_PARAM"] = preg_replace("/checked|selected/i", "", $arAnswer["FIELD_PARAM"]);
									}
							}

							$input = CForm::GetRadioField(
								$FIELD_SID,
								$arAnswer["ID"],
								$value,
								$arAnswer["FIELD_PARAM"]);


							if (strlen($ans_id) > 0)
							{
								$res .= $input;
								$res .= "<label for=\"".$ans_id."\">".$arAnswer["MESSAGE"]."</label>";
							}
							else
							{
								$res .= "<label>".$input.$arAnswer["MESSAGE"]."</label>";
							}

							$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res;

							break;
						case "checkbox":
							if (strpos($arAnswer["FIELD_PARAM"], "id=") === false)
							{
								$ans_id = $arAnswer["ID"];
								$arAnswer["FIELD_PARAM"] .= " id=\"".$ans_id."\"";
							}
							else
							{
								$ans_id = "";
							}

							$value = CForm::GetCheckBoxValue($FIELD_SID, $arAnswer, $arResult["arrVALUES"]);

							if ($arResult['isFormErrors'] == 'Y')
							{
								if (
									strpos(strtolower($arAnswer["FIELD_PARAM"]), "selected")!==false
									||
									strpos(strtolower($arAnswer["FIELD_PARAM"]), "checked")!==false)
									{
										$arAnswer["FIELD_PARAM"] = preg_replace("/checked|selected/i", "", $arAnswer["FIELD_PARAM"]);
									}
							}

							$input = CForm::GetCheckBoxField(
								$FIELD_SID,
								$arAnswer["ID"],
								$value,
								$arAnswer["FIELD_PARAM"]);


							if (strlen($ans_id) > 0)
							{
								$res .= $input."<label for=\"".$ans_id."\">".$arAnswer["MESSAGE"]."</label>";
							}
							else
							{
								$res .= "<label>".$input.$arAnswer["MESSAGE"]."</label>";
							}

							$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res;

							break;
						case "dropdown":
							if ($show_dropdown!="Y")
							{
								$value = CForm::GetDropDownValue($FIELD_SID, $arResult["arDropDown"], $arResult["arrVALUES"]);

								if (strlen($arResult["FORM_ERROR"]) > 0)
								{
									$c = count($arDropDown[$FIELD_SID]["param"])-1;
									for ($i=0;$i<=$c;$i++)
									{
										$arDropDown[$FIELD_SID]["param"][$i] = preg_replace("/checked|selected/i", "", $arDropDown[$FIELD_SID]["param"][$i]);
									}
								}

								$res .= CForm::GetDropDownField(
									$FIELD_SID,
									$arResult["arDropDown"][$FIELD_SID],
									$value,
									$arAnswer["FIELD_PARAM"]);
								$show_dropdown = "Y";
							}

							$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res;

							break;
						case "multiselect":
							if ($show_multiselect!="Y")
							{
								$value = CForm::GetMultiSelectValue($FIELD_SID, $arResult["arMultiSelect"], $arResult["arrVALUES"]);

								if (strlen($arResult["FORM_ERROR"]) > 0)
								{
									$c = count($arResult["arMultiSelect"][$FIELD_SID]["param"])-1;
									for ($i=0;$i<=$c;$i++)
									{
										$arResult["arMultiSelect"][$FIELD_SID]["param"][$i] = preg_replace("/checked|selected/i", "", $arResult["arMultiSelect"][$FIELD_SID]["param"][$i]);
									}
								}

								$res .= CForm::GetMultiSelectField(
									$FIELD_SID,
									$arResult["arMultiSelect"][$FIELD_SID],
									$value,
									$arAnswer["FIELD_HEIGHT"],
									$arAnswer["FIELD_PARAM"]
								);

								$show_multiselect = "Y";
							}

							$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res;

							break;
						case "text":
							if (strlen(trim($arAnswer["MESSAGE"]))>0)
							{
								$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $arAnswer["MESSAGE"];
							}

							$value = CForm::GetTextValue($arAnswer["ID"], $arAnswer, $arResult["arrVALUES"]);
							$res .= CForm::GetTextField(
								$arAnswer["ID"],
								$value,
								$arAnswer["FIELD_WIDTH"],
								$arAnswer["FIELD_PARAM"]);

							$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res;

							break;

						case "hidden":

							$value = CForm::GetHiddenValue($arAnswer["ID"], $arAnswer, $arResult["arrVALUES"]);
							$res .= CForm::GetHiddenField(
								$arAnswer["ID"],
								$value,
								$arAnswer["FIELD_PARAM"]);

							$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res;

							break;

						case "password":
							if (strlen(trim($arAnswer["MESSAGE"]))>0)
							{
								$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $arAnswer["MESSAGE"];
							}

							$value = CForm::GetPasswordValue($arAnswer["ID"], $arAnswer, $arResult["arrVALUES"]);
							$res .= CForm::GetPasswordField(
								$arAnswer["ID"],
								$value,
								$arAnswer["FIELD_WIDTH"],
								$arAnswer["FIELD_PARAM"]);

							$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res;

							break;
						case "email":
							if (strlen(trim($arAnswer["MESSAGE"]))>0)
							{
								$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $arAnswer["MESSAGE"];
							}
							$value = CForm::GetEmailValue($arAnswer["ID"], $arAnswer, $arResult["arrVALUES"]);
							$res .= CForm::GetEmailField(
								$arAnswer["ID"],
								$value,
								$arAnswer["FIELD_WIDTH"],
								$arAnswer["FIELD_PARAM"]);

							$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res;

							break;
						case "url":
							if (strlen(trim($arAnswer["MESSAGE"]))>0)
							{
								$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $arAnswer["MESSAGE"];
							}
							$value = CForm::GetUrlValue($arAnswer["ID"], $arAnswer, $arResult["arrVALUES"]);
							$res .= CForm::GetUrlField(
								$arAnswer["ID"],
								$value,
								$arAnswer["FIELD_WIDTH"],
								$arAnswer["FIELD_PARAM"]);

							$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res;

							break;
						case "textarea":
							if (strlen(trim($arAnswer["MESSAGE"]))>0)
							{
								$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $arAnswer["MESSAGE"];
							}

							if (intval($arAnswer["FIELD_WIDTH"]) <= 0) $arAnswer["FIELD_WIDTH"] = "40";
							if (intval($arAnswer["FIELD_HEIGHT"]) <= 0) $arAnswer["FIELD_HEIGHT"] = "5";

							$value = CForm::GetTextAreaValue($arAnswer["ID"], $arAnswer, $arResult["arrVALUES"]);
							$res .= CForm::GetTextAreaField(
								$arAnswer["ID"],
								$arAnswer["FIELD_WIDTH"],
								$arAnswer["FIELD_HEIGHT"],
								$arAnswer["FIELD_PARAM"],
								$value
								);

							$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res;

							break;
						case "date":
							if (strlen(trim($arAnswer["MESSAGE"]))>0)
							{
								$res .= $arAnswer["MESSAGE"];
							}
							$value = CForm::GetDateValue($arAnswer["ID"], $arAnswer, $arResult["arrVALUES"]);
							$res .= CForm::GetDateField(
								$arAnswer["ID"],
								$arResult["arForm"]["SID"],
								$value,
								$arAnswer["FIELD_WIDTH"],
								$arAnswer["FIELD_PARAM"]);

							$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res." (".CSite::GetDateFormat("SHORT").")";

							break;
						case "image":
							if (strlen(trim($arAnswer["MESSAGE"]))>0)
							{
								$res .= $arAnswer["MESSAGE"];
							}
							$res .= CForm::GetFileField(
								$arAnswer["ID"],
								$arAnswer["FIELD_WIDTH"],
								"IMAGE",
								0,
								"",
								$arAnswer["FIELD_PARAM"]);

							$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res;

							break;
						case "file":
							if (strlen(trim($arAnswer["MESSAGE"]))>0)
							{
								$res .= $arAnswer["MESSAGE"];
							}
							$res .= CForm::GetFileField(
								$arAnswer["ID"],
								$arAnswer["FIELD_WIDTH"],
								"FILE",
								0,
								"",
								$arAnswer["FIELD_PARAM"]);

							$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res;

							break;
					} //endswitch;
				} //endwhile;


			} //endif(is_array($arAnswers[$FIELD_SID]));
			elseif (is_array($arResult["arQuestions"][$FIELD_SID]) && $arResult["arQuestions"][$FIELD_SID]["ADDITIONAL"] == "Y")
			{

				$res = "";

				switch ($arResult["arQuestions"][$FIELD_SID]["FIELD_TYPE"])
				{
					case "text":
						$value = CForm::GetTextAreaValue("ADDITIONAL_".$arResult["arQuestions"][$FIELD_SID]["ID"], array(), $arResult["arrVALUES"]);
						$res .= CForm::GetTextAreaField(
							"ADDITIONAL_".$arResult["arQuestions"][$FIELD_SID]["ID"],
							"60",
							"5",
							"",
							$value
							);

						$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res;

						break;
					case "integer":
						$value = CForm::GetTextValue("ADDITIONAL_".$arResult["arQuestions"][$FIELD_SID]["ID"], array(), $arResult["arrVALUES"]);
						$res .= CForm::GetTextField(
							"ADDITIONAL_".$arResult["arQuestions"][$FIELD_SID]["ID"],
							$value);

						$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res;

						break;
					case "date":
						$value = CForm::GetDateValue("ADDITIONAL_".$arResult["arQuestions"][$FIELD_SID]["ID"], array(), $arResult["arrVALUES"]);
						$res .= CForm::GetDateField(
							"ADDITIONAL_".$arResult["arQuestions"][$FIELD_SID]["ID"],
							$arResult["arForm"]["SID"],
							$value);

						$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"][] = $res." (".CSite::GetDateFormat("SHORT").")";

						break;
				} //endswitch;
			}

			$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"] = implode("<br />", $arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"]);

			// ******************************************************************************* //

			if ($arResult["QUESTIONS"][$FIELD_SID]["IS_INPUT_CAPTION_IMAGE"] == "Y")
			{
				$arResult["QUESTIONS"][$FIELD_SID]["IMAGE"]["ID"] = $arResult["arQuestions"][$FIELD_SID]["IMAGE_ID"];
				// assign field image path
				$arImage = CFile::GetFileArray($arResult["QUESTIONS"][$FIELD_SID]["IMAGE"]["ID"]);
				$arResult["QUESTIONS"][$FIELD_SID]["IMAGE"]["URL"] = $arImage["SRC"];

				// check image file existance and assign image data
				if (substr($arImage["SRC"], 0, 1) == "/")
				{
					$arSize = CFile::GetImageSize($_SERVER["DOCUMENT_ROOT"].$arImage["SRC"]);
					if (is_array($arSize))
					{
						list(
							$arResult["QUESTIONS"][$FIELD_SID]["IMAGE"]["WIDTH"],
							$arResult["QUESTIONS"][$FIELD_SID]["IMAGE"]["HEIGHT"],
							$arResult["QUESTIONS"][$FIELD_SID]["IMAGE"]["TYPE"],
							$arResult["QUESTIONS"][$FIELD_SID]["IMAGE"]["ATTR"]
						) = $arSize;
					}
				}
				else
				{
					$arResult["QUESTIONS"][$FIELD_SID]["IMAGE"]["WIDTH"] = $arImage["WIDTH"];
					$arResult["QUESTIONS"][$FIELD_SID]["IMAGE"]["HEIGHT"] = $arImage["HEIGHT"];
					$arResult["QUESTIONS"][$FIELD_SID]["IMAGE"]["TYPE"] = false;
					$arResult["QUESTIONS"][$FIELD_SID]["IMAGE"]["ATTR"] = false;
				}

				$arResult["QUESTIONS"][$FIELD_SID]["IMAGE"]["HTML_CODE"] = CFile::ShowImage($arResult["arQuestions"][$FIELD_SID]["IMAGE_ID"]);
			}

			// get answers raw structure
			$arResult["QUESTIONS"][$FIELD_SID]["STRUCTURE"] = $arResult["arAnswers"][$FIELD_SID];

			// nullify value
			$arResult["QUESTIONS"][$FIELD_SID]["VALUE"] = "";
		}

		// compability:

		if ($arResult["isFormErrors"] == "Y")
		{
			ob_start();
			if ($arParams['USE_EXTENDED_ERRORS'] == 'N')
				ShowError($arResult["FORM_ERRORS"]);
			else
				ShowError(implode('<br />', $arResult["FORM_ERRORS"]));

			$arResult["FORM_ERRORS_TEXT"] = ob_get_contents();
			ob_end_clean();
		}

		$arResult["SUBMIT_BUTTON"] = "<input ".(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "")." type=\"submit\" name=\"web_form_submit\" value=\"".(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"])."\" />";
		$arResult["APPLY_BUTTON"] = "<input type=\"hidden\" name=\"web_form_apply\" value=\"Y\" /><input type=\"submit\" name=\"web_form_apply\" value=\"".GetMessage("FORM_APPLY")."\" />";
		$arResult["RESET_BUTTON"] = "<input type=\"reset\" value=\"".GetMessage("FORM_RESET")."\" />";
		$arResult["REQUIRED_STAR"] = $arResult["REQUIRED_SIGN"];
		$arResult["CAPTCHA_IMAGE"] = "<input type=\"hidden\" name=\"captcha_sid\" value=\"".htmlspecialcharsbx($arResult["CAPTCHACode"])."\" /><img src=\"/bitrix/tools/captcha.php?captcha_sid=".htmlspecialcharsbx($arResult["CAPTCHACode"])."\" width=\"180\" height=\"40\" />";
		$arResult["CAPTCHA_FIELD"] = "<input type=\"text\" name=\"captcha_word\" size=\"30\" maxlength=\"50\" value=\"\" class=\"inputtext\" />";
		$arResult["CAPTCHA"] = $arResult["CAPTCHA_IMAGE"]."<br />".$arResult["CAPTCHA_FIELD"];

		// include default template
		$this->IncludeComponentTemplate();
	}
	else
	{
		ShowError(GetMessage($arResult["ERROR"]));
	}
}
else
{
	echo ShowError(GetMessage("FORM_MODULE_NOT_INSTALLED"));
}
?>
<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

//получние $_REQUEST в массив
$json = new stdClass();
foreach ($_REQUEST as $key => $val) {
	$key_split = explode('_', $key);
	if ($key_split[1] == "checkbox") {
		if ($key_split[0] === 'form') {
			$arInfo[$key_split[4]] = array('VALUE' => $val, 'KEY' => $key);
		}
	} else
		if ($key_split[1] == "multiselect") {
			if ($key_split[0] === 'form') {
				$arInfo[$key_split[4]] = array('VALUE' => $val, 'KEY' => $key);
			}
		} else
			if ($key_split[1] == "radio") {
				if ($key_split[0] === 'form') {
					$arInfo[$key_split[4]] = array('VALUE' => $val, 'KEY' => $key);
				}
			} else {
				if ($key_split[0] === 'form' && intval($key_split[2]) > 0) {
					$arInfo[$key_split[2]] = array('VALUE' => $val, 'KEY' => $key);
				}
			}
}

CModule::IncludeModule('form');
$formId = $_REQUEST['WEB_FORM_ID'];
$ff = CForm::GetByID($formId)->Fetch();

$rsQuestions = CFormField::GetList($formId, "ALL", $by="s_id", $order="desc", array(), $is_filtered=false);
$arFields = array(
	'RS_FORM_ID' => $formId,
	'RS_FORM_NAME' => $ff["NAME"],
);

//для загрузки файла
if (!empty($_FILES)) {
	foreach ($_FILES as $key => $file) {
		$key_split = explode('_', $key);
		if ($key_split[0] === 'form') {
			$arInfo[$key_split[2]] = array('VALUE' => $file["name"], 'KEY' => $key);
		}
		$file_tmp = CFile::MakeFileArray($file["tmp_name"],$file["type"]);
		$file_tmp["name"] = $file["name"];
		$arFields["FILE"] = $file["name"];
	}
}

//проверка на пустоту полей
$arValues = array();
while ($arQuestion = $rsQuestions->Fetch()) {
	$fff = CFormAnswer::GetList($arQuestion['ID'], $by="s_id", $order="desc", array(), $is_filtered=false);
	while ($arAnswer = $fff->Fetch()) {
		if ($arQuestion['REQUIRED'] == 'Y') {
			if ($arAnswer["FIELD_TYPE"] != "checkbox" && $arAnswer["FIELD_TYPE"] != "multiselect") {
				if ($arInfo[$arAnswer['ID']]['VALUE'] == '') {
					$json->errors[] = (LANGUAGE_ID == "ru" ? "Заполните поле" : "Fill in the field" ) . ' "' . $arQuestion['COMMENTS'] . '"<br \>';
				}
			}
		}
		if ($arAnswer["FIELD_TYPE"] == "checkbox") {
			preg_match("/\d.*/", $arQuestion["VARNAME"],$id);
			$arFields[$arQuestion['VARNAME']] = "";
			foreach ($arInfo[$id[0]]["VALUE"] as $val) {
				$arFields[$arQuestion['VARNAME']] .= $arAnswer["MESSAGE"].", ";
			}
		} else
			if ($arAnswer["FIELD_TYPE"] == "multiselect") {
				preg_match("/\d.*/", $arQuestion["VARNAME"],$id);
				if ($arInfo[$id[0]]["VALUE"][0] == $arAnswer["ID"]) {
					$arFields[$arQuestion['VARNAME']] = $arAnswer["ID"];
					$arFields[$arQuestion['VARNAME'] . "_TEXT"] = $arAnswer["MESSAGE"];
				}
			} else
				if ($arAnswer["FIELD_TYPE"] == "radio") {
					preg_match("/\d.*/", $arQuestion["VARNAME"],$id);
					if ($arInfo[$id[0]]["VALUE"] == $arAnswer["ID"]) {
						$arFields[$arQuestion['VARNAME']] = $arAnswer["MESSAGE"];
					}
				} else {
					$arFields[$arQuestion['VARNAME']] = $arInfo[$arAnswer['ID']]['VALUE'];
				}
	}
}
foreach ($_REQUEST as $k => $v){
    if($k == 'site_section' || $k == 'bxajaxid' || $k == 'AJAX_CALL' || $k == 'sessid' || $k == 'WEB_FORM_ID') {
       unset($_REQUEST[$k]);
    }
}
//отправка письма и др.
if (count($json->errors) <= 0) {
	$check = CForm::Check($formId,false,false,"Y","Y");
	if (!empty($check)) {
		foreach ($check as $error) {
			$json->errors[] = $error;
		}
	} else {
        global $strError;
        unset($strError);
		if ($RESULT_ID = CFormResult::Add($formId, $_REQUEST)) {
			$json->id = $RESULT_ID;
			$json->success = TRUE;

			$arFields['RS_RESULT_ID'] = $RESULT_ID;
			$arFields["URL"] = $_REQUEST["url"];
			$arFields["TITLE"] = $_REQUEST["title"];
			CEvent::Send("FORM_FILLING_SIMPLE_FORM_" . $formId, $_REQUEST["site_id"], $arFields, "", array(),array(), $_REQUEST["lang"]);

		}
		else {
            $json->errors[] = $strError;
        }
	}
}
echo json_encode($json);

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");

<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\DGAPI;
use DorrBitt\ParseType\ParseType;
use DorrBitt\DBXLS\DBXLS;
use DorrBitt\dbapi\BElements;
use DorrBitt\dbapi\ClassDBase;
$oElement = new \CIBlockElement();
$IBLOCK_ID = 55;
$user_ses = DGAPI::ses();
$objClassDBase = new ClassDBase();
$table = "b_iblock_element_prop_s55";


try {
    if(empty($_SESSION["start_last"])){
        $_SESSION["start_last"]["{$user_ses}"]["start"] = $_REQUEST["last"]+1;
        $_SESSION["start_last"]["{$user_ses}"]["last"]  = $_SESSION["start_last"]["{$user_ses}"]["start"]+1;
        $start = $_SESSION["start_last"]["{$user_ses}"]["start"]; 
        $last = $_SESSION["start_last"]["{$user_ses}"]["last"];
    }
    else{
        $_SESSION["start_last"]["{$user_ses}"]["start"] = $_SESSION["start_last"]["{$user_ses}"]["last"]+1;
        $_SESSION["start_last"]["{$user_ses}"]["last"]  = $_SESSION["start_last"]["{$user_ses}"]["start"]+1;
        $start = $_SESSION["start_last"]["{$user_ses}"]["start"]; 
        $last = $_SESSION["start_last"]["{$user_ses}"]["last"];
    }
    /*ClassDebug::debug($_REQUEST);
    ClassDebug::debug($_SESSION["start_last"]);
    ClassDebug::debug($start);
    ClassDebug::debug($last);*/

    $idfile = ($_REQUEST["idfile"] > 0) ? $_REQUEST["idfile"] : "";

    if($_REQUEST["unload"] == "a6105c0a611b41b08f1209506350279e"){
        //$result = DBXLS::parseExcelFileSimpleXls($_REQUEST["src"]);
        $result = $_SESSION["start_last"]["{$user_ses}"]["result"];
        //ClassDebug::debug($result);
        $opera = [];
        for($r = $start; $r <= $last; $r++){
            if(count($result[$r]) > 0){
                $opera[] = $r;
                /*$NLS_ID = str_replace("*","",$result[$r][0]);
                $ZAV_NOM = str_replace("*","",$result[$r][1]);
                $PONUMBER = str_replace("*","",$result[$r][2]);*/
                $NLS_ID = $result[$r][0];
                $ZAV_NOM = $result[$r][1];
                $PONUMBER = $result[$r][2];
                $NLS_ID2 = str_replace("*","",$result[$r][0]);
                $ZAV_NOM2 = str_replace("*","",$result[$r][1]);
                $PONUMBER2 = str_replace("*","",$result[$r][2]);
                $XML_ID = $NLS_ID2."-".$ZAV_NOM2;
    
                $xmldata = [
                    "IBLOCK_ID"=>$IBLOCK_ID,
                    "XML_ID"=>$XML_ID,
                    "select"=>["NAME","ID","XML_ID","ACTIVE","ACTIVE_FROM","IBLOCK_SECTION_ID","CODE"],
                    "SORT"=>"",
                ];
                $dataXmlID = BElements::elementXMLID($xmldata);
                $dataXmlIDLen = count($dataXmlID);
                //print("<div>dataXmlIDLen {$dataXmlIDLen}</div>");
    
                if($dataXmlIDLen > 0){
    
                    $arrUpdateArray = Array(
                        "MODIFIED_BY"    => $_SESSION["SESS_AUTH"]["USER_ID"], 
                        "PROPERTY_VALUES"=> $PROP,
                        "NAME"           => $dataXmlID[0]["NAME"],
                        "ACTIVE"         => "Y",
                        "ACTIVE_FROM"   => $dataXmlID[0]["ACTIVE_FROM"],
                        "CODE"=>"",
                        );
                    $res = $oElement->Update($dataXmlID[0]["ID"], $arrUpdateArray);

                    $m = date('m');
                    $Y = date('Y');
                    if($m % 2 == 0){
                        $d = 31;
                    }
                    else{
                        $d = 30;
                    }
                    $tdata = "{$d}.{$m}.{$Y}";

                    $res = $objClassDBase->initUpdate(
                        $table,
                        [
                          ["{$table}.PROPERTY_1149","=",$NLS_ID],
                          ["{$table}.PROPERTY_1150","=",$ZAV_NOM],
                          ["{$table}.PROPERTY_1151","=",$PONUMBER],
                          ["{$table}.PROPERTY_1152","=",$tdata],
                          ["{$table}.PROPERTY_1153","=",""],
                          ["{$table}.PROPERTY_1154","=",$idfile],
                        ]
                        ,
                        [
                          ["{$table}.IBLOCK_ELEMENT_ID","=",$res]
                        ]
                      );
    
                    /*if(!empty($NLS_ID)){
                        \CIBlockElement::SetPropertyValueCode($dataXmlID[0]["ID"], "NLS_ID", $NLS_ID);
                    }
                    if(!empty($ZAV_NOM)){
                        \CIBlockElement::SetPropertyValueCode($dataXmlID[0]["ID"], "ZAV_NOM", $ZAV_NOM);
                    }
                    if(!empty($PONUMBER)){
                       \CIBlockElement::SetPropertyValueCode($dataXmlID[0]["ID"], "SHOV_LAST", $PONUMBER);
                    }
                    \CIBlockElement::SetPropertyValueCode($dataXmlID[0]["ID"], "SHOV_LAST_ADD", "");
                    if(!empty($idfile)){
                        \CIBlockElement::SetPropertyValueCode($dataXmlID[0]["ID"], "IDFILE", $idfile);
                     }
                    $m = date('m');
                    $Y = date('Y');
                    if($m % 2 == 0){
                        $d = 31;
                    }
                    else{
                        $d = 30;
                    }
                    $tdata = "{$d}.{$m}.{$Y}";
                    \CIBlockElement::SetPropertyValueCode($dataXmlID[0]["ID"], "DATA_M", $tdata);*/
                }
                else{
                    $arFields = array(
                        "ACTIVE" => "Y", 
                        "IBLOCK_ID" => $IBLOCK_ID,
                        "ACTIVE_FROM"   => date('d.m.Y H:i:s'),
                        "NAME" => $NLS_ID2."-".$ZAV_NOM2,
                        "CODE" => $NLS_ID2."-".$ZAV_NOM2,
                        "XML_ID"=> $XML_ID,
                    );
                    
                    if($res = $oElement->Add($arFields, false, false, true)){
                        $m = date('m');
                    $Y = date('Y');
                    if($m % 2 == 0){
                        $d = 31;
                    }
                    else{
                        $d = 30;
                    }
                    $tdata = "{$d}.{$m}.{$Y}";

                    $res = $objClassDBase->initUpdate(
                        $table,
                        [
                          ["{$table}.PROPERTY_1149","=",$NLS_ID],
                          ["{$table}.PROPERTY_1150","=",$ZAV_NOM],
                          ["{$table}.PROPERTY_1151","=",$PONUMBER],
                          ["{$table}.PROPERTY_1152","=",$tdata],
                          ["{$table}.PROPERTY_1153","=",""],
                          ["{$table}.PROPERTY_1154","=",$idfile],
                        ]
                        ,
                        [
                          ["{$table}.IBLOCK_ELEMENT_ID","=",$res]
                        ]
                      );

                        /*
                        if(!empty($NLS_ID)){
                            \CIBlockElement::SetPropertyValueCode($res, "NLS_ID", $NLS_ID);
                        }
                        if(!empty($ZAV_NOM)){
                            \CIBlockElement::SetPropertyValueCode($res, "ZAV_NOM", $ZAV_NOM);
                        }
                        if(!empty($PONUMBER)){
                           \CIBlockElement::SetPropertyValueCode($res, "SHOV_LAST", $PONUMBER);
                        }
                        if(!empty($idfile)){
                            \CIBlockElement::SetPropertyValueCode($res, "IDFILE", $idfile);
                         }
                        $m = date('m');
                        $Y = date('Y');
                        if($m % 2 == 0){
                            $d = 31;
                        }
                        else{
                            $d = 30;
                        }
                        $tdata = "{$d}.{$m}.{$Y}";
                        \CIBlockElement::SetPropertyValueCode($res, "DATA_M", $tdata);
                        */
                    }
                }
                //print($NLS_ID."-".$ZAV_NOM);
                //print $res;
            }
           //ClassDebug::debug($result[$r]);
        }
        //ClassDebug::debug($opera);
        if(count($opera) > 0 && !empty($opera[1])){
            $urlRed = $_REQUEST["baseUrl"]."?DPHPSESSID=".$_REQUEST["dphpsession"];
            $len = count($opera)-1;
            $data_uv = $opera[$len];
            $uv = $data_uv-1;
            print("<div class=\"unloadVY\" >");
            //print("<div style=\"color:#444; font-size:14px; padding:5px 0 5px 0;\">Выгружено строк: {$uv}. Всего строк: {$_REQUEST["result_len"]}</div>");
            $_SESSION["start_last"]["{$user_ses}"]["len"] = $uv;
            $tvp = $uv/$_REQUEST["result_len"];
            $tvpI = round($tvp, 2);
            $width = 600;
            $tvpI100 = $tvpI*100;
            $width_res = $width*$tvpI;
            print("<div class=\"message\" >");
            print("Подождите пожауйста. Идёт выгрузка данных из файла( {$tvpI100}% ). Выгружено строк: {$uv}. Всего строк: {$_REQUEST["result_len"]}.");
            print("</div>");
            //print("<div style=\"border:1px solid #696969; height:30px; background:#d7d7d7; width:{$width_res}px\"></div>");
            print("<progress value=\"{$width_res}\" max=\"600\" >{$tvpI100}%</progress>");
            print("</div>");
        }
        else{
            //print("<div>{$_SESSION["start_last"]["{$user_ses}"]["len"]} == ".count($result)."</div>");
            if($_SESSION["start_last"]["{$user_ses}"]["len"] < count($result)){
                $_SESSION["start_last"]["{$user_ses}"]["len"] = count($result);
            }
            //print("<div>{$_SESSION["start_last"]["{$user_ses}"]["len"]} == ".count($result)."</div>");
            http_response_code(404);
            $urlResult = "";
            $urlResult = $_REQUEST["baseUrl"]."?DPHPSESSID=".$_REQUEST["dphpsession"];
            $urlResult .= "&rUnloading={$_REQUEST["unload"]}";
            $urlResult .= "&idfile={$idfile}";
            $urlResult .= "&clear=1";
            print $urlResult;
            print("<div class=\"unloadVYResultMessage\" >Считывание данных файла и их обработка прошла успешна - 
                   <a href=\"{$urlResult}\" >Очистить стэш выгрузки.</a></div>");
        }
    }
} catch (Exception $e) {
    echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}


?>
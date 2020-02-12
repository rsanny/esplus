<?php 
namespace DorrBitt\ASUFHD1C;
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\DBCFILES;
use DorrBitt\dbapi\BSectionsResultCode;
use DorrBitt\dbapi\BSectionsResult;
use DorrBitt\dbapi\BElements;

class ASUFHD1C {

    public static function pathFolder(){
        return $_SERVER["DOCUMENT_ROOT"]."/upload/1c_asufhd/";
    }

    public static function jsonDecode($strlson){
        return  json_decode($strlson);
    }

    public static function jsonEncode($strlson){
        return  json_encode($strlson);
    }

    public static function nameFolder(){
        $dirDate = date("Y-m-d");
        $dirDataTime = date("Y-m-d H:m:s");
        $dirDataTimeR = str_replace(" ","-",$dirDataTime); 
        $dirDataTimeRS = str_replace(":","-",$dirDataTimeR);
        return [
            "dir" => $dirDate,
            "namefile" => $dirDataTimeRS,
        ];
    }

    public static function dataDirFilesRm($pt){
        if($pt["file"] == "file"){
            $pathfile = "{$pt["path"]}{$pt["basename"]}";
            if(is_file($pathfile)){
                unlink($pathfile);
            }
        }
        elseif($pt["file"] == "dir"){
            $pathfile = "{$pt["path"]}{$pt["basename"]}";
            if(is_dir($pathfile)){
                rmdir($pathfile);
            }
        }
    }

    public static function soda($pat){
        $dirsfiles = glob("{$pat}*");
        $tdata = $folder = self::nameFolder()["dir"];
        $arrDIRF = [];
        foreach($dirsfiles as $df){
            if(is_dir($df)){
                $arrDIRF["dirs"][] = $df; 
            }
            elseif(is_file($df)){
                $arrDIRF["files"][] = $df; 
            }
        }
        if(is_array($arrDIRF["files"]) && !empty($arrDIRF["files"]) && count($arrDIRF["files"]) > 0){
            array_map('unlink', $arrDIRF["files"]);
        }
        if(is_array($arrDIRF["dirs"]) && !empty($arrDIRF["dirs"]) && count($arrDIRF["dirs"]) > 0){
            foreach($arrDIRF["dirs"] as $dpathdir){
                $datafolder = end(explode("/",$dpathdir));
                if($datafolder == $tdata){}
                else{ //print $datafolder. " == ". $tdata;
                    $files = glob("{$dpathdir}/*");
                    foreach($files as $file){
                        $basename = basename($file);
                        $path = dirname($file)."/";
                        self::dataDirFilesRm([
                            "file"=>"file",
                            "basename"=>$basename,
                            "path"=>$path,
                        ]);
                        }
                        $basename = basename($dpathdir);
                        $path = dirname($dpathdir)."/";
                    self::dataDirFilesRm([
                        "file"=>"dir",
                        "basename"=>$basename,
                        "path"=>$path,
                    ]);
                    }
                }
        }
        return true;
    }

    public static function saveFileVygruzka($sodaFile){
        $koren = self::pathFolder();
        $folder = self::nameFolder();
        $resultPath = "{$koren}{$folder["dir"]}/"; 
        if ( !is_dir( $resultPath ) ) {
            mkdir( $resultPath, 0755 );       
        }
        return self::filePutCont($resultPath."asufhd-".$folder["namefile"].".json",$sodaFile);
    }

    public static function saveFileGet($sodaFile){
        $koren = self::pathFolder();
        $folder = self::nameFolder();
        $resultPath = "{$koren}{$folder["dir"]}/"; 
        if ( !is_dir( $resultPath ) ) {
            mkdir( $resultPath, 0755 );       
        }
        return self::filePutCont($resultPath."asufhd-".$folder["namefile"]."get.txt",$sodaFile);
    }

    public static function saveFilePost($sodaFile){
        $koren = self::pathFolder();
        $folder = self::nameFolder();
        $resultPath = "{$koren}{$folder["dir"]}/"; 
        if ( !is_dir( $resultPath ) ) {
            mkdir( $resultPath, 0755 );       
        }
        return self::filePutCont($resultPath."asufhd-".$folder["namefile"]."post.txt",$sodaFile);
    }

    public static function filePutCont($pathFile,$strcode){
        return  file_put_contents($pathFile,$strcode);
    }

    public static function arrayData($arr){
        self::saveFileVygruzka($arr);
        $arrJson = self::jsonDecode($arr);

        if(is_array($arrJson) && !empty($arrJson)){ 
            $resultArrJson = []; $iter = 0;
            foreach($arrJson as $arrJsonData){
                $iter++;
                $datajsonIDXML = $arrJsonData->{"Идентификатор"};
                $datajsonPDOG = $arrJsonData->{"ПредметДоговора"};
                
                $datajsonBinBase64FileArr = $arrJsonData->{"ЗакупочнаяДокументация"};
                if(is_array($datajsonBinBase64FileArr) && !empty($datajsonBinBase64FileArr) && count($datajsonBinBase64FileArr) > 0){
                    foreach($datajsonBinBase64FileArr as $datajsonBinBase64FileData){
                        //ClassDebug::debug($datajsonBinBase64FileData);
                        $datajsonBinBase64File = $datajsonBinBase64FileData->{"ЗакупочнаяДокументацияДвоичныеДанные"};
                        $dataBinBase64File     = str_replace(" ","+",$datajsonBinBase64File);
                        $datajsonBinBase64FileData->{"ЗакупочнаяДокументацияДвоичныеДанные"} = $dataBinBase64File;
                        $datajsonNameFile      = $datajsonBinBase64FileData->{"ЗакупочнаяДокументацияИмяФайла"};
                    }
                }
                /*$datajsonBinBase64File = $arrJsonData->{"ЗакупочнаяДокументацияДвоичныеДанные"};
                
                $dataBinBase64File = str_replace(" ","+",$datajsonBinBase64File);
                $datajsonNameFile      = $arrJsonData->{"ЗакупочнаяДокументацияИмяФайла"};*/

                $datajsonBinBase64FileProtokol = $arrJsonData->{"ПротоколДвоичныеДанные"};
                
                $dataBinBase64FileProtokol     = str_replace(" ","+",$datajsonBinBase64FileProtokol);
                $datajsonNameFileProtokol      = $arrJsonData->{"ПротоколДвоичныеДанные"};

                if(!empty($datajsonPDOG) && !empty($datajsonIDXML)){
                    $datajsonID = $arrJsonData->{"Идентификатор"};
                    $resultArrJson[$datajsonID] = $arrJsonData;
                    //$arrJsonData->{"ЗакупочнаяДокументацияДвоичныеДанные"} = $dataBinBase64File;
                    $arrJsonData->{"ПротоколДвоичныеДанные"} = $dataBinBase64FileProtokol;
                }
                /*elseif(!empty($datajsonPDOG) && !empty($datajsonIDXML)){
                    $datajsonID = $arrJsonData->{"Идентификатор"};
                    $resultArrJson[$datajsonID] = $arrJsonData;
                    $arrJsonData->{"ЗакупочнаяДокументацияДвоичныеДанные"} = $dataBinBase64File;
                    $arrJsonData->{"ПротоколДвоичныеДанные"} = $dataBinBase64FileProtokol;
                }*/
            }
        }
        return $resultArrJson;
    }

    public static function listAdd($arr){
        if(is_array($arr) && !empty($arr)){ 
            $resultAdd = [];
            foreach($arr as $key=>$arrValue){
                $iter++;
                $dataBinBase64FileArr = $arrValue->{"ЗакупочнаяДокументация"};
                if(is_array($dataBinBase64FileArr) && !empty($dataBinBase64FileArr) && count($dataBinBase64FileArr) > 0){
                    $fileSaveArr = [];
                    foreach($dataBinBase64FileArr as $datajsonBinBase64FileData){
                        $dataBinBase64File = $datajsonBinBase64FileData->{"ЗакупочнаяДокументацияДвоичныеДанные"};
                        $dataNameFile      = $datajsonBinBase64FileData->{"ЗакупочнаяДокументацияИмяФайла"};
                        if(!empty($dataNameFile)){
                            $datajsonNameFileExp = explode(".",$dataNameFile);
                            $outputFile = md5(trim($datajsonNameFileExp[0])).".".$datajsonNameFileExp[1];
                        }
                        else{
                            $datajsonNameFileExp[0] = "data-{$iter}"; $datajsonNameFileExp[1] = "docx";
                            $outputFile = md5(trim($datajsonNameFileExp[0])).".".$datajsonNameFileExp[1];
                        }
                        if(!empty($dataBinBase64File)){
                            $strbin = base64_decode($dataBinBase64File);
                            $pathFile = self::pathFolder()."{$outputFile}";
                            self::filePutCont($pathFile,$strbin);
                            $file = DBCFILES::makefilearray($pathFile);
                            $file["MODULE_ID"] = "iblock";
                            $file["del"] = "Y";
                            $fileSaveArr[] = DBCFILES::savefile($file,'iblock');
                        }
                        else{
                            $fileSave = "";
                        }
                    }
                }
                //$dataBinBase64File = $arrValue->{"ЗакупочнаяДокументацияДвоичныеДанные"};
                //$dataNameFile      = $arrValue->{"ЗакупочнаяДокументацияИмяФайла"};

                $datajsonBinBase64FileProtokol = $arrValue->{"ПротоколДвоичныеДанные"};
                $dataNameFileProtokol          = $arrValue->{"ПротоколИмяФайла"};

                $dataName          = $arrValue->{"ПредметДоговора"};
                $dataTime          = $arrValue->{"ДатаОфициальногоОбъявленияЗакупки"};
                $dataTimeResult    = date('d.m.Y', strtotime($dataTime));
                $dataPrefix        = $arrValue->{"Префикс"};
                $dataXMLID         = $arrValue->{"Идентификатор"};
                $dataSP            = $arrValue->{"СпособПубликации"};

                /*
                if(!empty($datajsonNameFile)){
                    $datajsonNameFileExp = explode(".",$datajsonNameFile);
                    $outputFile = md5(trim($datajsonNameFileExp[0])).".".$datajsonNameFileExp[1];
                }
                else{
                    $datajsonNameFileExp[0] = "data-{$iter}"; $datajsonNameFileExp[1] = "docx";
                    $outputFile = md5(trim($datajsonNameFileExp[0])).".".$datajsonNameFileExp[1];
                }
               if(!empty($dataBinBase64File)){
                    $strbin = base64_decode($dataBinBase64File);
                    $pathFile = self::pathFolder()."{$outputFile}";
                    self::filePutCont($pathFile,$strbin);
                    $file = DBCFILES::makefilearray($pathFile);
                    $file["MODULE_ID"] = "iblock";
                    $file["del"] = "Y";
                    $fileSave = DBCFILES::savefile($file,'iblock');
                }
                else{
                    $fileSave = "";
                }*/

                if(!empty($dataNameFileProtokol)){
                    $dataNameFileProtokolExp = explode(".",$dataNameFileProtokol);
                    $outputProtokolFile = md5(trim($dataNameFileProtokolExp[0])).".".$dataNameFileProtokolExp[1];
                }
                else{
                    $dataNameFileProtokolExp[0] = "data-protokol-{$iter}"; $dataNameFileProtokolExp[1] = "docx";
                    $outputProtokolFile = md5(trim($dataNameFileProtokolExp[0])).".".$dataNameFileProtokolExp[1];
                }
                if(!empty($datajsonBinBase64FileProtokol)){
                    $strbinpro = base64_decode($datajsonBinBase64FileProtokol);
                    $pathFilepro = self::pathFolder()."{$outputProtokolFile}";
                    self::filePutCont($pathFilepro,$strbinpro);
                    $filepro = DBCFILES::makefilearray($pathFilepro);
                    $filepro["MODULE_ID"] = "iblock";
                    $filepro["del"] = "Y";
                    $fileSavePro = DBCFILES::savefile($filepro,'iblock');
                }
                else{
                    $fileSavePro = "";
                }
                //$fileSavePro = $fileSave;
                $forRubricCode = date("Y"); 
                $IBLOCK_ID = 23;
                $arFilter = ["IBLOCK_ID" => $IBLOCK_ID, "NAME" => $forRubricCode, "SITE_ID" => SITE_ID];
                $order    = [];
                $fields   = ["NAME","ID"]; 
                $arrSectionCode = BSectionsResultCode::section_code($order, $arFilter, $fields);
                $IDBS = $arrSectionCode["ID"];
                if($IDBS <=0 || empty($IDBS)){
                    $objBS = new \CIBlockSection;
                    $arFields = Array(
                    "MODIFIED_BY"      => $_SESSION["SESS_AUTH"]["USER_ID"],
                    "ACTIVE"       => "Y",
                    "IBLOCK_ID"       => $IBLOCK_ID,
                    "NAME"          => $forRubricCode,
                    "SORT"          => "500",
                    "DESCRIPTION_TYPE"    => "text" 
                    ); 
                    $IDBS = $objBS->Add($arFields);
                }
                
                $oElement = new \CIBlockElement();
                $xmldata = [
                    "IBLOCK_ID"=>$IBLOCK_ID,
                    "XML_ID"=>$dataXMLID,
                    "select"=>["NAME","ID","XML_ID","ACTIVE","ACTIVE_FROM","IBLOCK_SECTION_ID","CODE"],
                    "SORT"=>"",
                ];
                $dataXmlID = BElements::elementXMLID($xmldata);
                $dataXmlIDLen = count($dataXmlID);

                //print("<div>dataXmlIDLen {$dataXmlIDLen} dataSP = {$dataSP}</div>");
                //ClassDebug::debug($dataXmlID);
                //ClassDebug::debug($arrSectionCode);

                if($dataXmlIDLen > 0){
                    $arrUpdateArray = Array(
                        "MODIFIED_BY"    => $_SESSION["SESS_AUTH"]["USER_ID"], 
                        "IBLOCK_SECTION_ID" => $IDBS, 
                        "PROPERTY_VALUES"=> $PROP,
                        "NAME"           => $dataXmlID[0]["NAME"],
                        "ACTIVE"         => "Y",
                        "ACTIVE_FROM"   => $dataXmlID[0]["ACTIVE_FROM"],
                        "CODE"=>"",
                        );
                    $res = $oElement->Update($dataXmlID[0]["ID"], $arrUpdateArray);

                    $props["NOTICE"] = BElements::propertisList($IBLOCK_ID,$dataXmlID[0]["ID"],["CODE"=>"NOTICE"]);
                    if(is_array($props["NOTICE"]) && !empty($props["NOTICE"]) && count($props["NOTICE"]) > 0){
                        foreach($props["NOTICE"] as $notice){
                            \CIBlockElement::SetPropertyValueCode($dataXmlID[0]["ID"], 'NOTICE', array(
                                $notice['PROPERTY_VALUE_ID'] => array('del' => 'Y', 'tmp_name' => '')
                             ));
                            DBCFILES::deletefile($notice["VALUE"]);
                        }
                    }

                    $props["PROTOCOL"] = BElements::propertisList($IBLOCK_ID,$dataXmlID[0]["ID"],["CODE"=>"PROTOCOL"]);
                    if(is_array($props["PROTOCOL"]) && !empty($props["PROTOCOL"]) && count($props["PROTOCOL"]) > 0){
                        foreach($props["PROTOCOL"] as $notice){
                            \CIBlockElement::SetPropertyValueCode($dataXmlID[0]["ID"], 'PROTOCOL', array(
                                $notice['PROPERTY_VALUE_ID'] => array('del' => 'Y', 'tmp_name' => '')
                             ));
                            DBCFILES::deletefile($notice["VALUE"]);
                        }
                    }
                   
                    if(is_array($fileSaveArr) && !empty($fileSaveArr) && count($fileSaveArr) > 0){
                        foreach($fileSaveArr as $fileID){
                            if(!empty($fileID)){
                                \CIBlockElement::SetPropertyValueCode($dataXmlID[0]["ID"], "NOTICE", $fileID);
                            }
                        } 
                    }
                    /*
                        if(!empty($fileSave)){
                            \CIBlockElement::SetPropertyValueCode($dataXmlID[0]["ID"], "NOTICE", $fileSave);
                        }
                    */

                    if(!empty($fileSavePro)){
                        \CIBlockElement::SetPropertyValueCode($dataXmlID[0]["ID"], "PROTOCOL", $fileSavePro);
                    }
                    
                    if(!empty($dataTimeResult)){
                        \CIBlockElement::SetPropertyValueCode($dataXmlID[0]["ID"], "DATE_POST", $dataTimeResult);
                    }

                    if(!empty($dataSP)){
                        \CIBlockElement::SetPropertyValueCode($dataXmlID[0]["ID"], "SOURCE", $dataSP);
                    }

                }
                else{
                    $arFields = array(
                        "ACTIVE" => "Y", 
                        "IBLOCK_ID" => $IBLOCK_ID,
                        "ACTIVE_FROM"   => date('d.m.Y H:i:s'),
                        "IBLOCK_SECTION_ID" => $IDBS,
                        "NAME" => $dataName,
                        "CODE" => "",
                        "XML_ID"=> $dataXMLID,
                     );
                    
                    if($res = $oElement->Add($arFields, false, false, true)){

                        /*if(!empty($fileSave)){
                            \CIBlockElement::SetPropertyValueCode($res, "NOTICE", $fileSave);
                        }*/
                        if(is_array($fileSaveArr) && !empty($fileSaveArr) && count($fileSaveArr) > 0){
                            foreach($fileSaveArr as $fileID){
                                if(!empty($fileID)){
                                    \CIBlockElement::SetPropertyValueCode($res, "NOTICE", $fileID);
                                }
                            } 
                        }
    
                        if(!empty($fileSavePro)){
                            \CIBlockElement::SetPropertyValueCode($res, "PROTOCOL", $fileSavePro);
                        }
                        
                        if(!empty($dataTimeResult)){
                            \CIBlockElement::SetPropertyValueCode($res, "DATE_POST", $dataTimeResult);
                        }
    
                        if(!empty($dataSP)){
                            \CIBlockElement::SetPropertyValueCode($res, "SOURCE", $dataSP);
                        }
                    }
                }
            }
        }

        self::soda(self::pathFolder());
        return $res;
    }
}
?>
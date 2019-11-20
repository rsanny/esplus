<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\DBCFILES;
use DorrBitt\DBXLS\DBXLS;
use DorrBitt\dbapi\DGAPI;
use DorrBitt\dbapi\BElements;
print("<link href=\"/bitrix/dataxls-2/style-xls-unload.css\" type=\"text/css\" rel=\"stylesheet\" />");
$user_ses = DGAPI::ses();
$oElement = new \CIBlockElement();
$IBLOCK_ID = 55;
use DorrBitt\dbapi\ClassDBase;
$objClassDBase = new ClassDBase();
$table = "b_iblock_element_prop_s55";
//ClassDebug::debug($arResult);


if(!empty($_REQUEST["idfile"] && $_REQUEST["idfile"] > 0)){
    $fileData = [];
    $idfile = ($_REQUEST["idfile"] > 0) ? $_REQUEST["idfile"] : "";
    foreach($arResult as $fvdata){
        if($fvdata["ID"] == $idfile){
            if(is_array($fvdata["arProps"]) && !empty($fvdata["arProps"]) && count($fvdata["arProps"]) > 0){
                if($fvdata["arProps"]["VALUE"] > 0){
                    $file = DBCFILES::fileID($fvdata["arProps"]["VALUE"]);
                    $fileData = [
                        "NAME"=>$fvdata["NAME"],
                        "FILE_NAME"=>$file["FILE_NAME"],
                        "SRC"=>$file["SRC"],
                        "CONTENT_TYPE"=>$file["CONTENT_TYPE"],
                        "FILE_SIZE"=>$file["FILE_SIZE"]
                    ];
                }
            }
        }

    }
}

$baseUrl = trim(explode("?",$_SERVER["REQUEST_URI"])[0]);
?>
<h1>Выгрузка данных из xls файла</h1>
<div class="xlsdata"  >

    <div class="xlsdata-bl-hg" >

        <div class="xlsdata-bl-name" >
          Наименование
        </div>
        <div class="xlsdata-bl-type" >
          Имя файла / Тип файла
        </div>
        <div class="xlsdata-bl-action" >
          Действие
        </div>

    </div>

    <?php if(is_array($arResult) && !empty($arResult) && count($arResult) > 0):?>
        <?php foreach($arResult as $fvdata):?>

            <div class="xlsdata-bl" >

                <div class="xlsdata-bl-name" >
                <?=$fvdata["NAME"]?>
                </div>
                <div class="xlsdata-bl-type" >
                <?=$fvdata["FILE_NAME"]?>
                </div>
                <div class="xlsdata-bl-action" >
                    <?php
                    $urlUpl = $baseUrl;
                    $urlUpl = "?DPHPSESSID=".$_REQUEST["DPHPSESSID"];
                    $urlUpl .= "&rUnloading=".md5("yes");
                    $urlUpl .= "&idfile=".$fvdata["ID"];
                    ?>
                    <a href="<?=$urlUpl?>" >Запустить выгрузку</a>
                </div>

            </div>
        <?php endforeach;?>
    <?php endif;?>

    <?php //unset($_SESSION["start_last"]);
        if($_REQUEST["rUnloading"] == "a6105c0a611b41b08f1209506350279e" && empty($_REQUEST["clear"])){
            unset($_SESSION["start_last"]);
            print("<div id=\"xls\" >");
            $result = DBXLS::parseExcelFileSimpleXls($_SERVER["DOCUMENT_ROOT"].$fileData["SRC"]);
            $_SESSION["start_last"]["{$user_ses}"]["result"] = $result;
            $result_len = count($result);
            /*if(empty($_REQUEST["start"])){
                $start = 2;
                $last = $start+2;
            }
            else{
                $start = $_REQUEST["start"]+1;
                $last = $start+2;
            }*/

            if(empty($_SESSION["start_last"])){
                $start = 2;
                $last = $start+1;
            }
            else{
                $_SESSION["start_last"]["{$user_ses}"]["start"] = $_SESSION["start_last"]["{$user_ses}"]["last"]-1;
                $_SESSION["start_last"]["{$user_ses}"]["last"]  = $_SESSION["start_last"]["{$user_ses}"]["start"]+2;
                $start = $_SESSION["start_last"]["{$user_ses}"]["start"];
                $last = $_SESSION["start_last"]["{$user_ses}"]["last"];
            }


            $opera = [];
            //print("<div>start {$start} last {$last}</div>");
            for($r = $start; $r <= $last; $r++){
                if(count($result[$r]) > 0){
                    $opera[] = $r;
                    /*$NLS_ID = str_replace("*","",$result[$r][0]);
                    $ZAV_NOM = str_replace("*","",$result[$r][1]);
                    $PONUMBER = str_replace("*","",$result[$r][2]);*/

                    $NLS_ID2 = str_replace("*","",$result[$r][0]);
                    $ZAV_NOM2 = str_replace("*","",$result[$r][1]);
                    $PONUMBER2 = str_replace("*","",$result[$r][2]);

                    $NLS_ID = $result[$r][0];
                    $ZAV_NOM = $result[$r][1];
                    $PONUMBER = $result[$r][2];

                    $XML_ID = $NLS_ID2."-".$ZAV_NOM2;
                    if( $XML_ID == "номер ЛС РКЦ-номер ПУ" || $XML_ID == "NLS_ID-ZAV_NOM" ){

                    }
                    else{
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
                            $resData = $objClassDBase->initUpdate(
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
                            \CIBlockElement::SetPropertyValueCode($res, "DATA_M", $tdata);*/
                        }
                    }
                }
                    //print($NLS_ID."-".$ZAV_NOM);
                }
               //ClassDebug::debug($result[$r]);
            }
            //ClassDebug::debug($opera);
            if(count($opera) > 0 && !empty($opera[1])){
                $urlRed = $baseUrl."?DPHPSESSID=".$_REQUEST["DPHPSESSID"];
                $len = count($opera)-1;
                $data_uv = $opera[$len];
                $uv = $data_uv-1;
                print("<div class=\"unloadVY\" >");
                //print("<div style=\"color:#444; font-size:14px; padding:5px 0 5px 0;\">Выгружено строк: {$uv}. Всего строк: {$_REQUEST["result_len"]}</div>");
                $tvp = $uv/$result_len;
                $tvpI = round($tvp, 2);
                $tvpI100 = $tvpI*100;
                $width = 600;
                $width_res = $width*$tvpI;
                print("<div class=\"message\" >");
                print("Подождите пожауйста. Идёт выгрузка данных из файла( {$tvpI100}% ). Выгружено строк: {$uv}. Всего строк: {$result_len}.");
                print("</div>");
                //print("<div style=\"border:1px solid #696969; height:30px; background:#d7d7d7; width:{$width_res}px\"></div>");
                print("<progress value=\"{$width_res}\" max=\"600\" >{$tvpI100}%</progress>");
                print("</div>");
            }
        print("</div>");
?>
<?php $urlRed = $baseUrl."?DPHPSESSID=".$_REQUEST["DPHPSESSID"]; ?>
<script>

setInterval(function(){
    var start = "<?=$start?>";
    var last = "<?=$last?>";
    var src = '<?=$_SERVER["DOCUMENT_ROOT"]?>'+'<?=$fileData["SRC"]?>';
    var unload = "<?=$_REQUEST["rUnloading"]?>";
    var result_len = "<?=$result_len?>";
    var dphpsession = "<?=$_REQUEST["DPHPSESSID"]?>";
    var baseUrl = "<?=$baseUrl?>";
    var idfile = "<?=$idfile?>";
    //console.log(id);
    //console.log(name);
    $.ajax({
        url:'/local/include/ajax/synh-xls-ajax.php',
        data: { start:start,last:last,src:src,unload:unload,result_len:result_len,dphpsession:dphpsession,baseUrl:baseUrl,idfile:idfile },
        type: 'GET',
        beforeSend: function() {
            $('#loader').show();
         },
         complete: function(){
            $('#loader').hide();
         },
        success: function(res){
            modals('xls',res);
        },
        error: function(){
            //document.location.reload(true);
            document.location.href='<?=$urlRed?>&rUnloading=<?=$_REQUEST["rUnloading"]?>&idfile='+idfile+'&clear=1';
            //alert('Error!');
        }
    });
}, 100);

</script>
<?php
}
elseif($_REQUEST["rUnloading"] == "a6105c0a611b41b08f1209506350279e" && $_REQUEST["clear"] == 1){
    $itogoLen = $_SESSION["start_last"]["{$user_ses}"]["len"];

    $result = $_SESSION["start_last"]["{$user_ses}"]["result"];
    $result_len = count($result);
    //print("<div>{$itogoLen} == {$result_len}</div>");
    if($itogoLen < $result_len){
        $urlRed = $baseUrl."?DPHPSESSID=".$_REQUEST["DPHPSESSID"];
        $urlResult = "";
        $urlResult = $urlRed;
        $urlResult .= "&rUnloading={$_REQUEST["rUnloading"]}";
        $urlResult .= "&idfile={$_REQUEST["idfile"]}";
        print("<div class=\"unloadVYResultMessage\" ><a href=\"{$urlResult}\" >Продолжить выгрузку.</a></div>");
    }
    elseif($itogoLen >= $result_len){
        print("<div class=\"unloadVYResultMessage\" >Выгрузка прошла успешно. Выгружено и записано в базу: {$itogoLen} строк.</div>");
        $urlRed = $baseUrl."?DPHPSESSID=".$_REQUEST["DPHPSESSID"];
        print("<div class=\"unloadVYResultMessage\" ><a href=\"{$urlRed}\">Вернуться к выгрузке</a>. </div>");
        unset($_SESSION["start_last"]);
    }

}
?>
</div>
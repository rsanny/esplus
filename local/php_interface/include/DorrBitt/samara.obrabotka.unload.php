<?php
namespace DorrBitt\SamaraObrabotkaUnload;
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\BElements;

Class SOU {

    public function __construct(){
        $this->obj = new BElements();
    }

    public function listCode(){
        return ["ZAV_NOM","SHOV_LAST","SHOV_LAST_ADD"];
    }

    public function error(){
        return "Лицевой счёт не найден. Подробности по телефону Контакт-центра.";
    }

    public function listCodeTime(){
        return ["PERIOD_VY"];
    }

    public function listElemProps($arr){
        //ClassDebug::debug($arr);
        $listcode = $this->listCode();
        $resultDataLs = [];
        if(is_array($arr) && !empty($arr)){
            foreach($arr as $res){
                $act = (!empty($res["arProps"]["VALUE"])) ? 1 : 0;
                if($act == 1){
                    $arProps = $res["arProps"];
                    unset($res["arProps"]);
                    $resultDataLs[$res["XML_ID"]] = $res;
                    $resultDataLs[$res["XML_ID"]]["NLS_ID"] = $arProps;
                    for($i=0;$i<count($listcode);$i++){
                        $dataCode = $this->obj->propertis($res["IBLOCK_ID"],$res["ID"],["CODE"=>$listcode[$i]]);
                        $resultDataLs[$res["XML_ID"]][$listcode[$i]] = $dataCode;
                    }
                }
            }
        }
        return $resultDataLs;
    }

    public function listElemPropsTime($arr){
        //ClassDebug::debug($arr);
        $listcode = $this->listCodeTime();
        $resultDataLs = [];
        if(is_array($arr) && !empty($arr)){
            foreach($arr as $res){
                    $resultDataLs[$res["XML_ID"]] = $res;
                    for($i=0;$i<count($listcode);$i++){
                        $dataCode = $this->obj->propertis($res["IBLOCK_ID"],$res["ID"],["CODE"=>$listcode[$i]]);
                        if(is_array($dataCode) && !empty($dataCode) && count($dataCode) > 0){
                            $resultDataLs[$res["XML_ID"]][$listcode[$i]] = $dataCode;
                        }
                    }
            }
        }
        return $resultDataLs;
    }

}

?>
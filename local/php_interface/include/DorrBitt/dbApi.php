<?php 
namespace DorrBitt\dbapi;
use DorrBitt\ClassDebug\ClassDebug;

Class DGAPI {

    public static function ses(){
        return bitrix_sessid();
    }

    public static function trim($str){
        return trim($str);
    }

    public static function dev($sesia){
        return (self::ses() == $sesia) ? 1 : 0;
    }
}

Class ClassDBase {

    public $localselect = [];

    public function actionClass(){
        return __CLASS__;
    }

    public function tableName($name = ""){
        return (empty($name)) ? "b_form" : $name;
    }

    public function from($name){
        return "FROM ".$this->tableName($name);
        }

        public function sql($sql){
            if(is_array($sql) && !empty($sql)){
                return implode(",",$sql);
                }
            return false;
        }

    public function where($where){
        if(is_array($where) && !empty($where) && !empty($where[0])){
            $data_where = ""; $i = "";
            foreach($where as $k_where=>$v_where){
                $i++;
                if($i == 1){
                    if($i == count($where)){
                        $and = "";
                         $and_end = "";
                    }
                    else{
                        $and = "";
                        $and_end = " and ";
                    }
                    
                }
                elseif($i == count($where)){
                    $and = "";
                    $and_end = "";
                }
                else{
                    $and = " and ";
                    $and_end = " and ";
                }
                
                if(!empty($v_where) && !empty($k_where)){
                    $data_where .= "{$and}{$k_where}='{$v_where}'{$and_end}";
                }
            }
            //print $data_where; 
            $w = (count($where) > 0) ? " WHERE " : "";
            $data_where = "{$w} {$data_where}";
            return $data_where;
        }
        else{
            return "";
        }
    }


    public function sqlUpdate($sqlUp){
        //ClassDebug::debug($sqlUp);
        if(is_array($sqlUp) && !empty($sqlUp) && !empty($sqlUp[0])){
            $data_sqlUp = ""; $i = "";
            foreach($sqlUp as $k_sqlUp=>$v_sqlUp){
                $i++;
                if($i == 1){
                    if($i == count($sqlUp)){
                        $and = "";
                         $and_end = "";
                    }
                    else{
                        $and = "";
                        $and_end = ", ";
                    }
                    
                }
                elseif($i == count($sqlUp)){
                    $and = "";
                    $and_end = "";
                }
                else{
                    $and = " ";
                    $and_end = ", ";
                }
                
                if(!empty($v_sqlUp[0]) && !empty($v_sqlUp[1]) && !empty($v_sqlUp[2])){
                    $data_sqlUp .= "{$and}{$v_sqlUp[0]}{$v_sqlUp[1]}'{$v_sqlUp[2]}'{$and_end}";
                }
                //print $data_sqlUp;
            }
            $w = (count($sqlUp) > 0) ? " SET " : "";
            $data_sqlUp = "{$w} {$data_sqlUp}";
            return $data_sqlUp;
        }
        else{
            return "";
        }
    }

    public function sqlInsert($sqlIn){
        ClassDebug::debug($sqlIn);
        if(is_array($sqlIn) && !empty($sqlIn)){
            $data_ins = ""; $i = "";
            $sqlInAtr = implode(",",$sqlIn["attr"]);
            $sqlInVal = implode(",",$sqlIn["values"]);
            $w = (count($sqlIn) > 0) ? " VALUES " : "";
            $data_sqlIns = "({$sqlInAtr}) {$w} ({$sqlInVal})";
            return $data_sqlIns;
        }
        else{
            return "";
        }
    }

    public function where3($where){
        if(is_array($where) && !empty($where) && !empty($where[0])){
            $data_where = ""; $i = "";
            for($i=0;$i<count($where);$i++){
                if($i == 0){
                    if($i == count($where)-1){
                        $and = "";
                         $and_end = "";
                    }
                    else{
                        $and = "";
                        $and_end = " and ";
                    }
                    
                }
                elseif($i == count($where)-1){
                    $and = "";
                    $and_end = "";
                }
                else{
                    $and = " and ";
                    $and_end = " and ";
                }
                $data_where .= "{$and}{$where[$i][0]} {$where[$i][1]} '{$where[$i][2]}'{$and_end}";
            }
            //print $data_where; 
            $w = (count($where) > 0) ? " WHERE " : "";
            $data_where = "{$w} {$data_where}";
            return $data_where;
        }
        else{
            return "";
        }
    }

    public function tquery($select){
        global $DB;
        return $DB->Query($select);
    }

    public function limit($num = ""){
        return ($num > 0 ) ? "LIMIT {$num}" : "";
    }

    public function offset($offs = ""){
        return (!empty($offs)) ? "OFFSET {$offs}" : "";
    }

    public function orderby($arrOrder){
        //ClassDebug::debug($arrOrder);
        if(!empty($arrOrder)){
            if(is_array($arrOrder)){
                if(!empty($arrOrder["list"])){
                    $order_attr = $arrOrder["list"];
                }
                if(!empty($arrOrder["order"])){
                    $order_order = $arrOrder["order"];
                }
                return  "ORDER BY {$order_attr} {$order_order}";
            }
        }
        else{
            return "";
        }
    }

    public function fetch($results){
        $arrResults = [];
        while ($row = $results->Fetch()){
            $arrResults[] = $row;
        }
        return $arrResults;
    }

    public function initQuery($tableName = "",$sql,$where){
        $from = $this->from($tableName);
        $sql   = $this->sql($sql);
        $where = $this->where($where);
        $select = "SELECT {$sql} {$from} {$where}";
        //print $select;
        $results = $this->tquery($select);
        $arrResults = $this->fetch($results);
        return $arrResults;
    }

    public function initQuery3($tableName = "",$sql,$where,$order,$limit = 30,$offset = 0){
        
        $from = $this->from($tableName);
        $sql   = $this->sql($sql);
        $where = $this->where3($where);
        $limitr = $this->limit($limit);
        $offsetr = $this->offset($offset);
        $orderBY = (!empty($order)) ? $this->orderby($order) : "";
        $select = "SELECT {$sql} {$from} {$where} {$orderBY} {$limitr} {$offsetr}";
        $this->localselect = $select;
        
        $results = $this->tquery($select);
        $arrResults = $this->fetch($results);
        return $arrResults;
    }

    public function initQuery4($tableName = "",$sql,$where,$order,$limit = "",$offset = ""){
        
        $from = $this->from($tableName);
        $sql   = $this->sql($sql);
        $where = $this->where3($where);
        $limitr = (!empty($limit)) ? $this->limit($limit) : "";
        $offsetr = (!empty($offset)) ? $this->offset($offset) : "";
        $orderBY = (!empty($order)) ? $this->orderby($order) : "";
        $select = "SELECT {$sql} {$from} {$where} {$orderBY} {$limitr} {$offsetr}";
        $this->localselect = $select;
        
        $results = $this->tquery($select);
        $arrResults = $this->fetch($results);
        return $arrResults;
    }

    public function initUpdate($tableName = "",$sql,$where){
        
        $table = $this->tableName($tableName);
        $sql   = $this->sqlUpdate($sql);
        $where = $this->where3($where);
        $select = "UPDATE {$table} {$sql} {$where} ";
        $this->localselect = $select;
        
        $results = $this->tquery($select);
        $arrResults = $this->fetch($results);
        return $arrResults;
    }

    public function initInsert($tableName = "",$sql,$where){
        
        $table = $this->tableName($tableName);
        $sql   = $this->sqlInsert($sql);
        $where = $this->where3($where);
        $select = "INSERT INTO {$table} {$sql}";
        $this->localselect = $select;
        
        $results = $this->tquery($select);
        $arrResults = $this->fetch($results);
        return $arrResults;
    }

    public function initQuerySQL($sql){
        $results = $this->tquery($sql);
        $arrResults = $this->fetch($results);
        return $arrResults;
    }


}

Class BElementsOld {

    public function elements($arFilter,$nPageSize,$arSelect){
        return \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>$nPageSize), $arSelect);
    }

    public function elementsList($re){
        $arrElemets = [];
        while($ob = $re->GetNextElement()){
            $arFields = $ob->GetFields();
            $propers = $this->propertis($arFields["IBLOCK_ID"],$arFields["ID"],["NAME"=>["VALUE"],"ACTIVE"=>"Y","CODE"=>"REGION"]);
            $arFields["propertis"] = $propers;
            $arrElemets[] = $arFields;
        }
        return $arrElemets;
    }

    public function propertis($iblID,$ID,$CODE){
        $res = \CIBlockElement::GetProperty($iblID, $ID, "sort", "asc", $CODE);
        $arrPropertis = [];
        while ($ob = $res->GetNext()){
            $arrPropertis["NAME"] = $ob["NAME"];
            $arrPropertis["VALUE"] = $ob["VALUE"];
            }
        return $arrPropertis;
    }

}


Class BElements {

    public function elements($arFilter,$nPageSize,$arSelect){
        return \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>$nPageSize), $arSelect);
    }

    public function elementsList($re){
        $arrElemets = [];
        while($ob = $re->GetNextElement()){
            $arFields = $ob->GetFields();
            $propers = $this->propertis($arFields["IBLOCK_ID"],$arFields["ID"],["NAME"=>["VALUE"],"ACTIVE"=>"Y","CODE"=>"REGION"]);
            $arFields["propertis"] = $propers;
            $arrElemets[] = $arFields;
        }
        return $arrElemets;
    }

    public function elementID($ID){
        $arrElem = [];
        $res = \CIBlockElement::GetByID($ID);
        if($arRes = $res->GetNext()){
            $arrElem = $arRes;
        }
        return $arrElem;
    }

    public function elemList($arParams){
        $lenOpt = count($opt);
        $idblock=$arParams["IBLOCK_ID"];
        $arSelect = $arParams["arSelect"]; 
        $arOrder = $arParams["arOrder"];
        $arProperty = $arParams["arProperty"];
        $pro_id = $arParams["PROPERTYID"];
        $arFilter = Array("IBLOCK_ID"=>$idblock, "ACTIVE"=>"Y","CODE"=>trim($arParams["CODE"]));
    
        $res = \CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
        
        $arDataResult = []; $arDataResultLocal = [];
        while($ob = $res->GetNextElement()) 
        {
            $arData = $ob->GetFields();
            $arDataResultLocal[] = $arData;
            //ClassDebug::debug($arData);
            $arProps = $this->propertis($idblock,$arData["ID"],$arProperty); 
            //if($arProps["VALUE"] == $pro_id){
                $arData["arProps"] =  $arProps; 
                $arDataResult[] =  $arData; 
            //}

        }
        if(count($arDataResult) == 0){
            $arDataResult = $arDataResultLocal;
        }
        return $arDataResult;
        }

    public function elemList2($arParams){
        $lenOpt = count($opt);
        $idblock=$arParams["IBLOCK_ID"];
        $arSelect = $arParams["arSelect"]; 
        $arOrder = $arParams["arOrder"];
        $arProperty = $arParams["arProperty"];
        $pro_id = $arParams["PROPERTYID"];
        $arFilter = Array("IBLOCK_ID"=>$idblock, "ACTIVE"=>"Y","CODE"=>trim($arParams["CODE"]));
    
        $res = \CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
        
        $arDataResult = []; $arDataResultLocal = [];
        while($ob = $res->GetNextElement()) 
        {
            $arData = $ob->GetFields();
            $arDataResultLocal[] = $arData;
            //ClassDebug::debug($arData);
            $arProps = $this->propertis($idblock,$arData["ID"],$arProperty); 
            if($arProps["VALUE"] == $pro_id){
                $arData["arProps"] =  $arProps; 
                $arDataResult[] =  $arData; 
            }

        }
        if(count($arDataResult) == 0){
            $arDataResult = $arDataResultLocal;
        }
        return $arDataResult;
        }

    public function elementXMLID($xmldata){

            $idblock = $xmldata["IBLOCK_ID"];
            $XML_ID = $xmldata["XML_ID"];
            $arSelect = $xmldata["select"]; 
            $arOrder = $xmldata["SORT"];
            $arFilter = Array("IBLOCK_ID"=>$idblock, "ACTIVE"=>"Y","XML_ID"=>trim($XML_ID));
        
            $res = \CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
            
            $xmlDataResult = [];
            while($ob = $res->GetNextElement()) 
            {
                $xmlDataResult[] = $ob->GetFields(); 	    
            }
        return $xmlDataResult;
        }

    public function propertis($iblID,$ID,$CODE){
        $res = \CIBlockElement::GetProperty($iblID, $ID, "sort", "asc", $CODE);
        $arrPropertis = [];
        while ($ob = $res->GetNext()){
            $arrPropertis["NAME"] = $ob["NAME"];
            $arrPropertis["VALUE"] = $ob["VALUE"];
            }
        return $arrPropertis;
    }

    public function propertisList($iblID,$ID,$CODE){
        $res = \CIBlockElement::GetProperty($iblID, $ID, "sort", "asc", $CODE);
        $arrPropertis = [];
        while ($ob = $res->GetNext()){
            $arrPropertis[] = $ob;
            }
        return $arrPropertis;
    }


}

Class BSections {

    public function sections($order, $arFilter,$fields){
        return \CIBlockSection::GetList($order, $arFilter, true,$fields);
    }

    public function sectionsList($se){
        $arrSections = [];
        while($obs = $se->GetNext()){
            $arrSections[] = $obs;
        }
        return $arrSections;
    }
}

Class DBCFILES {

    public static function fileID($id){
        return \CFile::GetFileArray($id);
    }

    public static function savefile($fileArr,$folder){
        return \CFile::SaveFile($fileArr,"/".$folder);
    }
    
    public static function makefilearray($pathfile){
        return  \CFile::MakeFileArray($pathfile,false,false,'');
    }

    public static function deletefile($fileID){
        return \CFile::Delete($fileID);
    }
      
}

?>
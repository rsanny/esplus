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

    public function initQuerySQL($sql){
        $results = $this->tquery($sql);
        $arrResults = $this->fetch($results);
        return $arrResults;
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
?>
<?php 
namespace DorrBitt\abvCity;

Class abvCityParse {

    public static $arrParamParse = ["пгт.","с.","п."];

    public static function abvParse($nameCity){
        $devparse = (!empty($nameCity) && is_string($nameCity)) ? 1 : 0;
        if($devparse == 0) return false;
        if($devparse == 1){
            $arrPar = [];
            for($y = 0; $y < count(self::$arrParamParse); $y++){
                $arr_nameCity = explode(self::$arrParamParse[$y],$nameCity);
                if(count($arr_nameCity) > 1){
                    $arrPar[] = 1;
                    }
                else{
                    $arrPar[] = 0;
                    }
                }
            }
        return $arrPar;
        } 
    
        public static function array_unique($arr){
            return array_unique($arr);
        }

        public static function m_in_array($arr,$param){
            return (in_array($param,$arr)) ? 1 : 0;
        }

        public static function initResult($nameCity){
            $arrPar = self::abvParse($nameCity);
            $arrPar = self::array_unique($arrPar);
            $arrParNumber = self::m_in_array($arrPar,1);
            if(count($arrPar) == 1){
                $abCity = "г.";
            }
            elseif(count($arrPar) > 1 && ($arrParNumber == 1)){
                $abCity = "";
            }
        return $abCity;
        }

        
    }
?>
<?php 
namespace DorrBitt\dbCity;

Class DBCITY {

    public static function idcity(){
        return $_SESSION['BXExtra']['REGION']['IBLOCK']['ID'];
    }

    public static function dbidcity(){
        return [23,13,18,24,15];
    }

    public static function inarray($arr,$arg){
        if(in_array($arg, $arr)){
            return 1;
        }
        else{
            return 0;
        }
    }

    public static function dostup($par = 0){
        return $par;
        }
    /** 
    * @ number dostup
    */
    public static function dostup_time($data_time){
        $tochka_time = strtotime($data_time);
        $t_time = time();
        return ($t_time >= $tochka_time) ? 1 : 0;
        }

    /** 
    * @ number dostup result
    */
    public static function resultDostup($par = 0,$data_time){
        $tRegionID = self::idcity();
        $allRegionID = self::dbidcity();
        $dostup = self::dostup($par);
        $dtime = self::dostup_time($data_time);
        $region_act_show = (self::inarray($allRegionID,$tRegionID) == 1) ? 1 : 0;
        return ($dostup == 1 && $region_act_show == 1 && $dtime == 1) ? 1 : 0;
        }
}
?>
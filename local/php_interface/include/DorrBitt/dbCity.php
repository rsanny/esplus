<?php 
namespace DorrBitt\dbCity;

Class DBCITY {
    /** 
    * @ number ID regions
    */
    public static function idcity(){
        return $_SESSION['BXExtra']['REGION']['IBLOCK']['ID'];
    }
    /** 
    * @ array list regions
    */
    public static function dbidcity(){
        return [23,13,18,24,15];
    }
    /** 
    * @ array list regions online servises pay
    */
    public static function servisOnlinePayDBIDcity(){
        return [23,18,24];
    }
    /** 
    * @ array list regions no online servises pay
    */
    public static function servisNoPayDBIDcity(){
        return [13,15];
    }

    public static function dataGroupAct(){
        $dataAct = 0;
        $onlinepay = self::servisOnlinePayDBIDcity();
        $nopay     = self::servisNoPayDBIDcity();
        $idRegion  = self::idcity();
        if(self::inarray($onlinepay,$idRegion) == 1){
            $dataAct = 1;
        }
        elseif(self::inarray($nopay,$idRegion) == 1){
            $dataAct = 2;
        }
        return $dataAct;
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

    public static function dostup_time_period($data_time,$data_time_last){
        $tochka_time      = strtotime($data_time);
        $tochka_time_last = strtotime($data_time_last);
        $t_time = time();
        return ($t_time >= $tochka_time && $t_time <= $tochka_time_last) ? 1 : 0;
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

    public static function resultDostupTu($par = 0,$data_time,$data_time_last){
        $tRegionID = self::idcity();
        $allRegionID = self::dbidcity();
        $dostup = self::dostup($par);
        $dtime = self::dostup_time_period($data_time,$data_time_last);
        $region_act_show = (self::inarray($allRegionID,$tRegionID) == 1) ? 1 : 0;
        return ($dostup == 1 && $region_act_show == 1 && $dtime == 1) ? 1 : 0;
        }
}
?>
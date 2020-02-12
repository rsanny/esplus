<?php 
namespace DorrBitt\DBDOMENS;
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbCity\DBCITY;

Class DBDOMENS {

    public static function typeDomen(){
        if(!empty($_SERVER["SERVER_NAME"])){
            return explode(".",$_SERVER["SERVER_NAME"]);
        }
    }

    public static function listMagazinShop($idstr){
        return [
                "{$idstr}"=>[23,24,18,13,11],
               ];
    }

    public static function proverkaMagazina($idstr){
        $idregion = DBCITY::idcity();
        $listM = self::listMagazinShop($idstr);
        return (DBCITY::inarray($listM,$idregion) == 1) ? 1 : 0;
    }

    public static function listDomenNoAct(){
        return [
            "kirov",
            "udm",
            "oren",
            "ekb",
            "vladimir",
        ];
    }

    public static function proverkaDomenNoAct(){
        $tDomen = self::typeDomen();
        //print_r($tDomen);
        $listDomenNA = self::listDomenNoAct();
        return (DBCITY::inarray($listDomenNA,$tDomen[0]) == 1) ? 0 : 1;
        }

    }
?>
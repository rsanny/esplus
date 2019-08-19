<?php 
Class ClassDebug {

    public static function debug($arr,$param = ""){
    
        if(is_array($arr) && !empty($arr)){
            print("<pre>{$params}");
            print_r($arr);
            print("</pre>");
        }
        elseif(is_string($arr)){
        print("<pre>{$params}");
        print($arr);
        print("</pre>");
        }
    }
}

Class LoginPassBasa {

    public static $stokLogin = "stock";
    public static $stokPass  = "qwerty";

    public static function md5($str){
        return md5($str);
    }

    public static function login(){
        return self::$stokLogin;
    }

    public static function pass(){
        return self::md5(self::$stokPass);
    }

    public static function ses(){
        return bitrix_sessid();
    }

    public static function trim($str){
        return trim($str);
    }

    public static function str_key($arr){
        if(is_array($arr) && !empty($arr)){
            return array_keys($arr)[0];
        }
    }

    public static function login_result(){
        $tSes = LoginPassBasa::ses();
        $result = LoginPassBasa::str_key($_GET);
        $itDostup = ($result == "result" && $_GET[$result] == $tSes) ? 1 : 0;
        if($itDostup == 1){
            $_SESSION["result_{$tSes}"] = LoginPassBasa::login();
        }
        else{
            unset($_SESSION["result_{$tSes}"]);
        }
        return $_SESSION["result_{$tSes}"];
    }

    public static function unset_ses($str){
        unset($str);
        return true;
        }

    public static function userIzSee(){
        $tSes = LoginPassBasa::ses();
        return $_SESSION["result_{$tSes}"];
        }
}
?>
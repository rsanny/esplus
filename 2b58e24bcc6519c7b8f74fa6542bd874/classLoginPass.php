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

    public static $stokLogin = "chat";
    public static $stokPass  = "UQmnRTeG9cn0KoMy3F6P";

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
        return $_SESSION["fixed_session_id"];
    }

    public static function trim($str){
        return trim($str);
    }

    public static function str_key($arr){
        if(is_array($arr) && !empty($arr)){
            return array_keys($arr)[0];
        }
    }

    public static function name_region(){
        $expsn = explode(".",$_SERVER["SERVER_NAME"]);
        if(count($expsn) == 3 && $expsn[0] == "oren"){
            return $expsn[0];
        }
        else{
            return "";
        }
    }

    public static function login_result(){
        $tSes = self::ses();
        $result = self::str_key($_GET);
        $itDostup = ($result == "result" && $_GET[$result] == $tSes) ? 1 : 0;
        if($itDostup == 1){
            $_SESSION["result_{$tSes}"] = self::login();
        }
        else{
            unset($_SESSION["result_{$tSes}"]);
        }
        if(!empty($_SESSION["result_{$tSes}"])){
            return $_SESSION["result_{$tSes}"];
        }
        else{
            return "";
        }
        
    }

    public static function unset_ses($str){
        unset($str);
        return true;
        }

    public static function userIzSee(){
        $tSes = self::ses();
        if(!empty($_SESSION["result_{$tSes}"])){
            return $_SESSION["result_{$tSes}"];
            }
        }

    public static function redirect($urldata){
        return header("Location: {$urldata}", true, 301);
        }
}
?>
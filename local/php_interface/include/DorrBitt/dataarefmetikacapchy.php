<?php 
namespace DorrBitt\DataArefmetikaCapchy;
use DorrBitt\dbapi\DGAPI;
use DorrBitt\IB\IBOT;

class DataArefmetikaCapchy  {

    /** 
     * array generator numbers int
    */

	public static function sol(){
        return "result";
    }

	public static function ses_sol(){
        $user_ses = DGAPI::ses();
        $user_sol = self::sol();
        return "{$user_sol}-{$user_ses}";
    }

	public static function arifmetiks(){
        $solgo = self::ses_sol();
        $data_rez = rand(50000,1000000);
	    $arA = rand(40000,$data_rez-1); 
	    $arB = $data_rez-$arA;
        $capchOS = array($data_rez,$arA,$arB);
	    $_SESSION[$solgo]["data_srez"] = $capchOS;
	   return true;
	   }

	public static function ar_save(){
        $solgo = self::ses_sol();
        return $_SESSION[$solgo]["data_srez"];
        }

        public static function ar_remove(){
            $solgo = self::ses_sol();
            unset($_SESSION[$solgo]["data_srez"]);
            return $_SESSION[$solgo]["data_srez"];
            }
        
    public static function arf_proverka(){
        if(IBOT::is_bot()){ return 0; }else{ return 1; }
        }

    public static function arf_input($id,$name,$code){
        return "<input id=\"{$id}\" type=\"hidden\" class=\"form-control\" name=\"{$name}\" value=\"{$code}\" >";
        }

	}
?>
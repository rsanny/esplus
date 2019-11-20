<?php 
namespace DorrBitt\ParseType;
use DorrBitt\ClassDebug\ClassDebug;

class ParseType {

	public static function pt_int($pti){
		return (intval($pti) > 0) ? intval($pti) : 0;
		}
	
		public static function pt_numeric($pti){
		return (is_numeric($pti) > 0) ? is_numeric($pti) : 0;
		}
		
	public static function pt_md5($ptmd){
		return md5($ptmd);
		}
		
	public static function pt_add_slash($ptas){
		return addslashes($ptas);
		}
		
	public static function pt_add_hschar($ptas){
		return htmlspecialchars($ptas);
		}
		
	public static function len($ptlen){
		return strlen($ptlen);
		}
		
	public static function pt_trim($ptt){
		return trim($ptt);
		}
		
	public static function pt_empty($pte){
		return (empty($pte)) ? 1 : 0;
		}
		
	public static function pt_str($pts,$pts_arg){
		return $pts_result = (eregi($pts_arg,$pts)) ? 1 : 0;
		}
		
	public static function pt_mail($ptm){
		return (preg_match('/[\w\.\-]+@\w+[\w\.\-]*?\.\w{2,4}/',$ptm)) ? 1 : 0;
		}
		
	public static function pt_number($ptn){
		return (eregi("[^0-9]",$ptn)) ? 1 : 0;
		}
		
	public static function pt_phone($ptf){
	    return (preg_match('/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $ptf)) ? 1 : 0;
		}
		
	public static function ptPhoneValid($ptf){
		return (preg_match('/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $ptf)) ? 1 : 0;
		}

	public static function pt_replace($ptrp,$ptrp_par){
		return str_replace($ptrp_par[0],$ptrp_par[1],$ptrp);
		}
		
	public static function pt_ord($pto){
		if(ord($pto) == 34){
		    return '"';
			}
		elseif(ord($pto) == 39){
		    return "'";
			}
		}
	}
?>
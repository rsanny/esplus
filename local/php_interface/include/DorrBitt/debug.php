<?php 

namespace DorrBitt\ClassDebug;

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
?>
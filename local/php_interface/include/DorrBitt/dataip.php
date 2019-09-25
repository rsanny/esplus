<?php 
namespace DorrBitt\DBIP;
use DorrBitt\ClassDebug\ClassDebug;

Class RemoveIP {

    public function __construct(){
        //$_SERVER["REMOTE_ADDR"] = "54.36.149.0";
        $this->rAddip = $_SERVER["REMOTE_ADDR"]; 
    }

    public function lisp(){
        return [
            "66.249.64.134",
            "36.57.177.146",
            "66.249.64.136",
            "66.249.64.138",
            "62.224.186.244",
            "149.154.69.178",
            "199.16.157.181",
            "46.229.168.151",
            "54.36.149.0",
            "95.108.213.30",
            "46.229.168.142",
        ];
    }

    public function tIPexit(){
        if(in_array($this->rAddip,$this->lisp())){
            exit;
        }
    }
}
?>
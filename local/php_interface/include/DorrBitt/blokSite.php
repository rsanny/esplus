<?php 
namespace DorrBitt\bloksite;

class BlokSite {


    public function ref_basa(){
        return "http://www.paessler.com/prtgcloudbot";
        //return "http://vlichnyi-kabinet.ru/energosbyt-plyus-lichnyy-kabinet.html";
    }

    public function referesh(){
        //$_SERVER['HTTP_REFERER'] = "http://vlichnyi-kabinet.ru/energosbyt-plyus-lichnyy-kabinet.html?wqewerewer=asdsax";
        $ref_exp = explode("?",$_SERVER['HTTP_REFERER']);
        $ref_url = $ref_exp[0];
        $ref_url = trim($ref_url);
        $ref_url = addslashes($ref_url);
        $ref_url = htmlspecialchars($ref_url);
        return $ref_url;
    }

    public function bloks_site(){
        $url = $this->referesh();
        if($url == $this->ref_basa()){
            exit;
        }
    }

    public function GET(){
        $dataGET = [];
        
        foreach($_GET as $kget=>$vget){
            $dataGET[] = $kget;
        }
        return $dataGET; 
    }

    public function bloks_site_get(){
        $urlGet = $this->GET();
        if(in_array("WEB_FORM_ID",$urlGet)){
            //exit;
        }
    }
}
?>
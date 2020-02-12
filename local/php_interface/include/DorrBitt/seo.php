<?php 
namespace DorrBitt\seo;
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\ClassDBase;

Class SEO extends ClassDBase {

    /*public function __construct(){
        $obj = new ClassDBase();
    }*/

    public function seoTitle($param){
        $dataNameTitle = $this->initQuery4(
            "b_iblock_element,b_iblock_element_property",
            [
                "b_iblock_element.NAME as NAME",
            ],
            [
                ["b_iblock_element_property.VALUE","=",$param],
                ["b_iblock_element_property.IBLOCK_ELEMENT_ID","=","b_iblock_element.ID"],
            ],
            1,
            0
          );
          return $dataNameTitle[0]["NAME"];
    }

}
?>
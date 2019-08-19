<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$count_file=$_POST["count_file"]-1;
$sizes=$_POST["sizes"]-$_POST["size_img"];
$id_del=$_POST["del"];

        //if(!isset($_COOKIE["imageIdLoad"])) {
            //setcookie("imageIdLoad", implode(",", $fid));
        /*}
        else
        {*/
            $arrLoadImg=explode(",",$_COOKIE["imageIdLoad"]);
            unset($arrLoadImg[$id_del]);
            setcookie("imageIdLoad", implode(",",$arrLoadImg));
        //}



$data = array("count_file"=>$count_file,"sizes"=>$sizes,"files"=>$arrLoadImg[$id_del]);
echo json_encode($data);
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
session_start();
$data = array();
global $APPLICATION;

    function translit($str)
    {
        $tr = array(
            "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
            "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
            "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
            "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
            "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
            "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
            "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
            "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
            "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
            "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
            "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
            "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
            "ы"=>"yi","ь"=>"'","э"=>"e","ю"=>"yu","я"=>"ya",
            "."=>"."," "=>"_","?"=>"_","/"=>"_","\\"=>"_",
            "*"=>"_",":"=>"_","*"=>"_","\""=>"_","<"=>"_",
            ">"=>"_","|"=>"_"
        );
        return strtr($str,$tr);
    }

    $error = false;
    $files = array();
    $sum_size=0;

    $uploaddir = './uploads/'; // . - текущая папка где находится submit.php

    // Создадим папку если её нет

    if (!is_dir($uploaddir)) mkdir($uploaddir, 0777);

    $extTrue=array("jpg", "jpeg", "png", "bmp","pdf", "doc", "docx", "rtf", "xls", "xlsx");
    $extFlag=true;
    $doubleFlag=true;
    $filesDir = scandir($uploaddir); //загруженные файлы.
    // переместим файлы из временной директории в указанную

    foreach ($_FILES as $file) {
        $sum_size=$sum_size+$file["size"];
        $sizesArr[]=$file["size"];
    }
    foreach ($_FILES as $file) {
        if($extFlag) {
            $extArray = explode(".", $file['name']);
            $ext=array_pop($extArray);
            if(!in_array($ext,$extTrue))
            {
                $extFlag=false;
                $error=true;
                $error_text="Недопустимое расширение загружаемого файла.";
            }
        }
        if($doubleFlag) {
            if (in_array(translit($file['name']), $filesDir)):
                $count_file = intval($count_file) - 1;
                $sum_size = floatval($sum_size) - (floatval($sum_size) + floatval($file["size"]));
                $doubleFlag = false;
                $error = true;
                $error_text = ""; //
            endif;
        }

    }




$count_file=intval(count($_FILES)+$_POST["count_file"]);

$sizes=$sum_size/1024/1024+$_POST["sizes"];

    if($count_file>6):
        $error = true;
        $error_text="Загружаемых файлов не должно быть больше шести.";
    endif;

    if($sizes>10):
        $error = true;
        $error_text="Общий вес файлов не должен привышать 10мб.";
    endif;

    if($error===false):
        foreach ($_FILES as $file) {
            if (move_uploaded_file($file['tmp_name'], $uploaddir . basename(translit($file['name'])))) {
                $files_upload[] = realpath($uploaddir . translit($file['name']));
                //$files[] = CFile::GetFileArray(realpath($uploaddir . translit($file['name'])));
            } else {
                $error = true;
                $error_text="Ошибка загрузки файлов.";
            }
        }

        foreach($files_upload as $path)
        {
            $files_make_array[] = CFile::MakeFileArray($path);
        }
        foreach($files_make_array as $key=>$arImg)
        {
            if (strpos($arImg["tmp_name"], "doc") !== false || strpos($arImg["tmp_name"], "docx")!== false || strpos($arImg["tmp_name"], "rtf")!== false) {
                $files_make_array_new[$key]=$arImg;
                $files_make_array_new[$key]["tmp_name"] = "/home/bitrix/www/local/media/icons/icon-file--doc.png";
            }
            elseif(strpos($arImg["tmp_name"], "xls") !== false || strpos($arImg["tmp_name"], "xlsx")!== false)
            {
                $files_make_array_new[$key]=$arImg;
                $files_make_array_new[$key]["tmp_name"] = "/home/bitrix/www/local/media/icons/icon-file--exl.png";
            }
            elseif(strpos($arImg["tmp_name"], "pdf") !== false)
            {
                $files_make_array_new[$key]=$arImg;
                $files_make_array_new[$key]["tmp_name"] = "/home/bitrix/www/local/media/icons/icon-file--pdf.png";
            }
            else
            {
                $files_make_array_new[$key]=$arImg;
            }
        }

        foreach($files_make_array_new as $img_arr)
        {
            $fid[] = CFile::SaveFile($img_arr, "form");
        }

        //$APPLICATION->set_cookie("ID_LOAD_FILES", $fid, time()+60*60*24*30*12*2, "/");

        if(!isset($_COOKIE["imageIdLoad"])) {
            setcookie("imageIdLoad", implode(",", $fid), time() + 3600,"/");
        }
        else
        {
            $arrLoadImg=explode(",",$_COOKIE["imageIdLoad"]);
            $newFileIDs=array_merge($arrLoadImg,$fid);
            setcookie("imageIdLoad", implode(",", $newFileIDs), time() + 3600,"/");
        }

        foreach($fid as $key => $id_file)
        {
            $files[$key]= CFile::ResizeImageGet($id_file, array('width'=>50, 'height'=>50), BX_RESIZE_IMAGE_EXACT, true);
            $files[$key]["size"]=$sizesArr[$key];
        }


        $error=false;
    endif;

    //$APPLICATION->set_cookie("miniImagePath", $files, time()+60*60*24*30*12*2, "/");

    if($error===true)
    {
        $data =array('error' =>  $error_text,'files' =>"false");//,"count_file"=>$count_file,"sizes"=>$sizes
    }
    else
    {
        $data = array('error' => 'false','files' => $files,"count_file"=>$count_file,"sizes"=>$sizes);
    }

    echo json_encode($data);
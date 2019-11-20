<?php 
namespace DorrBitt\DBXLS;

class DBXLS {
    
    public static function root(){
        return $_SERVER["DOCUMENT_ROOT"];
    }

    public static function folderLib(){
        return "/local/php_interface/include/DorrBitt/libXls";
    }

    public static function folderLibSimple(){
        return "/local/php_interface/include/DorrBitt/simpleXls";
    }

    public static function parse_excel_file( $filename ){
        // путь к библиотеки от корня сайта
        $putLib = self::root().self::folderLib();
        require($putLib.'/PHPExcel.php');
        $result = array();
        // получаем тип файла (xls, xlsx), чтобы правильно его обработать
        $file_type = \PHPExcel_IOFactory::identify( $filename );
        // создаем объект для чтения
        $objReader = \PHPExcel_IOFactory::createReader( $file_type );
        $objPHPExcel = $objReader->load( $filename ); // загружаем данные файла
        $result = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные
    
        return $result;
    }

    public static function parseExcelFileSimpleXls( $filename ){
        // путь к библиотеки от корня сайта
        $putLib = self::root().self::folderLibSimple();
        require($putLib.'/SimpleXLSX.php');
        $result = array();
        $xlsx = \SimpleXLSX::parse($filename);
        return $xlsx->rows();
    }

} 
?>
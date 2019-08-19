<?
exit(1);
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");


CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

$setiblock = 21;

  $params = array(
      "max_len" => "100", 
      "change_case" => "L", 
      "replace_space" => "-", 
      "replace_other" => "-", 
      "delete_repeat_replace" => "true", 
      "use_google" => "false", 
   ); 
$trans = "ru";


$rsSectsectserv = CIBlockSection::GetList(Array("SORT"=>"ASC"), array('ACTIVE'=>'Y','IBLOCK_ID' => $setiblock),true,Array("ID","NAME","SECTION_PAGE_URL","DEPTH_LEVEL","IBLOCK_SECTION_ID"),true);
while($arSectsectserv = $rsSectsectserv->GetNext())
{

$bssect = new CIBlockSection;

$arFieldssect = Array(
  "CODE" => CUtil::translit($arSectsectserv['NAME'], $trans, $params),
  );

$ressect = $bssect->Update($arSectsectserv["ID"], $arFieldssect);
}



$arSelectcheck = Array("ID","NAME");
$arFiltercheck = Array("IBLOCK_ID"=>$setiblock);
$rescheck = CIBlockElement::GetList(Array(), $arFiltercheck, false, Array("nPageSize"=>100000), $arSelectcheck);

$gdfgdg = $rescheck->SelectedRowsCount();

echo "<br>(".$gdfgdg.")<br> Постраничка <br>".$rescheck->NavPrint()." <br>";

if($gdfgdg >0) {
while($obcheck = $rescheck->GetNextElement())
{
  $arFields = $obcheck->GetFields();


echo "<br>".$arFields['NAME']."<br>";

 



$elupd = new CIBlockElement;

$arLoadProductArrayupd = Array(
  "CODE"           => CUtil::translit($arFields['NAME'].'-'.$arFields['ID'], $trans, $params),
  );

$resupd = $elupd->Update($arFields['ID'], $arLoadProductArrayupd);


}

}

?>



 
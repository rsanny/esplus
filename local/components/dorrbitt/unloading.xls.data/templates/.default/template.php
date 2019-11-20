<?
/*print('<pre>-----'); 
print_r($arResult); 
print('</pre>');*/
if(is_array($arResult)){
    (!empty($arResult["NAME"])) ? print("<h1>{$arResult["NAME"]}</h1>") : print("");
    (!empty($arResult["DESCRIPTION"])) ? print("<div class=\"text-wrap\">{$arResult["DESCRIPTION"]}</div>") : print("");
}         
?>
<div class="heig" ></div>
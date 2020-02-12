<?

if(is_array($arResult)){
    (!empty($arResult["NAME"])) ? print("<h1>{$arResult["NAME"]}</h1>") : print("");
    (!empty($arResult["DETAIL_TEXT"])) ? print("<div class=\"text-wrap\">{$arResult["DETAIL_TEXT"]}</div>") : print("");
} 

(empty($arResult["DETAIL_TEXT"])) ? print("<div class=\"heig\" ></div>") : print("");
?>
<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;
//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

$strReturn .= '<nav class="breadcrumb">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? '&nbsp;&nbsp;/&nbsp;&nbsp;' : '');
    $strReturn .= $arrow;
    
	if($arResult[$index]["LINK"] <> "")
	{
		$strReturn .= '<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="url">'.$title.'</a>';
	}
	else
	{
		$strReturn .= '<span>'.$arResult[$index]["LINK"].$title.'</span>';
	}
}

$strReturn .= '</nav>';

return $strReturn;

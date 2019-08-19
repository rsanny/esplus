<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="row">
    <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-md-3 offset-lg-3 offset-xl-4">
        <noindex>
            <?
            $APPLICATION->IncludeComponent( 
                "bitrix:main.register", 
                "", 
                Array( 
                    "USER_PROPERTY_NAME" => "", 
                    "SEF_MODE" => "N", 
                    "SHOW_FIELDS" => Array(
                        "EMAIL", 
                        "NAME", 
                        "LAST_NAME", 
                    ), 
                    "REQUIRED_FIELDS" => Array(
                        "EMAIL", 
                        "NAME", 
                        "LAST_NAME",
                    ), 
                    "AUTH" => "Y", 
                    "USE_BACKURL" => "Y", 
                    "AUTH_URL" => $arResult["AUTH_AUTH_URL"],
                    "SUCCESS_PAGE" => $APPLICATION->GetCurPageParam('',array('backurl')), 
                    "SET_TITLE" => "N", 
                    "USER_PROPERTY" => Array() 
                ) 
            );
            ?>
        </noindex>
    </div>
</div>
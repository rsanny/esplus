<div class="catalog-menu--sidebar hidden-sm-down">
<? $APPLICATION->IncludeFile(INCLUDE_PATH . '/site/shop/sidebar/links--offers.php', Array(), Array("MODE"=> "html"));?>
<? $APPLICATION->IncludeFile(INCLUDE_PATH . '/site/shop/sidebar/links--products.php', array('arCurSection'=>$arSettings['CURRENT_SECTION']), Array("MODE"=> "html"));?>
<? $APPLICATION->IncludeFile(INCLUDE_PATH . '/site/shop/sidebar/links--service.php', Array('arCurSection'=>$arSettings['CURRENT_SECTION_CODE']), Array("MODE"=> "html"));?>
</div>
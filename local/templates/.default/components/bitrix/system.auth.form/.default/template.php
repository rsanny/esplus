<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
	ShowMessage($arResult['ERROR_MESSAGE']);
?>
<form name="system_auth_form<?=$arResult["RND"]?>" class="popup" method="post" target="_top" action="<?//=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
<?foreach ($arResult["POST"] as $key => $value):?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />
	
	<div class="form-control__label">
		<input type="text" name="USER_LOGIN" value="<?=$arResult["USER_LOGIN"]?>" class="form-control" placeholder="Введите ваш e-mail" />
	</div>
	<div class="form-control__label">
		<input type="text" class="form-control" placeholder="Введите пароль" name="USER_PASSWORD" autocomplete="off" />
	</div>
			
<?if($arResult["SECURE_AUTH"]):?>
	<span class="bx-auth-secure" id="bx_auth_secure<?=$arResult["RND"]?>" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
		<div class="bx-auth-secure-icon"></div>
	</span>
	<noscript>
	<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
		<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
	</span>
	</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
</script>
<?endif?>
	<div class="text-right form-action">
		<noindex><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" class="password-reset form-action__link" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></noindex>
		<button type="submit" name="Login" class="btn btn-orange">ВОЙТИ</button>
	</div>
		<?/*<input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />*/?>
		
<?if($arResult["AUTH_SERVICES"]):?>
</form>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "flat", 
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"SUFFIX"=>"form",
	), 
	$component, 
	array("HIDE_ICONS"=>"Y")
);
?>
<?endif?>


<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "", 
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"AUTH_URL"=>$arResult["AUTH_URL"],
		"POST"=>$arResult["POST"],
		"POPUP"=>"Y",
		"SUFFIX"=>"form",
	), 
	$component, 
	array("HIDE_ICONS"=>"Y")
);
?>
<?endif?>
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
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
pr($arResult);
$arResult["SHOW_FIELDS"] = [
    //LOGIN
    'EMAIL',
    'PASSWORD',
    'CONFIRM_PASSWORD',
    'NAME',
    'LAST_NAME',
];
?>
<?if($USER->IsAuthorized()):?>

<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>
<div id="errors-block">
<?
if (count($arResult["ERRORS"]) > 0):
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);
    
    unset($arResult["ERRORS"]["LOGIN"]);
	echo FormatHelper::Error(implode("<br />", $arResult["ERRORS"]));
endif?>
</div>
<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
<?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;
?>
    <input type="hidden" name="REGISTER[LOGIN]" value="<?=$arResult["VALUES"]["EMAIL"]?>">
<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
    <div class="form-group text-left">
        <label class="form-label mb-10"><?=GetMessage("REGISTER_FIELD_".$FIELD)?></label>
    <?
	switch ($FIELD)
	{
		case "PASSWORD":
			?>
            <div class="form-control--container">
                <a class="password-show fa-eye-slash fa js-PasswordText"></a>
                <input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="form-control" autocomplete="off">
            </div>
            <?
			break;
		case "CONFIRM_PASSWORD":
			?>
            <div class="form-control--container">
                <a class="password-show fa-eye-slash fa js-PasswordText"></a>
                <input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="form-control" autocomplete="off">
            </div>
            <?
			break;
		default:
			?>
            <input type="text" name="REGISTER[<?=$FIELD?>]" maxlength="255" value="<?=$arResult["VALUES"][$FIELD]?>" class="form-control">
        <?
	}?>
    </div>
<?endforeach?>
    <div class="form-group">
        <div class="checkbox for-rules mt-10"><label><input type="checkbox" id="reg-agree" value="Y" checked=""><i></i><span>Нажимая кнопку "Зарегистрировать", я предоставляю персональные данные и соглашаюсь с обработкой моих персональных данных ОАО "ЭнергосбыТ Плюс" в соответствии с <a href="/privacy/" target="_blank">Политикой обработки персональных данных</a></span></label></div>
    </div>
    <div class="btn-action text-center">
        <p><button class="btn btn-grey w-200" type="submit" name="register_submit_button" value="Регистрация"><span class="fa-angle-btn">Регистрация</span></button></p>
        <a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow" class="dashed">Авторизация</a>
    </div>
</form>
<script type="text/javascript">
$(function(){
    $('body').on('change','input[name="REGISTER[EMAIL]"]',function(){
        $('input[name="REGISTER[LOGIN]"]').val($(this).val());
    });
});
</script>
<?endif?>
<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$authResult = $APPLICATION->arAuthResult;
?>
<div class="row">
    <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-md-3 offset-lg-3 offset-xl-4">
        <form method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform" id="popup-change-password-form">
            <input type="hidden" name="AUTH_FORM" value="Y">
            <input type="hidden" name="TYPE" value="CHANGE_PWD">
            <? if($authResult['TYPE']=='OK'):?>
                <?=FormatHelper::Success('Пароль успешно изменен.<br>На ваш email высланы новые регистрационные данные.');?>
            <? elseif($authResult['MESSAGE']):?>
                <?=FormatHelper::ERROR($authResult['MESSAGE']);?>
            <?endif?>
            <?if($authResult['TYPE']!='OK'):?>
            <input type="hidden" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>">
            <input type="hidden" name="USER_CHECKWORD" value="<?=$arResult["USER_CHECKWORD"]?>">
            <div class="form-group text-left">
                <label class="form-label mb-10"><?echo GetMessage("AUTH_NEW_PASSWORD_REQ")?></label>
                <div class="form-control--container">
                    <a class="password-show fa-eye-slash fa js-PasswordText"></a>
                    <input type="password" class="form-control" name="USER_PASSWORD"value="" autocomplete="off">
                </div>
            </div>
            <div class="form-group text-left">
                <label class="form-label mb-10"><?echo GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?></label>
                <div class="form-control--container">
                    <a class="password-show fa-eye-slash fa js-PasswordText"></a>
                    <input type="password" class="form-control" name="USER_CONFIRM_PASSWORD" value="" autocomplete="off">
                </div>
            </div>
            <div class="btn-action text-center">
                <p><button class="btn btn-grey w-200" type="submit" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>"><span class="fa-angle-btn"><?=GetMessage("AUTH_CHANGE")?></span></button></p>
            </div>
            <?endif?>
        </form>
    </div>
</div>
<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>
<?
if ($arResult["strProfileError"])
    echo FormatHelper::Error($arResult["strProfileError"]);

if ($arResult['DATA_SAVED'] == 'Y') {
	echo FormatHelper::Success(GetMessage('PROFILE_DATA_SAVED'));
}
?>
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
    <div class="row">
        <div class="col col-12 col-md-10 col-lg-8">
            <?=$arResult["BX_SESSION_CHECK"]?>
            <input type="hidden" name="lang" value="<?=LANG?>">
            <input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
            <input type="hidden" name="LOGIN" value="<? echo $arResult["arUser"]["LOGIN"]?>">
            <div class="row form-group flex-vertical">
                <div class="col col-12 col-md-4 offset-md-2 text-left text-md-right form-label">
                    <?=GetMessage('NAME')?> <span class="text-danger">*</span>
                </div>
                <div class="col col-12 col-md-6">
                    <input class="form-control" type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>">
                </div>
            </div>
            <div class="row form-group flex-vertical">
                <div class="col col-12 col-md-4 offset-md-2 text-left text-md-right form-label">
                    <?=GetMessage('LAST_NAME')?> <span class="text-danger">*</span>
                </div>
                <div class="col col-12 col-md-6">
                    <input class="form-control" type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>">
                </div>
            </div>
            <input class="form-control" readonly type="hidden" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>">
            <!--<div class="row form-group flex-vertical">
                <div class="col col-12 col-md-4 offset-md-2 text-left text-md-right form-label">
                    <?=GetMessage('EMAIL')?>
                </div>
                <div class="col col-12 col-md-6">
                    <input class="form-control" readonly type="text" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>">
                </div>
            </div>
            <div class="row form-group flex-vertical">
                <div class="col col-12 col-md-4 offset-md-2 text-left text-md-right form-label"><?=GetMessage('NEW_PASSWORD_REQ')?></div>
                <div class="col col-12 col-md-6">
                    <div class="form-control--container">
                        <a class="password-show fa-eye-slash fa js-PasswordText"></a>
                        <input class="form-control" type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row form-group flex-vertical">
                <div class="col col-12 col-md-4 offset-md-2 text-left text-md-right form-label"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></div>
                <div class="col col-12 col-md-6">
                    <div class="form-control--container">
                        <a class="password-show fa-eye-slash fa js-PasswordText"></a>
                        <input class="form-control" type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off">
                    </div>
                </div>
            </div>-->
        </div>
    </div>          
    <div class="btn-action text-center">
        <p><button class="btn btn-grey w-170" type="submit" name="save" value="<?=GetMessage("MAIN_SAVE")?>"><span class="fa-angle-btn"><?=GetMessage("MAIN_SAVE")?></span></button></p>
    </div>
</form>  

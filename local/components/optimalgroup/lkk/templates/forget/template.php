<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$formName = $arParams['FORM_NAME'];
if ($arResult['SUCCESS']):
    if ($arParams['REDIRECT_URL'])
        LocalRedirect($arParams['REDIRECT_URL'], true);
    unset($arResult['POST']);
endif;?>
<form action="<?=$APPLICATION->GetCurPage();?>" method="post">
    <?=bitrix_sessid_post()?>
    <input type="hidden" name="<?=$formName;?>[method]" value="ForgotPassword">
    <input type="hidden" name="<?=$formName;?>[application]" value="11">
    <input type="hidden" name="<?=$formName;?>[type]" value="<?=$arParams['SITE_TYPE'];?>">
    
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-6 offset-lg-6">
        <?
        if ($arResult['ERRORS']['VISIBLE']){
            echo FormatHelper::Error(implode('<br>',$arResult['ERRORS']['VISIBLE']));
        }
        if ($arResult['SUCCESS'])
            echo FormatHelper::Success($arResult['SUCCESS']['Message']);
        ?>
        </div>
        <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2 text-md-right text-left form-label">E-mail, указанный при регистрации</div>
        <div class="col col-12 col-md-6">
            <div class="form-control--container">
                <input class="form-control<? if ($arResult['ERRORS']['FIELDS']['login']):?> is-error<? endif;?>" value="<?=$arResult['POST']['login'];?>" name="<?=$formName;?>[login]" placeholder="">
                <i class="form-control--question js-toolTip" data-text="Новый пароль будет отправлен вам на e-mail "></i>
            </div>
        </div>
    </div>
    <div class="row flex-vertical">
        <div class="col col-12 col-md-6 offset-md-6 form-group text-center col-mt-md-20">
            <button class="btn btn-orange w-170" name="get_counters" data-action="btn-ajax-load">Восстановить</button>
        </div>
    </div>
</form>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$formName = $arParams['FORM_NAME'];
if ($arResult['SUCCESS']):
//TODO: MAKE VARIABLES IN COMPONENTS PARAMS
?>
<script>
    $(function(){
        OptimalGroup.analytics.Submit(window.AuthAnalytics.<?=$arResult['USER_TYPE'];?>);
    });
</script>
<? 
    if (
        $arResult['POST']['login'] && 
        $arResult['POST']['password'] && 
        $arParams['REDIRECT_URL']
    ){
        $url = str_replace(["#LOGIN#", "#PASSWORD#"], [$arResult['POST']['login'], $arResult['POST']['password']], $arParams['REDIRECT_URL']);
        LocalRedirect($url, true);
    }

endif;?>
<section class="auth-inline hidden-md-down">
    <div class="container">
        <form action="<?=$APPLICATION->GetCurPage();?>" method="post">
            <?=bitrix_sessid_post()?>
            <input type="hidden" name="<?=$formName;?>[method]" value="Authentication">
            <input type="hidden" name="<?=$formName;?>[application]" value="11">
            <input type="hidden" name="<?=$formName;?>[type]" value="<?=$arParams['SITE_TYPE'];?>">
            
            <input type="hidden" name="yur" value="<?=$arParams['SITE_TYPE'] == "business"?1:0?>">
            <div class="auth-inline--label with-link">
                Вход  в личный кабинет:<br>
                <a href="#" class="dashed">Войти в старый ЛКК</a>
            </div>
            <div class="form-control--container">
                <input class="form-control<? if ($arResult['ERRORS']):?> is-error<? endif;?>" name="<?=$formName;?>[login]" type="text" placeholder="Лицевой счет или e-mail" value="<?=$arResult['POST']['login'];?>" required>
            </div>
            <div class="form-control--container">
                <a class="password-show fa-eye-slash fa js-PasswordText"></a>
                <input class="form-control<? if ($arResult['ERRORS']):?> is-error<? endif;?>" name="<?=$formName;?>[password]" type="password" placeholder="Пароль" value="<?=$arResult['POST']['password'];?>" required>
                <? if ($arResult['ERRORS']):?>
                <div class="form-group-error">Неверный логин или пароль</div>
                <? endif;?>
            </div>
            <button class="btn btn-grey w-170" type="submit" data-action="btn-ajax-load"><span class="fa-angle-btn">Войти</span></button>
            <div class="auth-inline--forget ib">
                <a href="/password-recovery/" class="dashed" target="_blank">Забыли пароль ?</a><br>                
                <? if ($arParams['SITE_TYPE'] == "home"):?>
                <a href="/registration/" class="dashed">Зарегистрироваться</a>
                <? else:?>
                <a href="/business/service/pc/" class="dashed">Зарегистрироваться</a>
                <? endif;?>
            </div>
        </form>
    </div>
</section>
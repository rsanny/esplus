<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$formName = $arParams['FORM_NAME'];
?>
<? 
if ($arResult['SUCCESS']):
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
endif;
?>
<div class="header-auth--form none <?=$arParams['CLASS'];?>">
    <form action="<?=$APPLICATION->GetCurPage();?>" method="post">
        <?=bitrix_sessid_post()?>
        <input type="hidden" name="<?=$formName;?>[method]" value="Authentication">
        <input type="hidden" name="<?=$formName;?>[application]" value="11">
        
        <div class="one-radio js-OneRadio" data-toggle-class=".header-auth--form">
            <label data-value="fiz"<? if ($arParams['SITE_TYPE'] == "home"):?> class="is-selected"<? endif;?>><i></i>Для дома</label>
            <label data-value="yur"<? if ($arParams['SITE_TYPE'] == "business"):?> class="is-selected"<? endif;?>><i></i>Для бизнеса</label>
            <input type="hidden" name="<?=$formName;?>[type]" value="<?=$arParams['SITE_TYPE'];?>">
            <span<? if ($arParams['SITE_TYPE'] == "business"):?> class="is-selected-1"<? endif;?>></span>
        </div>
        <div class="header-auth--fields">
            <div class="form-group text-left is-fiz">
                <label class="form-label mb-10">Номер лицевого счета или e-mail</label>
                <input type="text" name="<?=$formName;?>[login]" placeholder="Лицевой счет или e-mail" value="<?=$arResult['POST']['login'];?>" class="form-control<? if ($arResult['ERRORS']):?> is-error<? endif;?>">
            </div>
            <div class="form-group">
                <div class="clearfix mb-10">
                    <label class="form-label pull-left">Пароль</label>
                    <div class="pull-right">
                        <a href="/password-recovery/" class="dashed is-fiz" target="_blank">Забыли пароль ?</a>
                    </div>
                </div>
                <div class="form-control--container">
                    <a class="password-show fa-eye-slash fa js-PasswordText"></a>
                    <input type="password" name="<?=$formName;?>[password]" value="<?=$arResult['POST']['password'];?>" placeholder="Пароль" class="form-control<? if ($arResult['ERRORS']):?> is-error<? endif;?>">
                    <? if ($arResult['ERRORS']):?>
                    <div class="form-group-error">Неверный логин или пароль</div>
                    <? endif;?>
                </div>
            </div>
            <div class="btn-action text-center">
                <p><button class="btn btn-grey w-170" data-action="btn-ajax-load" type="submit"><span class="fa-angle-btn">Войти</span></button></p>
                <p><a href="/registration/" class="dashed  header-auth--home">Зарегистрироваться</a></p>
                <a href="#" class="dashed">Войти в старый ЛКК</a>
            </div>
        </div>
    </form>
    <? if($arParams['BRANCH']['URL'] == 'oren'):?>
    <div class="none auth-warning text-left">
        Уважаемые клиенты!<br>
        В связи с проведением технических работ Личный кабинет ОАО «ЭнергосбыТ Плюс» для юридических лиц недоступен.<br>
        Приносим извинения за доставленные неудобства.
    </div>        
    <? endif;?>
</div>
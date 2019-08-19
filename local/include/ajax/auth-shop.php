<?
global $OptimalGroup;
?>
<div class="text-center mb-10 form-group--title">Вход через ЛК Клиента ЭнергосбыТ Плюс</div>
<form name="" action="" method="POST" data-apiurl="<?=$OptimalGroup['BRANCH']['API_URL']?:'https://lkk-ekb.esplus.ru'?>" id="AuthESplusForm">
    <input type="hidden" name="USER_TYPE" value="fiz">
    <input type="hidden" name="AUTH_FORM" value="Y" />
    <input type="hidden" name="TYPE" value="AUTH" />
    <?=bitrix_sessid_post()?>
    <div class="form-group text-left">
        <label class="form-label mb-10">Номер лицевого счета или e-mail</label>
        <input type="text" name="login" placeholder="Лицевой счет или e-mail" class="form-control" autocomplete="off">
    </div>
    <div class="form-group">
        <div class="clearfix mb-10">
            <label class="form-label pull-left">Пароль</label>
            <div class="pull-right">
                <a href="/password-recovery/" class="dashed header-auth--home">Забыли пароль ?</a>
            </div>
        </div>
        <div class="form-control--container">
            <a class="password-show fa-eye-slash fa js-PasswordText"></a>
            <input type="password" name="pass" placeholder="Пароль" class="form-control" autocomplete="new-password">
        </div>
    </div>
    <div class="btn-action text-center">
        <button class="btn btn-grey w-170" type="submit" name="Login" value="Y"><span class="fa-angle-btn">Войти</span></button>
    </div>
</form>
<div class="row">
    <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-md-3 offset-lg-3 offset-xl-4">
        <div class="auth--form">
            <form name="" action="" method="POST" data-apiurl="<?=$_SESSION['BXExtra']['REGION']['IBLOCK']['API_URL']?:'https://lkk-ekb.esplus.ru'?>" id="authForm">
                <input type="hidden" name="AUTH_FORM" value="Y" />
                <input type="hidden" name="TYPE" value="AUTH" />
                <?=bitrix_sessid_post()?>
                <div class="form-group text-left">
                    <label class="form-label mb-10">Номер лицевого счета или e-mail</label>
                    <input type="text" name="login" placeholder="Лицевой счет или e-mail" class="form-control">
                </div>
                <div class="form-group">
                    <div class="clearfix mb-10">
                        <label class="form-label pull-left">Пароль</label>
                        <div class="pull-right">
                            <a href="/password-recovery/" class="dashed">Забыли пароль ?</a>
                        </div>
                    </div>
                    <div class="form-control--container">
                        <a class="password-show fa-eye-slash fa js-PasswordText"></a>
                        <input type="password" name="pass" placeholder="Пароль" class="form-control">
                    </div>
                </div>
                <div class="btn-action text-center">
                    <p><button class="btn btn-grey w-170" type="submit" name="Login" value="Y"><span class="fa-angle-btn">Войти</span></button></p>
                    <? if ($_SESSION['BXExtra']['SITE']['CODE']=="home"):?>
                    <a href="/registration/" class="dashed">Зарегистрироваться</a>
                    <? else:?>
                    <a href="/business/service/pc/" class="dashed">Зарегистрироваться</a>
                    <? endif;?>
                </div>
            </form>                                        
        </div>
    </div>
</div>
    
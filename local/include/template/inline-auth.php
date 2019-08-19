<?
global $OptimalGroup;
?>
<? if($OptimalGroup['DOMAIN'] == "oren" && false == true):?>
    <? $APPLICATION->IncludeComponent(
        "optimalgroup:lkk", 
        "inline", 
        [
            'REDIRECT_URL' => 'https://lk.esplus.ru/Account/Authentication?login=#LOGIN#&password=#PASSWORD#',
            'SITE_TYPE' => $OptimalGroup['SITE']['CODE'],
            'BRANCH' => $OptimalGroup['BRANCH'],
            "FORM_NAME" => "inlineAuth",
            'AJAX_MODE' => 'Y',
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "AJAX_OPTION_HISTORY" => "N",
        ],
        false
    );?>
<? else:
$forgetLink = $OptimalGroup['BRANCH']['FORGET_PASSWORD'];
$LoginSign = "Лицевой счет или e-mail";
if ($OptimalGroup['SITE']['CODE']=='business'){
    $forgetLink = $OptimalGroup['BRANCH']['FORGET_PASSWORD_LEGAL'];
    $LoginSign = "Ваш e-mail (логин)";
}
?>
<section class="auth-inline hidden-md-down">
    <div class="container">
        <form id="authInline" method="POST" action="" data-apiurl="<?=$OptimalGroup['BRANCH']['API_URL']?:'https://lkk-ekb.esplus.ru'?>">
            <input type="hidden" name="yur" value="<?=$OptimalGroup['SITE']['CODE']=='business'?1:0?>">
            <div class="auth-inline--label">Вход  в личный кабинет:</div>
            <div class="form-control--container">
                <input class="form-control" name="login" type="text" placeholder="<?=$LoginSign;?>" value="" required>
            </div>
            <div class="form-control--container">
                <a class="password-show fa-eye-slash fa js-PasswordText"></a>
                <input class="form-control" name="pass" type="password" placeholder="Пароль" value="" required>
            </div>
            <button class="btn btn-grey w-170" type="submit"><span class="fa-angle-btn">Войти</span></button>
            <div class="auth-inline--forget ib">
                <a href="<?=$forgetLink;?>" class="dashed" target="_blank">Забыли пароль ?</a><br>
                
                <? if ($_SESSION['BXExtra']['SITE']['CODE']=="home"):?>
                <a href="/registration/" class="dashed">Зарегистрироваться</a>
                <? else:?>
                <a href="/business/service/pc/" class="dashed">Зарегистрироваться</a>
                <? endif;?>
            </div>
        </form>
    </div>
</section>
<? endif;?>
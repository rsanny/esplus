<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?

//if ($arResult['ERROR_MESSAGE']){
//    echo FormatHelper::Error($arResult['ERROR_MESSAGE']);
//}
?>
<div class="row">
    <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-md-3 offset-lg-3 offset-xl-4">
        <div class="text-center mb-10">
            <a href="#" class="btn btn-orange block js-ShowEsplusForm">Войти через ЛК Клиента</a>
            <div class="none" id="lk-auth-esplus">
                <? $APPLICATION->IncludeFile(AJAX_PATH."auth-shop.php", Array(), Array("SHOW_BORDER"=> false));?>
            </div>
        </div>
        <div id="bx-auth">
            <div class="mb-10 text-center">или</div>
        <?php
            $APPLICATION->IncludeComponent(
            "ulogin:auth",
            "",
            Array(
                "LOGIN_AS_EMAIL"=>"Y",
                "SEND_MAIL" => "N",
                "SOCIAL_LINK" => "Y",
                "GROUP_ID" => array("7"),
                "ULOGINID1" => "",
                "ULOGINID2" => ""
            ));
        ?>
        <form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
        <?
        if ($arParams['AUTH_RESULT']['TYPE'] == "ERROR"){
            echo FormatHelper::Error($arParams["~AUTH_RESULT"]['MESSAGE']);
        }
        elseif ($arParams['AUTH_RESULT']) {
            //echo FormatHelper::Success($arParams["~AUTH_RESULT"]['MESSAGE']);
            LocalRedirect("/personal/");
        }
        ?>

            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="AUTH" />
            <?if (strlen($arResult["BACKURL"]) > 0):?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?endif?>
            <?foreach ($arResult["POST"] as $key => $value):?>
            <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
            <?endforeach?>
            <div class="form-group text-left">
                <label class="form-label mb-10">E-mail</label>
                <input class="form-control" type="text" name="USER_LOGIN" placeholder="Введите ваш логин" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" />
            </div>
            <div class="form-group text-left">
                <div class="clearfix mb-10">
                    <label class="form-label pull-left">Пароль</label>
                    <?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
                    <div class="pull-right">
                        <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow" class="dashed">Забыли пароль ?</a>
                    </div>
                    <? endif;?>
                </div>
                <div class="form-control--container">
                    <a class="password-show fa-eye-slash fa js-PasswordText"></a>
                    <input class="form-control" type="password" name="USER_PASSWORD" placeholder="Пароль" maxlength="255" autocomplete="off" />
                </div>
            </div>
            <?if($arResult["CAPTCHA_CODE"]):?>
                 <div class="form-group text-left">
                    <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                    <div class="clearfix mb-10">
                        <label class="form-label pull-left"><?echo GetMessage("AUTH_CAPTCHA_PROMT")?></label>
                        <div class="pull-right">
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                        </div>
                    </div>
                    <div class="form-control--container">
                        <input class="form-control" type="text" name="captcha_word" maxlength="50" value="" size="15" />
                    </div>
                </div>
            <?endif;?>
            <input type="hidden" name="USER_REMEMBER" value="Y">
            <div class="btn-action text-center">
                <p><button class="btn btn-grey w-170" type="submit" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>"><span class="fa-angle-btn">Войти</span></button></p>
                <?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
                <noindex>
                    <p>
                        <a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow" class="dashed"><?=GetMessage("AUTH_REGISTER")?></a>
                    </p>
                </noindex>
                <?endif?>
            </div>
        </form>
        <script type="text/javascript">
        <?if (strlen($arResult["LAST_LOGIN"])>0):?>
        try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
        <?else:?>
        try{document.form_auth.USER_LOGIN.focus();}catch(e){}
        <?endif?>
        </script>
        </div>
    </div>
</div>
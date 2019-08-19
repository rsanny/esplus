<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? 
if ($arResult['message']):
unset($_POST['register']);
?>
<div class="text-left"><?=FormatHelper::Success('Уважаемый клиент!<br>Вам на электронную почту отравлено сообщение, содержащее ссылку для подтверждения регистрации Личного кабинета.<br><span class="color-orange">Внимание!</span> Доступ к сервису будет предоставлен после подтверждения регистрации.');?></div>

<script>
OptimalGroup.analytics.Submit({
    ga:{
        category: "dom-service",
        action: "lk-reg-fiz"
    },
    ym:"lk-reg-fiz"
});
</script>
<? else:?>
<?
if ($arResult['error']['sign_rules']){
    echo FormatHelper::Error($arResult['error']['sign_rules']);
}
if ($arResult['error']['server']){
    echo FormatHelper::Error($arResult['error']['server']);
}
?>
<form action="<?=$APPLICATION->GetCurPage();?>" method="post">
    <?=bitrix_sessid_post()?>
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-md-right text-left form-label">
            <label>№ лицевого счета <span class="color-orange">*</span></label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <div class="form-control--container">
                <input type="text" name="register[nlsid]" class="form-control <? if ($arResult['error']['nlsid']):?> is-error<? endif;?>" value="<?=$_POST['register']['nlsid'];?>">
            </div>
        </div>
    </div>
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-md-right text-left form-label">
            <label>Номер дома <span class="color-orange">*</span></label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <div class="form-container">
                <input type="text" name="register[house]" class="form-control<? if ($arResult['error']['house']):?> is-error<? endif;?>" value="<?=$_POST['register']['house'];?>">
            </div>
        </div>
    </div>
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-md-right text-left form-label">
            <label>Литера дома</label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <div class="form-container">
                <input type="text" name="register[litera]" class="form-control" value="<?=$_POST['register']['litera'];?>">
            </div>
        </div>
    </div>
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-md-right text-left form-label">
            <label>Номер квартиры</label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <div class="form-container">
                <input type="text" name="register[flat]" class="form-control" value="<?=$_POST['register']['flat'];?>">
            </div>
        </div>
    </div>
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-md-right text-left form-label">
            <label>Расширение номера квартиры</label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <div class="form-container">
                <input type="text" name="register[extflat]" class="form-control" value="<?=$_POST['register']['extflat'];?>">
            </div>
        </div>
    </div>
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-md-right text-left form-label">
            <label>E-mail адрес <span class="color-orange">*</span></label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <div class="form-control--container">
                <input class="form-control<? if ($arResult['error']['email']):?> is-error<? endif;?>" value="<?=$_POST['register']['email'];?>" name="register[email]">
                <i class="form-control--question js-toolTip" data-text="Внимание! Регистрация нескольких лицевых счетов на один email осуществляется в настройках сервиса Web кабинет после авторизации. Здесь данная возможность отсутствует"></i>
            </div>

        </div>
    </div>
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-md-right text-left form-label">
            <label>Пароль <span class="color-orange">*</span></label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <div class="form-container">
                <input type="password" name="register[password]" class="form-control<? if ($arResult['error']['password']):?> is-error<? endif;?>" value="">
            </div>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-12 col-md-8 offset-md-4 col-lg-7 offset-lg-5 text-md-left">
            <div class="checkbox for-rules"><label><input type="checkbox" name="register[get_actions]" value="Y" checked=""><i></i><span>Желаю получать суперпредложения по акциям компании</span></label></div>
            <div class="checkbox for-rules mt-10"><label><input type="checkbox" name="register[sign_rules]" value="Y" checked=""><i></i><span><?=DEFAULT_RULES_SIGN;?></span></label></div>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-12 col-md-8 offset-md-4 col-lg-7 offset-lg-5 text-md-left text-center">
            <button class="btn btn-orange w-200" name="web_form_submit" value="Зарегистрироваться" type="submit">Зарегистрироваться</button>
        </div>
    </div>
</form>
<? endif;?>
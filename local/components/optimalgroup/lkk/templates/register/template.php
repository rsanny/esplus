<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? 
$formName = $arParams['FORM_NAME'];
pr($arResult);
if ($arResult['SUCCESS']):
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
<form action="<?=$APPLICATION->GetCurPage();?>" method="post">
    <?=bitrix_sessid_post()?>
    <input type="hidden" name="<?=$formName;?>[method]" value="Registration">
    <input type="hidden" name="<?=$formName;?>[application]" value="11">
    <input type="hidden" name="<?=$formName;?>[type]" value="<?=$arParams['SITE_TYPE'];?>">
    <input type="hidden" name="<?=$formName;?>[subsidiaryId]" value="2"><? /*ID FOR BRANCH TODO: move to iblock*/?>
    
    
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-md-right text-left form-label">
            <label>№ лицевого счета <span class="color-orange">*</span></label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <div class="form-control--container">
                <input type="text" name="<?=$formName;?>[personalAccount]" class="form-control <? if ($arResult['ERRORS']['FIELDS']['personalAccount']):?> is-error<? endif;?>" value="<?=$arResult['POST']['personalAccount'];?>">
            </div>
        </div>
    </div>
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-md-right text-left form-label">
            <label>Номер дома <span class="color-orange">*</span></label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <div class="form-container">
                <input type="text" name="<?=$formName;?>[number]" class="form-control<? if ($arResult['ERRORS']['FIELDS']['number']):?> is-error<? endif;?>" value="<?=$arResult['POST']['number'];?>">
            </div>
        </div>
    </div>
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-md-right text-left form-label">
            <label>Литера дома</label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <div class="form-container">
                <input type="text" name="<?=$formName;?>[letter]" class="form-control" value="<?=$arResult['POST']['letter'];?>">
            </div>
        </div>
    </div>
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-md-right text-left form-label">
            <label>Номер квартиры</label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <div class="form-container">
                <input type="text" name="<?=$formName;?>[apartment]" class="form-control" value="<?=$arResult['POST']['apartment'];?>">
            </div>
        </div>
    </div>
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-md-right text-left form-label">
            <label>Расширение номера квартиры</label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <div class="form-container">
                <input type="text" name="<?=$formName;?>[additionalApartment]" class="form-control" value="<?=$arResult['POST']['additionalApartment'];?>">
            </div>
        </div>
    </div>
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-md-right text-left form-label">
            <label>E-mail адрес <span class="color-orange">*</span></label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <div class="form-control--container">
                <input class="form-control<? if ($arResult['ERRORS']['FIELDS']['emailAddress']):?> is-error<? endif;?>" value="<?=$arResult['POST']['emailAddress'];?>" name="<?=$formName;?>[emailAddress]">
                <i class="form-control--question js-toolTip" data-text="Внимание! Регистрация нескольких лицевых счетов на один email осуществляется в настройках сервиса Web кабинет после авторизации. Здесь данная возможность отсутствует"></i>
            </div>

        </div>
    </div>
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-md-right text-left form-label">
            <label>Пароль <span class="color-orange">*</span></label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <div class="form-control--container">
                <input type="password" name="<?=$formName;?>[password]" class="form-control<? if ($arResult['ERRORS']['FIELDS']['password']):?> is-error<? endif;?>" value="">
            </div>
        </div>
    </div>    
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-8 col-lg-7 offset-md-4 offset-lg-5">
            <div class="fs-12">Пароль должен содержать как минимум 8 символов, цифры и буквы латинского алфавита</div>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-12 col-md-8 offset-md-4 col-lg-7 offset-lg-5 text-md-left">
            <div class="checkbox for-rules"><label><input type="checkbox" name="<?=$formName;?>[newsSubscription]" value="True"<?if ($arResult['POST']['newsSubscription'] == "True" || empty($arResult['POST'])):?> checked<? endif;?>><i></i><span>Желаю получать суперпредложения по акциям компании</span></label></div>
            <div class="checkbox for-rules mt-10"><label><input type="checkbox" name="<?=$formName;?>[receiptSubscription]" value="True"<?if ($arResult['POST']['receiptSubscription'] == "True" || empty($arResult['POST'])):?> checked<? endif;?>><i></i><span>Хочу получать квитанции по электронной почте</span></label></div>
            <div class="checkbox for-rules mt-10"><label><input type="checkbox" name="<?=$formName;?>[agree]" value="Y" checked=""><i></i><span><?=DEFAULT_RULES_SIGN;?></span></label></div>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-12 col-md-8 offset-md-4 col-lg-7 offset-lg-5 text-md-left text-center">
            <button class="btn btn-orange w-200 mb-20" name="web_form_submit" value="Зарегистрироваться" type="submit" data-action="btn-ajax-load">Зарегистрироваться</button>
            <?
            if ($arResult['ERRORS']['VISIBLE']){
                echo FormatHelper::Error(implode('<br>',$arResult['ERRORS']['VISIBLE']));
            }
            ?>

        </div>
    </div>
</form>
<? endif;?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Восстановление пароля");
global $OptimalGroup;
?>
<? if ($OptimalGroup['DOMAIN'] == 'oren' && false == true):?>
<div class="content-container">
    <h1 class="form-group--title text-left text-md-center">Восстановление пароля</h1>
    <div class="row">
        <div class="col col-12 col-md-10 col-lg-8">
            <? $APPLICATION->IncludeComponent(
                "optimalgroup:lkk", 
                "forget", 
                [
                    'SITE_TYPE' => $OptimalGroup['SITE']['CODE'],
                    'BRANCH' => $OptimalGroup['BRANCH'],
                    "FORM_NAME" => "forgetPage",
                    'AJAX_MODE' => 'Y',
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "AJAX_OPTION_HISTORY" => "N",
                ],
                false
            );?>
        </div>
    </div>
</div>
<? else:?>
<div class="content-container">
    <h1 class="form-group--title text-left text-md-center">Восстановление пароля</h1>
    <div class="row">
        <div class="col col-12 col-md-10 col-lg-8">
            <form id="formPassRecovery">
                <?=bitrix_sessid_post()?>
            <div class="row form-group flex-vertical">
                <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2 text-md-right text-left form-label">E-mail, указанный при регистрации</div>
                <div class="col col-12 col-md-6">
                    <div class="form-control--container">
                        <input class="form-control" value="" name="login" placeholder="" required>
                        <i class="form-control--question js-toolTip" data-text="Новый пароль будет отправлен вам на e-mail "></i>
                    </div>
                </div>
            </div>
            <div class="row flex-vertical">
                <div class="col col-12 col-md-6 offset-md-6 form-group text-center col-mt-md-20">
                    <button class="btn btn-orange w-170" name="get_counters" value="Y">Восстановить</button>
                    <div class="js-msg" style="display: none;"></div>
                </div>
            </div>
            </form>
        <div class="col col-12 col-sm-12 col-lg-4">
        </div>
    </div>
</div>


<script>
    $('#formPassRecovery').on('submit', function(e){
        e.preventDefault();
        $form = $(this);
        $msg = $form.find('.js-msg');
        $msg.hide().removeClass('error success');
        $.ajax({
            url: '/local/include/ajax/recovery-password.php',
            data: $form.serialize(),
            dataType: 'json',
            method: 'POST',
            success: function(data){
                if(!!data.error)
                {
                    $msg.html(data.error).addClass('error').slideDown('fast');
                }
                if(!!data.message)
                {
                    $msg.html(data.message).addClass('success').slideDown('fast');
                }
            }
        });
    })
</script>
<style>
    .js-msg 
    {
        padding-top: 1rem;
    }
    .js-msg.error
    {
        color: #F44336;
    }
    .js-msg.success
    {
        color: #4CAF50;
    }
</style>
<? endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
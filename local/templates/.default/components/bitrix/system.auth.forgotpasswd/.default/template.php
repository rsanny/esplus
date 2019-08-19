<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
?>
<form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="SEND_PWD">
    <div class="row">
        <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-md-3 offset-lg-3 offset-xl-4">
            <?
            if ($arParams["~AUTH_RESULT"]['TYPE'] == "ERROR"):
                echo FormatHelper::Error($arParams["~AUTH_RESULT"]['MESSAGE']);
            
            elseif($arParams["~AUTH_RESULT"]):
                echo FormatHelper::Success($arParams["~AUTH_RESULT"]['MESSAGE']);
            else:?>
            <p>
            <?=GetMessage("AUTH_FORGOT_PASSWORD_1")?>
            </p>
            <div class="form-group text-center"><b><?=GetMessage("AUTH_GET_CHECK_STRING")?></b></div>
            <div class="form-group text-left">
                <input type="text" name="USER_LOGIN" class="form-control" placeholder="Логин" value="<?=$arResult["LAST_LOGIN"]?>" />
            </div>
            <div class="form-group text-center"><?=GetMessage("AUTH_OR")?></div>
            <div class="form-group text-left">
                <input type="text" name="USER_EMAIL" class="form-control" placeholder="E-mail" />
            </div>
            <div class="btn-action text-center">
                <p><button class="btn btn-grey w-170" type="submit" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>"><span class="fa-angle-btn"><?=GetMessage("AUTH_SEND")?></span></button></p>
                <a href="<?=$arResult['AUTH_AUTH_URL'];?>" class="dashed"><?=GetMessage("AUTH_AUTH");?></a>
            </div>
            <? endif;?>
        </div>
    </div>
</form>
<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>

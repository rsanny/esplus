<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if (!$USER->IsAuthorized()): ?>
<div class="text-center">
    <div class="mb-10">Войти через соц. сети:</div>
    <?php echo $arResult['ULOGIN_CODE']; ?>
    <div class="mt-10">или</div>
</div>
<?endif; ?>
<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>

<div class="bx-soa-empty-cart-container">
	<div class="bx-soa-empty-cart-text mb-20"><?=Loc::getMessage("EMPTY_BASKET_TITLE")?></div>
	<div class="bx-soa-empty-cart-desc mb-40">
        <a href="/" class="btn btn-grey">Нажмите здесь</a> чтобы продолжить покупки
	</div>
</div>
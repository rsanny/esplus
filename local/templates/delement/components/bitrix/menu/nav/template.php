<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult)) { ?>
	<ul class="nav">
		<? foreach ($arResult as $arItem) { ?>
			<li class="nav__item">
				<a rel="bookmark" href="<?=$arItem["LINK"]?>" data-js-scroll-to="<?=$arItem["LINK"]?>" class="nav__link">
					<?=$arItem["TEXT"]?>
				</a>
			</li>
		<? } ?>
	</ul>
<? }
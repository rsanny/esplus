<?if(!empty($arParams['TEXT_FOOTER']) && !empty($arParams['LINK_FOOTER'])) { ?>
   <a target="_blank" href=" <?=$arParams['LINK_FOOTER']?>"> <?=$arParams['TEXT_FOOTER']?></a>
<? } else { ?>
    <a href="https://esplus.ru/" target="_blank">АО «ЭнергосбыТ Плюс»</a> - объединённая энергосбытовая компания <a target="_blank" href="http://tplusgroup.ru">Группы «Т Плюс»</a>
<? } ?>
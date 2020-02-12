<?php 
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
use DorrBitt\dbCity\DBCITY;
use DorrBitt\ClassDebug\ClassDebug;
print("<div id=\"mw_close\" class=\"data_close\" onclick=\"closeID('#mw_close','#modals','#mw_overlay')\" ></div>");
print("<div id=\"loader\"></div>");
$dataTregion = DBCITY::idcity();
$dataListRegions = DBCITY::dbidcity();
$dataAct = DBCITY::dataGroupAct();
?>
<div class="soder-modal" >
<div class="title" >Уважаемые клиенты!</div>
<div class="title2" >Временно не доступны онлайн-сервисы</div>
<div class="data-content-re" >
<p>
В период <span class="mark" >с 17.01.2020 8:00 по 17.01.2020 15:00</span> (по московскому времени)
в целях повышения качества онлайн-сервисов проводятся технические работы.
</p>
<p>
Временно не доступны онлайн-сервисы (личный кабинет клиента, оплата онлайн на сайте без авторизации,
передача показаний на сайте без авторизации, проверка задолженности).
</p>
<p>
Приносим извинения за доставленные неудобства!
</p>
</div>

</div>
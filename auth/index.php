<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);
    
if ($_REQUEST['register'] == 'yes')
    $APPLICATION->SetTitle("Регистрация");
else
    $APPLICATION->SetTitle("Авторизация");

?>
<p>Спасибо, что зарегистрировались в Личном кабинете интернет-магазина ЭнергосбыТ Плюс!</p><br>
<p>Теперь вы можете отслеживать статусы и историю своих заказов.</p><br>
 
Вы успешно авторизовались и можете перейти в раздел <a href="/personal/" class="color-orange">Личный кабинет</a>, где доступны следующие возможности: отслеживание статуса заказа, история заказов, отмена сделанного заказа. 

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
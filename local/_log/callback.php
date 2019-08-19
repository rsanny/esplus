<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
global $USER;
if ($USER->GetID() != 1) LocalRedirect('/');
$LogCallback = \OptimalGroup\Core::getJSON("callback");
?>
<? foreach ($LogCallback as $date=>$array):?>
<p><b>Время запроса:</b> <?=$date;?></p>
<p><b>Переданные данные: </b>
<pre>
<? print_r($array['FORM']);?>
</pre></p>
<p><b>Ответ сервера:</b> <?=$array['RESPONSE']?$array['RESPONSE']:'Ошибок нет';?></p>
<p><b>Результат запроса:</b>
<pre>
<? print_r($array['RESPONSE_INFO']);?>
</pre></p>
<hr>
<? endforeach;?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
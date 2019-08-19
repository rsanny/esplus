<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle('Онлайн оплата');
if(!empty($_GET['order']))
{
    $api = new esplusApi(array(
        'appid' => '40',
        'uid' => 'c4abe6bf-7a57-4e82-8484-c0ca39ca0dc9',
        'key' => 'VyyD|$XVwGdlrh$u#mNDwQxTuSKHaYrQ',
        'channel' => '40',
    ));

    $arPayment = $api->CheckPayment($_GET['order']);
    $Payed = $arPayment['Amount']/100;
}
?>
<main class="content">
<div class="container">
<nav class="breadcrumb"><a href="/" title="Главная" itemprop="url">Главная</a>&nbsp;&nbsp;/&nbsp;&nbsp;<span>Онлайн-оплата</span></nav>
<h1>Онлайн оплата</h1>
<?if(empty($arPayment)):?>
    <p>Ошибка запроса</p>
<?else:?>
    <p>Оплата по счету <b>№ <?=$_GET['order']?></b> на сумму <b><?=number_format($Payed,2,'.',' ');?> руб.</b> от <b><?=date('d.m.Y H:i:s', $arPayment['Date'])?></b></p>
    <p><b><?=$arPayment['Description']?></b></p>
<?endif?>
</div>
</main>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
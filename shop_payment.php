<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle('Онлайн оплата');
$APPLICATION->AddChainItem('Онлайн-оплата');
?>
<main class="content">
    <div class="container">
        <nav class="breadcrumb"><a href="/" title="Главная" itemprop="url">Главная</a>&nbsp;&nbsp;/&nbsp;&nbsp;<span>Онлайн-оплата</span></nav>
        <h1>Онлайн оплата</h1>
        <?if(isset($_REQUEST['s'])):?>
            <div class="fs-24 color-green"><i class="fa fa-check fs-20"></i>  Оплата прошла успешно</div>
        <?else:?>
            <div class="fs-24 color-red"><i class="fa fa-close fs-24"></i>  Оплата прошла с ошибкой</div>
        <?endif?>
        <div class="mt-30">
        <? \Optimalgroup\Template::OfferBanners(array("arSettings" => array("NEWS_COUNT" => 3, "IBLOCK_ID" => 51)));?>
        </div>
        
    </div>
</main>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
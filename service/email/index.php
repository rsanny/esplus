<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Квитанция по e-mail");
require($_SERVER["DOCUMENT_ROOT"]."/service/header.php");
$Email = $_SESSION['BXExtra']['REGION']['IBLOCK']['URL']."@esplus.ru";
?>
<div class="service-form service-tabs">
	<div class="form-group--title text-left text-md-center">
		 Получить квитанцию по e-mail
	</div>
	<div class="fs-15 mb-50 text-center">
		 Выберите способ доставки удобный для Вас. Получайте квитанции на адрес<br>
		 электронной почты вместо квитанций, приходящих в бумажном виде.
	</div>
	<div class="row">
		<div class="col col-12 col-md-6 col-lg-5 offset-lg-1">
			<div class="fs-24 text-uppercase color-orange flex flex-vertical">
 <img src="<?=MEDIA_PATH;?>icons/icon-email--pc.png" alt=""><b class="ml-10">ЛИЧНЫЙ КАБИНЕТ</b>
			</div>
			<div class="ml-50 mt-10">
				<p>
 <b>Чтобы начать получать электронную квитанцию, перейдите к настройкам личного кабинета.</b>
				</p>
				<ul>
					<li>выберите способ получения квитанции в разделе настроек «Изменение способа доставки квитанции»;</li>
					<li>начните получать квитанции в электронном виде.</li>
				</ul>
			</div>
		</div>
		<div class="col col-12 col-md-6 col-lg-5 offset-lg-1">
			<div class="fs-24 text-uppercase color-orange flex flex-vertical">
 <img src="<?=MEDIA_PATH;?>icons/icon-email--email.png" alt=""><b class="ml-10">ЭЛЕКТРОННАЯ ЗАЯВКА</b>
			</div>
			<div class="ml-50 mt-10">
				<p>
 <b>Оформите электронную заявку.</b>
				</p>
				<ul>
					<li>заполните анкету-заявление</li>
					<li><p>отсканируйте заполненное заявление и вышлите нам на адрес электронной почты <a href="mailto:<?=$Email;?>" class="color-orange"><?=$Email;?></a></p>
				    <? 
                    $detailScan = '/upload/doc/'.$OptimalGroup['DOMAIN'].'/electric_order.pdf';?>
                   

                        <a href="<?=$detailScan;?>" class="btn btn-orange" target="_blank">Подробнее</a>
                   
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<? global $OptimalGroup;?>
<?
$ul_z = "/upload/doc/zayavka.doc";
if ($OptimalGroup['BRANCH']['URL'] == "kirov") {
    $ul_z = "/upload/doc/kirov/ul_z.pdf";
}
elseif ($OptimalGroup['BRANCH']['URL'] == "udm" || $OptimalGroup['BRANCH']['URL'] == "ekb" || $OptimalGroup['BRANCH']['URL'] == "oren"){
    $ul_z = "/upload/doc/".$OptimalGroup['BRANCH']['URL']."/UL_Z.doc";
} elseif ($OptimalGroup['BRANCH']['URL'] == "perm") {
    $ul_z = "/upload/doc/".$OptimalGroup['BRANCH']['URL']."/UL_Z.xlsx";
}
$ul_p = "";
if ($OptimalGroup['BRANCH']['URL'] == "kirov") {
    $ul_p = "/upload/doc/kirov/Poryadok_podklyucheniya_k_servisu.pdf";
    $ul_p_name = "Кировского филиала";
}
elseif ($OptimalGroup['BRANCH']['URL'] == "udm" || $OptimalGroup['BRANCH']['URL'] == "ekb" || $OptimalGroup['BRANCH']['URL'] == "oren" || $OptimalGroup['BRANCH']['URL'] == "perm"){
    $ul_p = "/upload/doc/".$OptimalGroup['BRANCH']['URL']."/UL_P.doc";
    if ($OptimalGroup['BRANCH']['URL'] == "udm")
        $ul_p_name = "Удмуртского филиала";
    if ($OptimalGroup['BRANCH']['URL'] == "ekb")
        $ul_p_name = "Свердловского филиала";
    if ($OptimalGroup['BRANCH']['URL'] == "oren")
        $ul_p_name = "Оренбургского филиала";

    if ($OptimalGroup['BRANCH']['URL'] == "perm") {
        $ul_p_name = "Пермского филиала";
        $ul_p = "/upload/doc/".$OptimalGroup['BRANCH']['URL']."/UL_P.docx";
    }
}
?>
<div class="service-form service-tabs">
    <div class="form-group--title text-left text-md-center">Личный кабинет клиента</div>
    <div class="fs-15 mb-50 text-center">Личный кабинет ЭнергосбыТ Плюс - это удобный сервис для работы с Вашим лицевым счетом онлайн, где бы Вы не находились.</div>
    <div class="row">
        <div class="col col-12 col-md-4 col-lg-4 mb-30">
            <div class="mlra round-105 text-center mb-20">
                <img src="<?=MEDIA_PATH;?>icons/icon-pc--post.png" alt="">
            </div>
            <div class="text-center fs-14 text-uppercase">Передать показания<br>Ваших приборов учета</div>
        </div>
        <div class="col col-12 col-md-4 col-lg-4 mb-30">            
            <div class="mlra round-105 text-center mb-20">
                <img src="<?=MEDIA_PATH;?>icons/icon-pc--mail.png" alt="">
            </div>
            <div class="text-center fs-14 text-uppercase">Ознакомиться со счетом<br>фактурой до получения</div>
        </div>
        <div class="col col-12 col-md-4 col-lg-4 mb-30">            
            <div class="mlra round-105 text-center mb-20">
                <img src="<?=MEDIA_PATH;?>icons/icon-pc--stat.png" alt="">
            </div>
            <div class="text-center fs-14 text-uppercase">Следить за Вашими<br>расходами</div>
        </div>
    </div>
    <div class="use-pc text-center bg-success" id="no-cabinet">
        <p class="fs-24 mb-30">Еще не используете Личный кабинет ЭнергосбыТ Плюс ?</p>
        <a href="<?=$ul_z;?>" class="btn btn-orange w-270"><span class="fa-angle-btn">Скачайте форму</span></a>
    </div>
    <div class="row">
        <div class="col col-12 col-lg-10 offset-lg-1">
            <? if ($ul_p):?>
            <div class="form-description bg-message bg-info fs-15">
                <div class="mb-10 color-orange"><b>Порядок подключения</b><i class="icon-info--orange"></i></div>
                <a href="<?=$ul_p;?>">
                <?if($OptimalGroup['DOMAIN'] == 'perm'){?>
                    Порядок подключения</a> к личному кабинету для юридических лиц для клиентов Пермского филиала АО «ЭнергосбыТ Плюс»
                <? } else { ?>
                    Порядок подключения</a> к сервису «Web-кабинет для юридических лиц» для клиентов <?=$ul_p_name;?> ОАО «ЭнергосбыТ Плюс»
                <? } ?>
            </div>
            <? else:?>
            <div class="form-description bg-message bg-info fs-15">
                <div class="mb-10 color-orange"><b>Порядок заполнения</b><i class="icon-info--orange"></i></div>
                Подпишите оформленную заявку. Передать заявку Вы можете в отсканированном виде, направив ее на электронный адрес Вашему менеджеру ЭнергосбыТ Плюс. Так же Вы можете передать заявку, обратившись в ближайший для Вас <a href="/offices/" class="color-orange">офис обслуживания</a>.
            </div>
            <? endif;?>
        </div>
        <div class="col col-12 col-lg-10 offset-lg-1 mt-30">
            <div class="form-description bg-message bg-info fs-15">
                <div class="mb-10 color-orange"><b>Информация</b><i class="icon-info--orange"></i></div>
                Личный кабинет является бесплатным сервисом. Если у Вас возникли затруднения при регистрации, 
Вы можете оставить сообщение через форму <a href="/feedback/" class="color-orange">обратной связи</a>
            </div>
        </div>
    </div>
</div>
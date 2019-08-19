<?
$SiteSection = OptimalGroup\SiteSection::Get();
$ClientSection = "/clients/";
if ($SiteSection['CODE'] == "business")
    $ClientSection = "/".$SiteSection['CODE'].$ClientSection;
$class = "col-md-6 col-lg-3 mt-lg-0 mt-10";
if($is_column)
    $class = "col-md-6 col-lg-12 mt-lg-20 mt-10";
?>
<div class="row mt-30">
    <div class="col col-12 <?=$class;?>">
        <a href="/feedback/" class="btn btn-label block"><span><i class="fa fa-envelope"></i></span>Обратная связь</a>
    </div>
    <div class="col col-12 <?=$class;?>">
        <a href="/about/faq/" class="btn btn-label block"><span><i class="icon-question btn-icon"></i></span>Вопрос-ответ</a>
    </div>
    <div class="col col-12 <?=$class;?>">
        <a href="<?=$ClientSection;?>" class="btn btn-label block"><span><i class="icon-support btn-icon"></i></span>Помощь и поддержка</a>
    </div>
    <div class="col col-12 <?=$class;?>">
        <a href="/about/quality-of-services/" class="btn btn-label block"><span><i class="icon-rating btn-icon"></i></span>Оценить качество услуг</a>
    </div>
</div>    
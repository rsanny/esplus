<?
$SiteSection = OptimalGroup\SiteSection::Get();
$ClientSection = "/clients/";
if ($SiteSection['CODE'] == "business")
    $ClientSection = "/".$SiteSection['CODE'].$ClientSection;
?>
<div class="more-questions">
    <div class="more-question--person clearfix">
        <i class="pull-left"><img src="<?=MEDIA_PATH;?>images/support-person.jpg" alt=""></i>
        <div class="overflow">
            <div>Консультация</div>
            <span>Евгений</span>
            Эксперт по техническим вопросам
        </div>
    </div>
    <a href="#" class="btn btn-orange block js-popUpData" data-fancybox-href="<?=AJAX_PATH;?>form/ask-question.php">Задайте вопрос</a>
</div>
<div class="see-support text-center">
    А также см. раздел<br>
    <a href="<?=$ClientSection;?>" class="link-orange">Помощь и поддержка</a>
</div>
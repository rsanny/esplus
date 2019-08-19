<?
//$to      = 'alex2621@gmail.com, nefedx@gmail.com, Andrey.Vitkov@esplus.ru, Yuliya.Syromyatnikova@esplus.ru, Gavriil.Pogorelov@esplus.ru, Anzhelika.Semieshkina@esplus.ru, Natalya.Kayurina@esplus.ru, Sergey.Cherepakhin@tplusgroup.ru';
$to      = 'alex2621@gmail.com, nefedx@gmail.com, p.kapustin@esplus.ru, pavel.a.kapustin@gmail.com';
$subject = 'Тест php mail';
$message = 'Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).';
$headers = 'From: no-reply@site.esplus.ru'. "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if ($_REQUEST['sure'] == "Y" && !empty($_REQUEST['email'])){
    if (mail($_REQUEST['email'], $subject, $message, $headers)){
        echo "Письмо ушло!<br><br>";
    }
}
?>
<form method="post">
    <textarea name="email" cols="100" rows="10" style="display: block; margin: 0 0 10px;"><?=$_REQUEST['email']?$_REQUEST['email']:$to;?></textarea>
    <input type="submit" value="Отправить всем">
    <input type="hidden" name="sure" value="Y">
</form>
<?

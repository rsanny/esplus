<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
global $OptimalGroup;
if ($OptimalGroup['DOMAIN'] == "vladimir" && $OptimalGroup['SITE']['CODE'] == "home")
    LocalRedirect('http://study.vladcomsys.ru/', true);
elseif (
    $OptimalGroup['DOMAIN'] == "vladimir" && $OptimalGroup['SITE']['CODE'] == "business" || 
    $OptimalGroup['DOMAIN'] == "samara" && $OptimalGroup['SITE']['CODE'] == "home"
)
    LocalRedirect('https://lk.kvp24.ru/login', true);
?>

<div class="content-container">
    <h1 class="form-group--title text-left text-md-center">Регистрация</h1>
    <div class="row">
        <div class="col col-12 col-md-10 col-lg-9">
            <? if ($OptimalGroup['DOMAIN'] == 'oren' && false == true):?>
                <? $APPLICATION->IncludeComponent(
                    "optimalgroup:lkk", 
                    "register", 
                    [
                        'REDIRECT_URL' => 'https://lk.esplus.ru/NaturalPerson',
                        'SITE_TYPE' => $OptimalGroup['SITE']['CODE'],
                        'BRANCH' => $OptimalGroup['BRANCH'],
                        "FORM_NAME" => "registerPage",
                        'AJAX_MODE' => 'Y',
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "N",
                        "AJAX_OPTION_HISTORY" => "N",
                    ],
                    false
                );?>
            <? else:?>
            <? 
            $APPLICATION->IncludeComponent("optimalgroup:form.register", "", array(
                "CHECK" => array(
                    "nlsid",
                    "house",
                    "email",
                    "password",
                ),
                "CHECK_NAME" => array(
                    "№ лицевого счета",
                    "Номер дома",
                    "E-mail адрес",
                    "Пароль"
                ),
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "registerForm"
            ),
            false
            );?>
            <? endif;?>
        </div>
        <div class="col col-12 col-md-12 col-lg-3">
            <div class="bg-info bg-message">
                <p class="text-uppercase color-orange">Внимание!</p>
                <p>Данная регистрация предназначена только для клиентов-физических лиц.</p>
                <br>
                <p>Уважаемый клиент, если у Вас не получается зарегистрироваться, Вы можете оставить обращение на нашем сайте в разделе <a href="/feedback/" target="_blank">Обратная связь</a> или позвонить в контакт-центр по телефону, указанному в квитанции.</p>
            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?global $OptimalGroup;?>
<form id="formPayUnregistered" data-step="1">
    <?=bitrix_sessid_post()?>
    <div class="form-group--title text-left text-md-center">
        Форма оплаты без регистрации
    </div>
    <div class="row">
        <div class="col col-12 col-md-10 col-lg-8">
            <div class="row form-group flex-vertical">
                <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2 text-md-right text-left form-label">
                    Номер лицевого счета <span class="color-orange">*</span>
                </div>
                <div class="col col-12 col-md-6">
                    <div class="form-control--container">
                        <input class="form-control" name="nlsid" value="" placeholder=""> <i class="form-control--question js-toolTip" data-text="Номер лицевого счета указан в Вашей квитанции"></i>
                        <span class="error_mini">Введите номер Вашего лицевого счета</span>
                    </div>
                </div>
            </div>
            <div id="step1">
                <div class="row form-group flex-vertical">
                    <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2 text-md-right text-left form-label">
                        Номер телефона <span class="color-orange">*</span>
                    </div>
                    <div class="col col-12 col-md-6">
                        <div class="form-control--container">
                            <input class="form-control js-InputMask" data-inputmask="'mask': '+7 999 999 99 99','placeholder':'Х'" placeholder="+7 ХХХ ХХХ ХХ ХХ" value="" name="phone"> <i class="form-control--question js-toolTip" data-text="Укажите номер Вашего мобильного телефона в формате +7 ХХХ ХХХ ХХ ХХ"></i>
                            <span class="error_mini">Введите корректное значение</span>
                        </div>
                    </div>
                </div>
                <div class="row form-group flex-vertical">
                    <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2 text-md-right text-left form-label">
                        E-mail<span class="color-orange">*</span>
                    </div>
                    <div class="col col-12 col-md-6">
                        <div class="form-control--container">
                            <input class="form-control js-Email" placeholder="email@sitename.ru" value="" name="email"> <i class="form-control--question js-toolTip" data-text="Укажите Ваш e-mail – на него будет выслан чек после успешной оплаты"></i>
                            <span class="error_mini">Введите корректный адрес эл. почты</span>
                        </div>
                    </div>
                </div>
                <div class="row form-group flex-vertical">
                    <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2 text-md-right text-left form-label">
                        Сумма платежа руб.<span class="color-orange">*</span><br>
                        (например: 1050.31)
                    </div>
                    <div class="col col-12 col-md-6">
                        <div class="form-control--container">
                            <input class="form-control" value="" placeholder="" name="summa"> <i class="form-control--question js-toolTip" data-text="Укажите сумму платежа в формате хх.хх Например: 1050.31 По умолчанию указана сумма к оплате из Вашего последнего счета."></i>
                            <span class="error_mini">Укажите сумму платежа</span>
                        </div>
                    </div>
                </div>

                <div class="row flex-vertical">
                    <div class="col col-12 offset-md-2 col-md-10 col-lg-6 offset-lg-6 form-group text-center col-mt-md-20">
                        <div class="checkbox for-rules">
                            <label><input type="checkbox" name="rules_sign" value="Y" checked="" required=""><i></i>Нажимая кнопку "Отправить", я предоставляю персональные данные и соглашаюсь с обработкой моих персональных данных АО "ЭнергосбыТ Плюс" в соответствии с <a href="/privacy/" target="_blank">Политикой обработки персональных данных</a></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flex-vertical">
                <div class="col col-12 offset-md-2 col-md-10 col-lg-6 offset-lg-6 form-group text-center col-mt-md-20">
                    <p>
                        <button id="next_step" class="btn btn-orange w-170">Далее</button>
                    </p>
                    <div class="block_or">
                    или
                    <p style="margin-top: 10px;">
                        <a href="#" id="splitted_but" class="btn btn-orange">Распределить платеж по услугам</a>
                    </p>
                    </div>
                    <div class="js-msg" style="display: none;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-12 col-sm-12 col-lg-4">
            <div class="bg-info bg-message">
                <p class="text-uppercase color-orange">
                    Оплачивайте Ваши квитанции онлайн с помощью удобного сервиса ЭнергосбыТ Плюс
                </p>
                <ul class="mb-0 pb-0">
                    <li>оплачивать услуги онлайн круглосуточно и без комиссии</li>
                    <li>для оплаты используйте карты VISA, MasterCard, МИР</li>
                    <li>убедитесь, что для Вашей карты разрешены расчеты в Интернете</li>
                </ul>
            </div>
            <div class="pay-logos text-center">
                <img src="/local/media/images/logo-pay-mir_big.png" alt="" class="img-responsive">
                <img src="/local/media/images/logo-master-card.jpg" alt="" class="img-responsive">
                <img src="/local/media/images/logo-pay-visa_big.png" alt="" class="img-responsive">
            </div>
        </div>
    </div>
    <hr>
    <div class="form-description">
        <div class="row text-center">
            <div class="col col-12 col-md-6 col-lg-3">
                <div class="form-description--title js-popUp" data-fancybox-href="#description-1">
                    Порядок оплаты<i class="icon-info"></i>
                </div>
                <div class="form-description--text none" id="description-1">
                    <div class="section-title text-center">
                        Порядок оплаты
                    </div>
                    <ul class="mt-0 pt-0 mb-0 pb-0">
                        <li>введите сумму платежа и нажмите на кнопку «Отправить»</li>
                        <li>после ввода суммы платежа и нажатия на кнопку «Оплатить», Вы будете перенаправлены на защищенную страницу платежной системы Газпромбанка, где безопасно осуществите Ваш платеж</li>
                        <li>после осуществления платежа Вы будете возвращены на прежнюю страницу</li>
                    </ul>
                </div>
            </div>
            <div class="col col-12 col-md-6 col-lg-3">
                <div class="form-description--title js-popUp" data-fancybox-href="#description-2">
                    Срок зачисления средств<i class="icon-info"></i>
                </div>
                <div class="form-description--text none" id="description-2">
                    <div class="section-title text-center">
                        Срок зачисления средств
                    </div>
                    <ul class="mt-0 pt-0 mb-0 pb-0">
                        <li>срок зачисления средств в рабочие дни за исключением пятницы составляет один рабочий день с момента оплаты</li>
                        <li>при оплате в пятницу, а также в выходные и праздничные дни, средства зачисляются в тот же срок, начиная с ближайшего рабочего дня</li>
                    </ul>
                </div>
            </div>
            <div class="col col-12 col-md-6 col-lg-3">
                <div class="form-description--title js-popUp" data-fancybox-href="#description-3">
                    Возврат платежей<i class="icon-info"></i>
                </div>
                <div class="form-description--text none" id="description-3">
                    <div class="section-title text-center">
                        Возврат платежей
                    </div>
                    <ul class="mt-0 pt-0 mb-0 pb-0">
                        <li>возврат денежных средств возможен на ту же карту, с которой был выполнен платеж и осуществляется по обращению клиента в обслуживающий его офис продаж.Сроки возврата зависят от банка клиента</li>
                    </ul>
                </div>
            </div>
            <div class="col col-12 col-md-6 col-lg-3">
                <div class="form-description--title js-popUp" data-fancybox-href="#description-4">
                    Политика безопасности<i class="icon-info"></i>
                </div>
                <div class="form-description--text none" id="description-4">
                    <div class="section-title text-center">
                        Политика безопасности
                    </div>
                    Безопасность платежей обеспечивается с помощью Банка-эквайера, функционирующего на основе современных протоколов и технологий, разработанных международными платежными системами МИР, Visa International и MasterCard Worldwide. Обработка полученных конфиденциальных данных Держателя карты производится в процессинговом центре Банка-эквайера, сертифицированного по стандарту PCI DSS. Безопасность передаваемой информации обеспечивается с помощью современных протоколов обеспечения безопасности в сети Интернет.
                    <div class="pay-logos">
                        <img src="/local/media/images/logo-pay-mir.png" alt="" class="img-responsive">
                        <img src="/local/media/images/logo-pay-master.png" alt="" class="img-responsive">
                        <img src="/local/media/images/logo-pay-visa.png" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(function(){
        $('body').on({
                'keypress': function(e){
                    var val = $(this).val(),
                        key = e.key;
                    var regex = /[0-9]|\./;
                    if( !regex.test(key) ) {
                        return false;
                    }
                },
                'change': function(e){
                    var val = $(this).val();
                    if(val.indexOf(',') != -1){
                        val = val.replace(/,/g , ".");
                    }
                    var float = parseFloat(val);

                    <? if ($OptimalGroup['DOMAIN'] == 'kirov') {?>
                        if(float >= 0) {
                            $(this).val(float.toFixed(2));
                        }
                    <?} else {?>
                        if (float != parseInt(float) && !isNaN(float)){
                            $(this).val(float.toFixed(2));
                        }
                    <?}?>

                }
            },
            'input[name="summa"],input[name="no_more"]'
        );

        //$(document).on('#splitted_pay','click',function () {
        $('#splitted_pay').click(function (){

            $form = $('#formPayUnregistered');
            if($form.attr('data-step') == '1'){

                if($('input[name="nlsid"]').val() == ''){
                    $('input[name="nlsid"]').addClass('is-error');
                    $('input[name="nlsid"]').parents('.form-control--container').find('.error_mini').text('Введите номер Вашего лицевого счета');
                    $('input[name="nlsid"]').parents('.form-control--container').find('.error_mini').show();
                    return false;
                }

                $dataStep1 = $form.serialize();
                $dataStep1+='&STEP1=Y'
                $.ajax({
                    url: '/local/include/ajax/payment.php',
                    data: $dataStep1,
                    dataType: 'json',
                    method: 'POST',
                    success: function(data){
                        if (!data.error){
                            $('splitted_pay').attr('href',$(this).attr('href') + '?PER_ACC=' + $('input[name="nlsid"]').val());
                            window.location.href = '/service/pay/?PER_ACC=' + $('input[name="nlsid"]').val();
                        }
                        if(!!data.error)
                        {
                            if (data.error == "Не удалось инициализировать транзакцию") data.error = "Не удалось инициализировать транзакцию.<br> Попробуйте отправить форму снова. Если ошибка повторилась - обновить страницу и отправить форму. Если снова повторилась - проверьте корректность заполненных значений.";
                            if (data.error == "Лицевой счёт не найден. Подробности по телефону Контакт-центра."){
                                $('input[name="nlsid"]').addClass('is-error');
                                $('input[name="nlsid"]').parents('.form-control--container').find('.error_mini').text('Неверный номер лицевого счета');
                                $('input[name="nlsid"]').parents('.form-control--container').find('.error_mini').show();
                                return false;
                            }
                            $msg.html(data.error).addClass('error').slideDown('fast');
                            return false;
                        }
                        /*if(!!data.message)
                        {
                            $msg.html(data.message).addClass('success').slideDown('fast');
                        }

                        if(!!data.url)
                        {
                            window.location.href = data.url;
                        }*/
                    }
                });

            }


            /*if($('input[name="nlsid"]').val() == ''){
                $('#formPayUnregistered').submit();
                return false;
            }else{
                $(this).attr('href',$(this).attr('href') + '?PER_ACC=' + $('input[name="nlsid"]').val());
            }*/
            return false;
        });

        $('#formPayUnregistered').on('submit', function(e){
            e.preventDefault();

            $form = $(this);
            $(this).parents('div').find('.error_mini').hide();
            $msg = $form.find('.js-msg');

            if($(this).attr('data-step') == '1'){

                if($('input[name="nlsid"]').val() == ''){
                    $('input[name="nlsid"]').addClass('is-error');
                    $('input[name="nlsid"]').parents('.form-control--container').find('.error_mini').text('Введите номер Вашего лицевого счета');
                    $('input[name="nlsid"]').parents('.form-control--container').find('.error_mini').show();
                    return false;
                }

                $dataStep1 = $form.serialize();
                $dataStep1+='&STEP1=Y'
                $.ajax({
                    url: '/local/include/ajax/payment.php',
                    data: $dataStep1,
                    dataType: 'json',
                    method: 'POST',
                    success: function(data){
                        if (!data.error){
                            $('input[name="nlsid"]').attr('readonly','');
                            $('#splitted_pay').attr('href',$('#splitted_pay').attr('href')+'?PER_ACC='+ $('input[name="nlsid"]').val());
                            $('#step1').show();
                            $('#formPayUnregistered').attr('data-step','final');
                            $('#next_step').text('Оплатить');
                            $('.block_or').show();
                            //list_payment.details
                            if(data.list_payment.Message == 'OK'){
                                var sumDebt = 0;
                                var sumOverPayment = 0;
                                for (var prop in data.list_payment.details) {
                                    <? if ($OptimalGroup['DOMAIN'] == 'kirov') {?>
                                        if(data.list_payment.details[prop].ServiceBalance >= 0) {
                                            sumDebt += data.list_payment.details[prop].ServiceBalance;
                                        } else {
                                            sumOverPayment += data.list_payment.details[prop].ServiceBalance;
                                        }
                                    <?} else {?>
                                        sumDebt += data.list_payment.details[prop].ServiceBalance;
                                    <?}?>
                                }

                                var sumNum = sumDebt.toFixed(2);

                                <? if($OptimalGroup['DOMAIN'] == 'kirov') { ?>
                                    if(sumNum <= 0) {
                                        if (sumNum == 0 && sumOverPayment < 0) {
                                            var placeholder = 'Переплата: ' + Math.abs(sumOverPayment) + ' руб.';
                                        } else {
                                            var placeholder = 'Переплата: ' + Math.abs(sumNum) + ' руб.';
                                        }
                                        sumNum = "";
                                    } else {
                                        var placeholder = 'Рекомендуемый платеж: ' + sumNum + ' руб.';
                                    }
                                <? } else { ?>
                                    var placeholder = 'Рекомендуемый платеж: ' + sumNum + ' руб.';
                                <? } ?>

                                $('input[name="summa"]').val(sumNum);
                                $('input[name="summa"]').attr('placeholder', placeholder);
                            }
                        }
                        if(!!data.error)
                        {
                            if (data.error == "Не удалось инициализировать транзакцию") data.error = "Не удалось инициализировать транзакцию.<br> Попробуйте отправить форму снова. Если ошибка повторилась - обновить страницу и отправить форму. Если снова повторилась - проверьте корректность заполненных значений.";
                            if (data.error == "Лицевой счёт не найден. Подробности по телефону Контакт-центра."){
                                $('input[name="nlsid"]').addClass('is-error');
                                $('input[name="nlsid"]').parents('.form-control--container').find('.error_mini').text('Неверный номер лицевого счета');
                                $('input[name="nlsid"]').parents('.form-control--container').find('.error_mini').show();
                                return false;
                            }
                            $msg.html(data.error).addClass('error').slideDown('fast');
                        }
                        if(!!data.message)
                        {
                            $msg.html(data.message).addClass('success').slideDown('fast');
                        }

                        if(!!data.url)
                        {
                            window.location.href = data.url;
                        }
                    }
                });
                return false;
            }

            var inputs = $(this).find('input'),
                totalInputs = inputs.length,
                hasErrors = 0,
                Summ = $(this).find('input[name="summa"]').val();

            inputs.each(function(){
                $(this).removeClass('is-error');
                if (!$(this).val()){
                    hasErrors++;
                    $(this).addClass('is-error');
                    $(this).parent('div.form-control--container').find('.error_mini').css('display','block');
                }
            });

            $msg.hide().removeClass('error success');

            /*if (Summ > 150000){
                console.log(Summ);
                $msg.addClass('error');
                $msg.html('Максимальная сумма для единовременного платежа - 150 000 руб.').addClass('success').slideDown('fast');
                return false;
            }*/

            if (!hasErrors){
                $.ajax({
                    url: '/local/include/ajax/payment.php',
                    data: $form.serialize(),
                    dataType: 'json',
                    method: 'POST',
                    success: function(data){
                        console.log(data);
                        if (!data.error){
                            OptimalGroup.analytics.Submit({
                                ga:{
                                    category: "dom-service",
                                    action: "lk-online"
                                },
                                ym:"lk-online"
                            });
                        }
                        if(!!data.error)
                        {
                            if (data.error == "Не удалось инициализировать транзакцию") data.error = "Не удалось инициализировать транзакцию.<br> Попробуйте отправить форму снова. Если ошибка повторилась - обновить страницу и отправить форму. Если снова повторилась - проверьте корректность заполненных значений.";
                            $msg.html(data.error).addClass('error').slideDown('fast');
                        }
                        if(!!data.message)
                        {
                            $msg.html(data.message).addClass('success').slideDown('fast');
                        }

                        if(!!data.url)
                        {
                            window.location.href = data.url;
                        }
                    }
                });
            }
        });

        $('#splitted_but').click(function () {
            window.location.href = '/service/pay/?PER_ACC=' + $('input[name="nlsid"]').val();
            return false;
        });

    })
</script>
<style>
    .js-msg
    {
        padding-top: 1rem;
    }
    .js-msg.error
    {
        color: #F44336;
    }
    .js-msg.success
    {
        color: #4CAF50;
    }
    #step1{
        display: none;
    }
    .error_mini{
        color: red;
        font-size: 12px;
        margin-top: 5px;
        display: none;
    }
    .block_or{
        display: none;
    }
</style>
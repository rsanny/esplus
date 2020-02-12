<div class="form-group--title text-left text-md-center">Передача показаний онлайн</div>
<form id="formCounters">
    <?=bitrix_sessid_post()?>
    <input type="hidden" name="status" value="GET_COUNTERS">
    <div class="row">
        <div class="col col-12 col-md-10 col-lg-8">
            <div class="row form-group flex-vertical">
                <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2 text-md-right text-left form-label">
                Номер лицевого счета <span class="text-danger">*</span>
                </div>
                <div class="col col-12 col-md-6">
                    <div class="form-control--container">
                        <input class="form-control" value="" name="nlsid" placeholder="" required>
                        <i class="form-control--question js-toolTip" data-text="Номер лицевого счета указан в Вашей квитанции"></i>
                    </div>
                </div>
            </div>
            <div class="row flex-vertical">
                <div class="col col-12 col-md-6 offset-md-6 form-group text-center col-mt-md-20">
                    <button class="btn btn-orange w-170" name="get_counters" value="Y">Далее</button>
                    <div class="js-msg" style="display: none;"></div></div>
            </div>


        </div>
        <div class="col col-12 col-sm-12 col-lg-4">
        </div>
    </div>
    <div class="js-counters-container none">
        <div class="row">
            <div class="col col-12 col-md-10 col-lg-10 offset-md-1 offet-lg-1 js-counters-content">
            
            </div>
        </div>            
    </div>
    <div class="bg-info bg-message mt-20">
        <div class="mb-10 color-orange"><b>Информация</b><i class="icon-info--orange"></i></div>
        Рекомендуем передавать показания приборов учета до 25 числа
    </div>
</form>
<script>
$(function(){
    $('#formCounters').on('submit', function(e){
        e.preventDefault();
    })
    $('#formCounters').on('click', 'button', function(e){
        e.preventDefault();
        $form = $(this).closest('form');
        $msg = $form.find('.js-msg');
        $msg.hide().removeClass('error success');
        var dataPost = $form.serialize();
        dataPost += '&'+$(this).attr('name')+'='+$(this).val();

        $.ajax({
            url: '/local/include/ajax/send-counters-3.php',
            data: dataPost,
            dataType: 'json',
            method: 'POST',
            success: function(data){
                console.log(data);
                
                
                if(!!data.counter)
                {
                    $msg = $form.find('.js-msg[data-id="'+data.counter+'"]');
                    OptimalGroup.analytics.Submit({
                        ga:{
                            category: "dom-service",
                            action: "service-post"
                        },
                        ym:"service-post"
                    });
                }
                if(!!data.error)
                {
                    if (data.error == "Параметр nlsid не был передан") data.error = "Введите номер Вашего л/с";
                    $msg.html(data.error).addClass('error').slideDown('fast');
                }
                if(!!data.message)
                {
                    $msg.html(data.message).addClass('success').slideDown('fast');
                }
                if(!!data.counters)
                {
                    $('.js-counters-container').show();
                    $('.js-counters-content').empty();

                    $.each(data.counters, function(i, counter){
                        var sh2 = '';
                        var label = 'Показания';
                        if(counter.TT == 2)
                        {
                            label = 'Показания Тариф Ночь';
                            sh2 = '<br><div class="form-control--container">'+label+'<br><input class="form-control" value="" placeholder="Последнее значение: '+counter.Sh2+'" min="'+counter.Sh2+'" name="counters['+counter.Serial+'][Sh2]" placeholder=""></div>';
                            label = 'Показания Тариф День';
                        }
                        var iconName = "icon-contract--water";
                        if (counter.Alias == "E")
                            iconName = "icon-contract--elect";
                        var elCounter = '<div class="bg-message bg-info">\
                            <i class="post-value--icon"><img src="'+OptimalGroup.MEDIA_PATH+'icons/'+iconName+'.png" alt=""></i>\
                            <div class="row form-group">'+
                                '<div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-1 text-md-right text-left form-label">'+counter.ServiceName+'<br>ПУ № '+counter.Serial+'</div>'+
                                '<div class="col col-12 col-md-6 col-lg-5">'+
                                    '<div class="form-control--container">'+
                                        label+'<br><input class="form-control" value="" placeholder="Последнее значение: '+counter.Sh1+'" min="'+counter.Sh1+'" name="counters['+counter.Serial+'][Sh1]" placeholder="">'+
                                    '</div>'+sh2+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col col-12 col-md-6 offset-md-3 form-group text-center col-mt-md-20">'+
                                '<button class="btn btn-orange w-170" name="counter" value="'+counter.Serial+'">Отправить</button>'+
                                '<div class="js-msg" data-id="'+counter.Serial+'" style="display: none;"></div></div>'+
                            '</div>\
                        </div>';
                        $('.js-counters-content').append(elCounter);
                    })
                }
            }
        });
    })
})
</script>
<?/*
<hr>
<form id="formSendCounters">
    <?=bitrix_sessid_post()?>
                    <div class="row form-group">
                        <div class="col col-12 col-lg-4 offset-lg-4 col-md-6 offset-md-3">
                            <div class="one-radio js-Tabs" data-container=".form-indication">
                                <a href="#tab-electricity" class="is-selected"><i></i>Электроэнергия</a>
                                <a href="#tab-water" class=""><i></i>Вода</a>
                                <span class="is-selected-0"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-indication" id="tab-electricity">
                        <div class="row form-group">
                            <div class="col col-12 col-md-5 col-lg-4 text-md-right text-left form-label">Способ тарификации</div>
                            <div class="col col-12 col-md-5 col-lg-4">
                                <div class="form-select js-select">
                                    <select name="tarifs" onchange="changeTarifs(this)">
                                        <option value="1">1 - тарифный</option>
                                        <option value="2">2 - тарифный</option>
                                        <option value="3" disabled>3 - тарифный</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-12 col-lg-4 offset-lg-4 text-left text-sm-center text-lg-left"><div class="form-group--title">Передача показаний приборов учета электроэнергии</div></div>
                        </div>
                    </div>
                    <div class="form-indication none" id="tab-water">
                        <div class="row">
                            <div class="col col-12 col-lg-4 offset-lg-4 text-left text-sm-center text-lg-left"><div class="form-group--title">Передача показаний приборов учета горячей воды</div></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-12 col-md-10 col-lg-8">
                            <div class="row form-group">
                                <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2 text-md-right text-left form-label">№ лицевого счета</div>
                                <div class="col col-12 col-md-6">
                                    <div class="form-control--container">
                                        <input class="form-control" value="" name="nlsid" placeholder="" required>
                                        <i class="form-control--question js-toolTip" data-text="Номер лицевого счета указывается на титульной странице абонентской книжки и в договоре на электроснабжение месяца."></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2 text-md-right text-left form-label">№ прибора учета</div>
                                <div class="col col-12 col-md-6">
                                    <div class="form-control--container">
                                        <input class="form-control" value="" name="serial" placeholder="" required>
                                        <i class="form-control--question js-toolTip" data-text="Номер лицевого счета указывается на титульной странице абонентской книжки и в договоре на электроснабжение месяца."></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group js-tarifs-1">
                                <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2 text-md-right text-left form-label">Показания</div>
                                <div class="col col-12 col-md-6">
                                    <div class="form-control--container">
                                        <input class="form-control" value="" name="sh1" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group js-tarifs-2" style="display: none;">
                                <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2 text-md-right text-left form-label">2-й тариф</div>
                                <div class="col col-12 col-md-6">
                                    <div class="form-control--container">
                                        <input class="form-control" value="" name="sh2" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group js-tarifs-3" style="display: none;">
                                <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2 text-md-right text-left form-label">3-й тариф</div>
                                <div class="col col-12 col-md-6">
                                    <div class="form-control--container">
                                        <input class="form-control" value="" name="sh3" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-12 col-md-6 offset-md-6 form-group text-center col-mt-md-20">
                                    <button class="btn btn-orange w-170">Отправить</button>
                                    <div class="js-msg" style="display: none;"></div></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-12 col-lg-4">
                            <p class="text-uppercase color-orange">Важно!</p>
                            <p>Передать покзания можно до 25 числа текущего месяца.<br><br>После 25 числа показания не будут приняты к учету в текущем месяце, но, в случае, если Вы не передадите новые показания, могут быть приняты к учету в следующем месяце.</p>
                        </div>
                    </div>                                                                                                   
                </form>
<script>
var changeTarifs = function(obj){
    if(obj.value < 3)
    {
        $('.js-tarifs-3').hide();
        $('.js-tarifs-3 input').val('');
    }
    else
    {
        $('.js-tarifs-3').show();
    }

    if(obj.value < 2)
    {
        $('.js-tarifs-2').hide();
        $('.js-tarifs-2 input').val('');
    }
    else
    {
        $('.js-tarifs-2').show();
    }
}

$(function(){
    $('#formSendCounters').on('submit', function(e){
        $form = $(this);
        e.preventDefault();
        $msg = $form.find('.js-msg');
        $msg.hide().removeClass('error success');
        $.ajax({
            url: '/local/include/ajax/send-counters.php',
            data: $form.serialize(),
            dataType: 'json',
            method: 'POST',
            success: function(data){
                if(!!data.error)
                {
                    $msg.html(data.error).addClass('error').slideDown('fast');
                }
                if(!!data.message)
                {
                    $msg.html(data.message).addClass('success').slideDown('fast');
                }
            }
        });
    })
})
</script>
*/?>
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
</style>
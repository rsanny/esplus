<form id="formGetBalance">
    <?=bitrix_sessid_post()?>
                    
                    <div class="text-md-center text-left form-group--title">Проверка задолженности</div>
                    <div class="row">
                        <div class="col col-12 col-md-10 col-lg-8">
                            <div class="row form-group flex-vertical">
                                <div class="col col-12 col-md-4 offset-md-2 text-left text-md-right form-label">Номер лицевого счета <span class="text-danger">*</span></div>
                                <div class="col col-12 col-md-6">
                                    <div class="form-control--container">
                                        <input class="form-control" value="" name="nlsid" required placeholder="">
                                        <i class="form-control--question js-toolTip" data-text="Номер лицевого счета указан в Вашей квитанции"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">                                        
                                <div class="col col-12 col-md-6 offset-md-6 form-group text-center col-mt-md-20">
                                    <button class="btn btn-orange w-170">Отправить</button>
                                    <div class="js-msg" style="display: none;"></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </form>
<script>
$(function(){
    $('#formGetBalance').on('submit', function(e){
        $form = $(this);
        e.preventDefault();
        $msg = $form.find('.js-msg');
        $msg.hide().removeClass('error success');
        $.ajax({
            url: '/local/include/ajax/get-balance.php',
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
                    OptimalGroup.analytics.Submit({
                        ga:{
                            category: "dom-service",
                            action: "service-get"
                        },
                        ym:"service-get"
                    });
                    var summ = data.message.replace(/[^\d,-]/g, ""),
                        summFloat = parseFloat(summ.replace(/,/g , "."));
                    if (summFloat > 0){
                        $msg.html(data.message).addClass('error').slideDown('fast');
                    }
                    else {
                        $msg.html("Задолженность отсутствует. Спасибо за своевременную оплату!").addClass('success').slideDown('fast');
                    }
                }
            }
        });
    })
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
</style>
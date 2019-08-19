OptimalGroup.Form = {
    MESSAGE:{
        ERROR_EMAIL: "Введите корректный адрес эл. почты"
    },
    ValidateEmailInput: function(){        
          OptimalGroup.Form.ValidateEmailString($(this));
    },
    ValidateEmailString:function(self){
        var container = self.closest('div'),
            val = self.val(),
            errMsg = this.MESSAGE.ERROR_EMAIL,
            rule = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
            test = rule.test(val),
            error = container.find('.form-group-error'),
            result = "";
        if (!test && !error.length){
            self.addClass('is-error');
            //self.attr("value","");
            container.append('<div class="form-group-error">'+errMsg+'</div>');
        }
        else if (!test){        
            //self.attr("value","");
        }
        else if(test) {
            self.removeClass('is-error');
            container.find('.form-group-error').remove();
            result = true;
        }
        return result;
    },
    NextField: function(e){
        var val = $(this).val(),
            container = $(this).closest('.js-ShowNext'),
            next = container.next('.js-ShowNext');
        if (next.length){
            next.slideDown(function(){
                $.fancybox.update();
            });
        }
    },
    Validate:function(e){
        var form = $(this).closest('.js-validate'),
            input = form.find('[data-required="true"]'),
            btnContainer = form.find('.form-submit--btn'),
            btn = form.find('button[type="submit"]'),
            total = input.length,
            filled = 0,
            isField = $(this).is('input') || $(this).is('textarea');
        if (isField){
            
        }
        input.each(function($index){
            if (isField && input.attr('name') != $(this).attr('name'))
                return;
                
            if ($(this).val() != "") {
                if ($(this).data('type') == "email"){
                    test = OptimalGroup.Form.ValidateEmailString($(this));
                    if(test){
                        filled++;
                    }
                }
                else {
                    filled++;
                    $(this).removeClass('is-error');
                }
            }
            else {
                $(this).addClass('is-error');   
            }
        });
        if (filled == total){
            btn.removeAttr("disabled");
            btnContainer.addClass("is-success");
        }
        else {
            btnContainer.removeClass("is-success");
            btn.attr("disabled","disabled")
        }
    },
    Success:function(data){
        if (data.ANALYTICS)
            OptimalGroup.analytics.Submit(data.ANALYTICS);
    }
}
$(function(){
    $('body').on('keyup','.js-ShowNext input,.js-ShowNext textarea',OptimalGroup.Form.NextField);
    $('body').on('change','.js-Email',OptimalGroup.Form.ValidateEmailInput);  
    $('body').on('click','.js-validate .form-submit--btn',OptimalGroup.Form.Validate);
    $('body').on('change','.js-validate [data-required="true"]',OptimalGroup.Form.Validate);  
});
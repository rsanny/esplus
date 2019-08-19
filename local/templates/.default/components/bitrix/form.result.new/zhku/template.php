<? if ($arResult['arForm']['DESCRIPTION']):?><div class="mb-40 color-orange"><?=$arResult['arForm']['DESCRIPTION'];?></div><? endif;?>
<?
if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
    <div style="display:none" class="bg-danger bg-message mb-20">Необходимо принять условия обработки данных</div>
<div class="form">
<div class="none">
    <?=implode(",",$arResult['FORM_ERRORS']);?>
</div>
<? 
$labelCol = "col-md-4 col-lg-5 text-left form-label";
$fieldCol = "col-md-8 col-lg-7";
$oneInLineCol = "col-md-8 offset-md-4 col-lg-7 offset-lg-5 text-md-left text-center";
$hasFilial = false;
if ($arParams['IN_COLUMN']){
    $labelCol = "text-left form-label mb-10";
    $fieldCol = "";
    $oneInLineCol = "text-center";
}
foreach ($arResult['QUESTIONS'] as $code=>$arQuestion):
    $formFieldInfo = reset($arQuestion['STRUCTURE']);
    $inputName = 'form_'.$formFieldInfo['FIELD_TYPE'].'_'.$formFieldInfo['ID'];
    $class = "";
    $inputLabel = $arResult['arQuestions'][$code]['TITLE'];
    $inputPlaceholder = $arResult['arQuestions'][$code]['COMMENTS'];
    $isPhone = false; 
    if (strpos(strtolower($inputLabel),'телефон') !== false){
        $isPhone = true; 
        $class .= " js-InputMask";
    }
    if (strpos(strtolower($inputLabel),'e-mail') !== false){
        $isEmail = true; 
        $class .= " js-Email";
    }
    if (isset($arResult['FORM_ERRORS'][$code])){
        $class .= " is-error";
    }
    if ($formFieldInfo['FIELD_TYPE'] == "checkbox"):
        $checkboxCheckCode = 'form_'.$formFieldInfo['FIELD_TYPE'].'_'.$code;
        $CheckSign = $inputPlaceholder;
        if (constant($inputPlaceholder)){
            $CheckSign = constant($inputPlaceholder);
        }
    ?>
    <div class="row form-group">
        <div class="col col-12 <?=$oneInLineCol;?>">
            <div class="checkbox for-rules<?=$class;?>">
                <label>
                    <input class="<?=$class;?> check_box" type="checkbox" checked name="<?=$checkboxCheckCode?>[]" value="<?=$formFieldInfo['ID'];?>">
                    <i class="<?=$class;?>"></i><span style="font-size: 12px;"><?=$CheckSign;?></span>
                </label>
            </div>
        </div>
    </div>        
    <?
    elseif ($formFieldInfo['FIELD_TYPE'] == "textarea"):?>
    <div class="row form-group flex-vertical">
        <div class="col col-12 <?=$labelCol;?>">
            <label for="<?=$code;?>"><?=$inputLabel;?> <? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
        </div>
        <div class="col col-12 <?=$fieldCol;?>">
            <textarea id="<?=$code;?>" class="form-control<?=$class?>" name="<?=$inputName;?>" placeholder="<?=$inputPlaceholder;?>"><?=$arResult['arrVALUES'][$inputName]?></textarea>
        </div>
    </div>    
    <? 
    elseif ($inputLabel == "EMAIL_SEND"):
        $EMAIL_SEND = $code;
    ?>
         <input value="<?=$arParams['EMAIL_SEND'];?>" id="<?=$code;?>" name="<?=$inputName;?>" type="hidden">     
    <? elseif ($inputLabel == "Услуга" || $inputLabel == "Страница"):?>
    <input value="<?=$arParams['TITLE'];?>" name="<?=$inputName;?>" type="hidden">
    <? 
    elseif (strpos(strtolower($inputLabel),'филиал') !== false):
    ?>
       <input value="<?=$_SESSION['BXExtra']['REGION']['IBLOCK']['REGION'];?>" id="<?=$code;?>" name="<?=$inputName;?>" type="hidden">
    <? else:?>
    <div class="row form-group flex-vertical">
        <div class="col col-12 <?=$labelCol;?>">
            <label for="<?=$code;?>"><?=$inputLabel;?><? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
        </div>
        <div class="col col-12 <?=$fieldCol;?>">
            <input 
                id="<?=$code;?>"        
                type="<?=$formFieldInfo['FIELD_TYPE'];?>" 
                name="<?=$inputName;?>" 
                class="form-control<?=$class?>"
                <? if ($isPhone):?> data-inputmask="'mask': '+7 999 999 99 99','placeholder':'Х'"<? endif;?>
                placeholder="<?=$inputPlaceholder;?>"
                value="<?=$arResult['arrVALUES'][$inputName]?>"
            >
        </div>
    </div>                
    <? endif;?>
<? endforeach;?>    
    <div class="row">
        <div class="col col-12 <?=$oneInLineCol;?>">
            <button class="btn btn-orange w-170" name="web_form_submit" value="<?=$arResult['arForm']['BUTTON'];?>"><?=$arResult['arForm']['BUTTON'];?></button>
        </div>
    </div>  
</div>
    <?
    ?>
<? 
//WAIT TILL EMAIL WILL FILLED IN IBLOCK
if ($hasFilial):?>
<script>
$(function(){
    $('#<?=$EMAIL_SEND;?>').val($('#<?=$FilialId;?>').find('option:selected').data('email'));
    $('body').on('change','#<?=$FilialId;?>',function(e){
        var email = $(this).find('option:selected').data('email');
        console.log(email);
        $('#<?=$EMAIL_SEND;?>').val(email);
    });
});
</script>
<? endif;?>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
else {
  ?>
<div class="text-center"><?=FormatHelper::Success('Спасибо! Ваша заявка принята!');?></div>
<script>
<?
$FromDataSubmit = array(
    "ID" => $arParams['WEB_FORM_ID'],
    "RESULT_ID" => $_REQUEST['RESULT_ID'],
    "TITLE" => $arParams['TITLE'],
    "URL" => $arParams['URL']
);
if ($arParams['ANALYTICS']){
    $FromDataSubmit['ANALYTICS'] = $arParams['ANALYTICS'];
}
?>
top.OptimalGroup.Form.Success(<?=json_encode($FromDataSubmit);?>);
</script>
  <?
}
if (isset($arResult['FORM_ERRORS'])){?>
    <script>
        $(document).ready(function(){
            var scroll_el = $(".is-error").first().attr('id'); // возьмем содержимое атрибута href, должен быть селектором, т.е. например начинаться с # или .
            if ($("#"+scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
                $('html, body').animate({ scrollTop: $("#"+scroll_el).offset().top }, 500); // анимируем скроолинг к элементу scroll_el
            }
            return false; // выключаем стандартное действие
        });
        if($(".check_box").hasClass("is-error"))
        {
            $(".bg-danger").show();
            $('html, body').animate({scrollTop: $(".bg-danger").offset().top}, 500);
            //alert(444);
        }
    </script>
<?}
?>
<?
if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
<div class="none">
    <?=implode(",",$arResult['FORM_ERRORS']);?>
</div>
<div class="row">
    <div class="col col-12 col-sm-6 col-lg-4 offset-lg-2">
<? 
$hasFilial = false;
$t = count($arResult['QUESTIONS'])-5;
$col = ceil($t/2);
$count = 0;
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
    ?>
    <? if ($count == $col):?>
    </div>
    <div class="col col-12 col-sm-6 col-lg-4">
    <? endif;?>
    <?
    if ($formFieldInfo['FIELD_TYPE'] == "checkbox"):
        $checkboxCheckCode = 'form_'.$formFieldInfo['FIELD_TYPE'].'_'.$code;
        $CheckSign = $inputPlaceholder;
        if (constant($inputPlaceholder)){
            $CheckSign = constant($inputPlaceholder);
        }
    $checkbox .= '
        <div class="col col-12 text-center form-group">
            <div class="checkbox for-rules'.$class.'">
                <label style="display: block;width: 60%;margin: 0 auto;">
                    <input type="checkbox" checked name="'.$checkboxCheckCode.'[]" value="'.$formFieldInfo['ID'].'">
                        <i class="'.$class.'"></i><span>'.$CheckSign.'</span>
                </label>
            </div>
        </div>'; 
    elseif ($formFieldInfo['FIELD_TYPE'] == "textarea"):?>
    <div class="form-group">
        <div class="text-left form-label mb-10">
            <label for="<?=$code;?>"><?=$inputLabel;?> <? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
        </div>
        <textarea id="<?=$code;?>" class="form-control like-input<?=$class?>" name="<?=$inputName;?>" placeholder="<?=$inputPlaceholder;?>"><?=$arResult['arrVALUES'][$inputName]?></textarea>
    </div>    
    <? 
    elseif ($inputLabel == "EMAIL_SEND"):
        $EMAIL_SEND = $code;
    ?>
        <input value="<?=$arParams['EMAIL_SEND'];?>" id="<?=$code;?>" name="<?=$inputName;?>" type="hidden">     
    <? elseif ($inputLabel == "Услуга"):?>
    <input value="<?=$arParams['TITLE'];?>" name="<?=$inputName;?>" type="hidden">
    <? elseif ($inputLabel == "Страница"):?>
    <input value="<?=$arParams['URL'];?>" name="<?=$inputName;?>" type="hidden">
    <? 
    elseif (strpos(strtolower($inputLabel),'филиал') !== false):
        $hasFilial = true;
        $FilialId = $code;
    ?>
    <div class="form-group">
        <div class="text-left form-label mb-10">
            <label for="<?=$code;?>"><?=$inputLabel;?><? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
        </div>
        <div class="form-select js-select<?=$class;?>">
            <select id="<?=$code;?>" name="<?=$inputName;?>">
                <option value=""><?=$arResult['arQuestions'][$code]['COMMENTS'];?></option>
            <? 
            foreach ($arResult['REGIONS'] as $id=>$arRegion):                
                $selected = false;
                if ($arRegion['NAME'] == $arResult['arrVALUES'][$inputName])
                    $selected = true;
                elseif ($arRegion['SELECTED'] == "Y" && !$arResult['arrVALUES'][$inputName])
                    $selected = true;
            ?>
                <option value="<?=$arRegion['NAME'];?>"<? if ($selected):?> selected<? endif;?>><?=$arRegion['NAME'];?></option>
            <? endforeach;?>
            </select>
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
    <?
    elseif ($formFieldInfo['FIELD_TYPE'] == 'dropdown'):
        $selectName = 'form_'.$formFieldInfo['FIELD_TYPE'].'_'.$code;
    ?>
        <div class="form-group">
            <div class="text-left form-label mb-10">
                <label for="<?=$code;?>"><?=$inputLabel;?><? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
            </div>
            <div class="form-select js-select<?=$class;?>">
                <select id="<?=$code;?>" name="<?=$selectName;?>">
                    <option value=""><?=$inputPlaceholder;?></option>
                <? foreach ($arQuestion['STRUCTURE'] as $id=>$arStructure):?>
                    <option value="<?=$arStructure['ID'];?>"<? if ($arStructure['ID']==$arResult['arrVALUES'][$selectName]):?> selected<? endif;?>><?=$arStructure['MESSAGE'];?></option>
                <? endforeach;?>
                </select>
                <i class="fa fa-chevron-down"></i>
            </div>
        </div>    
    <? elseif ($formFieldInfo['FIELD_TYPE'] == 'file'):?>
        <div class="form-group">
            <div class="text-left form-label mb-10"><label for="<?=$code;?>"><?=$inputLabel;?><? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label></div>
            <div class="form-control--container">
                <div class="form-control-file form-control<?=$class?>">
                    <i>Выберите файл</i>
                    <?=$arQuestion['HTML_CODE'];?>
                    <span></span>
                    <a href="#"></a>
                </div>
                <? if ($inputPlaceholder):?>
                <i class="form-control--question js-toolTip" data-text="<?=$inputPlaceholder;?>"></i>
                <? endif;?>
            </div>
        </div>
    <? else:?>
    <div class="form-group">
        <div class="text-left form-label mb-10"><label for="<?=$code;?>"><?=$inputLabel;?><? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label></div>
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
    <? endif;?>
<?
    $count++;
endforeach;?>
    </div>
    <?=$checkbox;?>
    <?

    if (
        // Не нашли ответ на свой вопрос?
        $arParams["WEB_FORM_ID"] == 16

    )
    { ?>
        <div id="recaptchaResponse_<?= $arParams["WEB_FORM_ID"] ?>" class="recaptcha-item recaptcha-item--center"></div>
    <? } ?>
    <div class="col col-12 text-center form-group">
        <button class="btn btn-orange w-170" data-action="btn-ajax-load" name="web_form_submit" value="<?=$arResult['arForm']['BUTTON'];?>"><?=$arResult['arForm']['BUTTON'];?></button>
    </div>  
</div>
    <?
    ?>
<? 
//WAIT TILL EMAIL WILL FILLED IN IBLOCK
/*if ($hasFilial):?>
<script>
$(function(){
    $('#<?=$EMAIL_SEND;?>').val($('#<?=$FilialId;?>').find('option:selected').data('email'));
    $('body').on('change','#<?=$FilialId;?>',function(e){
        console.log(email);
        var email = $(this).find('option:selected').data('email');
        $('#<?=$EMAIL_SEND;?>').val(email);
    });
});
</script>
<? endif;*/?>
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
?>
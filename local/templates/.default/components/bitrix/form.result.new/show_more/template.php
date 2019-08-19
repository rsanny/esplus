<? 
/*
@var EMAIL_SEND //email to wich send this form
@var HIDE_TITLE //hide top title
@var FORM_TITLE //form top title
@var IN_COLUMN //show fields in column
@var BRANCH_HIDDEN //hide branch select and show hidden input instead of it
@var BRANCH_EMAIL //get branch for email select
@var BRANCH_CNAHGE_EMAIL //change EMAIL_SEND field value to selected branch email in select
@var TITLE //title of page to send
@var URL //url of page to send
*/
if ($arParams['HIDE_TITLE'] != "Y" || $arParams['FORM_TITLE']):
    $FormTitle = $arResult['arForm']['NAME'];
    if ($arParams['FORM_TITLE'])
        $FormTitle = $arParams['FORM_TITLE'];
?>
    <div class="section-title text-center"><span><?=$FormTitle;?></span></div>
<? endif;?>
<? if ($arResult['arForm']['DESCRIPTION']):?><div class="popup-form--text text-center"><?=$arResult['arForm']['DESCRIPTION'];?></div><? endif;?>
<?
if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
<div class="js-validate">
<? 
$labelCol = "col-md-4 col-lg-5 text-md-right text-left form-label";
$fieldCol = "col-md-8 col-lg-7";
$oneInLineCol = "col-md-8 offset-md-4 col-lg-7 offset-lg-5 text-md-left text-center";
$hasBranch = false;
if ($arParams['IN_COLUMN']){
    $labelCol = "text-left form-label mb-10";
    $fieldCol = "";
    $oneInLineCol = "text-center";
}
$ShowNextClass = " js-ShowNext";
$c=0;
foreach ($arResult['QUESTIONS'] as $code=>$arQuestion):
    $formFieldInfo = reset($arQuestion['STRUCTURE']);
    $inputName = 'form_'.$formFieldInfo['FIELD_TYPE'].'_'.$formFieldInfo['ID'];
    $class = "";
    $inputLabel = $arResult['arQuestions'][$code]['TITLE'];
    $inputPlaceholder = $arResult['arQuestions'][$code]['COMMENTS'];
    $Value = $arResult['arrVALUES'][$inputName];
    $isPhone = false; 
    if ($c>1 && empty($Value)) $ShowNextClass .= " none";
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
    
    if (strpos(strtolower($inputLabel),'вопрос') !== false && !$Value){
        $Value = $arParams['QUESTION'];
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
                    <input type="checkbox" checked name="<?=$checkboxCheckCode?>[]" value="<?=$formFieldInfo['ID'];?>">
                    <i class="<?=$class;?>"></i><span><?=$CheckSign;?></span>
                </label>
            </div>
        </div>
    </div>        
    <?
    elseif ($formFieldInfo['FIELD_TYPE'] == "textarea"):?>
    <div class="row form-group<?=$ShowNextClass;?>">
        <div class="col col-12 <?=$labelCol;?>">
            <label for="<?=$code;?>"><?=$inputLabel;?> <? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
        </div>
        <div class="col col-12 <?=$fieldCol;?>">
            <textarea id="<?=$code;?>" class="form-control like-input<?=$class?>" name="<?=$inputName;?>"<? if($arQuestion['REQUIRED']):?> data-required="true"<? endif;?> placeholder="<?=$inputPlaceholder;?>"><?=$Value?></textarea>
        </div>
    </div>    
    <? 
    elseif ($inputLabel == "EMAIL_SEND"):
        $EMAIL_SEND = $code;
    ?>
        <input value="<?=$arParams['EMAIL_SEND'];?>" id="<?=$code;?>" name="<?=$inputName;?>" type="hidden">  
    <? elseif ($inputLabel == "Услуга" || $inputLabel == "Страница"):?>
    <input value="<?=$arParams['TITLE'];?>" name="<?=$inputName;?>" type="hidden">
    <? elseif (strpos(strtolower($inputLabel),'заголовок') !== false):?>
    <input value="<?=$arParams['TITLE'];?>" name="<?=$inputName;?>" type="hidden">
    <? elseif (strpos(strtolower($inputLabel),'тип') !== false):?>
    <input value="<?=$_SESSION['BXExtra']['SITE']['NAME'];?>" name="<?=$inputName;?>" type="hidden">
    <? elseif (strpos(strtolower($inputLabel),'урл') !== false):?>
    <input value="<?=$arParams['URL'];?>" name="<?=$inputName;?>" type="hidden">
    <? 
    elseif (strpos(strtolower($inputLabel),'филиал') !== false || strpos(strtolower($inputLabel),'ваш регион') !== false):
        if ($arParams['BRANCH_HIDDEN']):
    ?>
    <input value="<?=$_SESSION['BXExtra']['REGION']['IBLOCK']['REGION'];?>" id="<?=$code;?>" name="<?=$inputName;?>" type="hidden">  
    <?
        else:
        $hasBranch = true;
        $BranchId = $code;
    ?>
    <div class="row form-group<?=$ShowNextClass;?>">
        <div class="col col-12 <?=$labelCol;?>">
            <label for="<?=$code;?>"><?=$inputLabel;?><? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
        </div>
        <div class="col col-12 <?=$fieldCol;?>">
            <div class="form-select js-select<?=$class;?>">
                <select id="<?=$code;?>" name="<?=$inputName;?>">
                    <option value=""><?=$arResult['arQuestions'][$code]['COMMENTS'];?></option>
                <? 
                foreach ($arResult['BRANCH'] as $id=>$arBranch):                
                    $selected = false;
                    if ($arBranch['NAME'] == $arResult['arrVALUES'][$inputName])
                        $selected = true;
                    elseif ($arBranch['SELECTED'] == "Y" && !$arResult['arrVALUES'][$inputName])
                        $selected = true;
                ?>
                    <option value="<?=$arBranch['NAME'];?>"<? if ($selected):?> selected<? endif;?> data-email="<?=$arBranch['EMAIL'];?>"><?=$arBranch['NAME'];?></option>
                <? endforeach;?>
                </select>
                <i class="fa fa-angle-down"></i>
            </div>     
        </div>
    </div>
    <? endif;?>
    <? elseif ($formFieldInfo['FIELD_TYPE'] == 'file'):?>
        <div class="row form-group<?=$ShowNextClass;?>">
            <div class="col col-12 <?=$labelCol;?>">
                <label for="<?=$code;?>"><?=$inputLabel;?><? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
            </div>
            <div class="col col-12 col-md-6">
                <div class="form-control--container">
                    <div class="form-control-file form-control">
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
        </div>         
    <? else:?>
    <div class="row form-group<?=$ShowNextClass;?>">
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
                <? if ($isEmail):?>data-type="email"<? endif;?>
                <? if($arQuestion['REQUIRED'] == "Y"):?>data-required="true"<? endif;?>
                placeholder="<?=$inputPlaceholder;?>"
                value="<?=$Value?>"
            >
        </div>
    </div>                
    <? endif;?>
<? 
$c++;
endforeach;?>    
    <div class="row form-group">
        <div class="col col-12 <?=$oneInLineCol;?> form-submit--btn">
            <button class="btn btn-orange w-170" data-action="btn-ajax-load" name="web_form_submit" type="submit" value="<?=$arResult['arForm']['BUTTON'];?>" disabled><?=$arResult['arForm']['BUTTON'];?></button>
        </div>
    </div>  
</div>
<? if ($hasBranch && $arParams['BRANCH_CNAHGE_EMAIL'] == "Y"):?>
<script>
$(function(){
    $('#<?=$EMAIL_SEND;?>').val($('#<?=$BranchId;?>').find('option:selected').data('email'));
    $('body').on('change','#<?=$BranchId;?>',function(e){
        var email = $(this).find('option:selected').data('email');
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
?>
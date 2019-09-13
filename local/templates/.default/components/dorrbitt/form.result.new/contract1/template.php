<? if ($arResult['arForm']['DESCRIPTION']):?><div class="popup-form--text text-center"><?=$arResult['arForm']['DESCRIPTION'];?></div><? endif;?>
<?
if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
<div class="form">
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
    if ($inputLabel == "Согласие"):
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
    elseif ($formFieldInfo['FIELD_TYPE'] == "checkbox"):
        $fieldType = $formFieldInfo['FIELD_TYPE'];
        $listCode = 'form_'.$fieldType.'_'.$code;
    ?>
    <div class="row form-group flex-vertical">
        <div class="col col-12 <?=$labelCol;?>">
            <label for="<?=$code;?>"><?=$inputLabel;?> <? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
        </div>
        <div class="col col-12 <?=$fieldCol;?>">
        <? 
        foreach ($arQuestion['STRUCTURE'] as $listItem):
        $selected = $listItem['FIELD_PARAM'];
        if (in_array($listItem['ID'],$arResult['arrVALUES'][$listCode])) 
            $selected = " checked";
        ?>
            <div class="<?=$fieldType;?> radio-top">
                <label>
                    <input type="<?=$fieldType;?>" name="<?=$listCode?>[]" value="<?=$listItem['ID'];?>"<?=$selected;?>><i class="<?=$class;?>"></i><span><?=$listItem['MESSAGE'];?></span>
                </label>
            </div>
        <? endforeach;?>
        </div>
    </div>
    <?
    elseif ($formFieldInfo['FIELD_TYPE'] == "radio"):
        $fieldType = $formFieldInfo['FIELD_TYPE'];
        $listCode = 'form_'.$fieldType.'_'.$code;
    ?>
    <div class="row form-group flex-vertical">
        <div class="col col-12 <?=$labelCol;?>">
            <label for="<?=$code;?>"><?=$inputLabel;?> <? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
        </div>
        <div class="col col-12 <?=$fieldCol;?>">
        <? 
        foreach ($arQuestion['STRUCTURE'] as $listItem):
        $selected = "";
        if ($listItem['ID'] == $arResult['arrVALUES'][$listCode])
            $selected = " checked";
        ?>
            <div class="<?=$fieldType;?> radio-top">
                <label>
                    <input type="<?=$fieldType;?>" name="<?=$listCode?>" value="<?=$listItem['ID'];?>"<?=$selected;?>><i class="<?=$class;?>"></i><span><?=$listItem['MESSAGE'];?></span>
                </label>
            </div>
        <? endforeach;?>
        </div>
    </div>
    <?
    elseif ($formFieldInfo['FIELD_TYPE'] == "textarea"):
    ?>
    <div class="row form-group flex-vertical">
        <div class="col col-12 <?=$labelCol;?>">
            <label for="<?=$code;?>"><?=$inputLabel;?> <? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
        </div>
        <div class="col col-12 <?=$fieldCol;?>">
            <div class="form-control--container">
                <textarea 
                    id="<?=$code;?>" 
                    class="form-control<?=$class?>" 
                    name="<?=$inputName;?>"
                    <? if($formFieldInfo['FIELD_HEIGHT']):?>rows="<?=$formFieldInfo['FIELD_HEIGHT'];?>"<? endif;?>
                ><?=$arResult['arrVALUES'][$inputName]?></textarea>
            
                <? if ($inputPlaceholder):?>
                <i class="form-control--question js-toolTip" data-text="<?=$inputPlaceholder;?>"></i>
                <? endif;?>
            </div>                
        </div>
    </div>    
    <? elseif ($inputLabel == "EMAIL_SEND"):?>
    <input value="<?=$arParams['EMAIL_SEND'];?>" id="<?=$code;?>" name="<?=$inputName;?>" type="hidden">   
    <? elseif (strpos(strtolower($inputLabel),'филиал') !== false):?>
    <input value="<?=$_SESSION['BXExtra']['REGION']['IBLOCK']['REGION'];?>" id="<?=$code;?>" name="<?=$inputName;?>" type="hidden">  
    <?
    elseif ($formFieldInfo['FIELD_TYPE'] == 'file'):?>
        <div class="row form-group flex-vertical">
            <div class="col col-12 <?=$labelCol;?>">
                <label for="<?=$code;?>"><?=$inputLabel;?><? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
            </div>
            <div class="col col-12 <?=$fieldCol;?>">
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
        </div>         
    <? else:?>
    <div class="row form-group flex-vertical">
        <div class="col col-12 <?=$labelCol;?>">
            <label for="<?=$code;?>"><?=$inputLabel;?><? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
        </div>
        <div class="col col-12 <?=$fieldCol;?>">
            <div class="form-container">
                <input 
                    id="<?=$code;?>"        
                    type="<?=$formFieldInfo['FIELD_TYPE'];?>" 
                    name="<?=$inputName;?>" 
                    class="form-control<?=$class?>"
                    <? if ($isPhone):?> data-inputmask="'mask': '+7 999 999 99 99','placeholder':'Х'"<? endif;?>
                    placeholder=""
                    value="<?=$arResult['arrVALUES'][$inputName]?>"
                >
                <? if ($inputPlaceholder):?>
                <i class="form-control--question js-toolTip" data-text="<?=$inputPlaceholder;?>"></i>
                <? endif;?>
            </div>
        </div>
    </div>                
    <? endif;?>
<? endforeach;?>    
    <div class="row form-group">
        <div class="col col-12 <?=$oneInLineCol;?>">
            <button class="btn btn-orange w-170" data-action="btn-ajax-load" name="web_form_submit" value="<?=$arResult['arForm']['BUTTON'];?>"><?=$arResult['arForm']['BUTTON'];?></button>
        </div>
    </div>  
</div>
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
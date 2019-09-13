<?
if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
<div class="js-validate">
<? 
//pr($arParams);
foreach ($arResult['QUESTIONS'] as $code=>$arQuestion):
    $formFieldInfo = reset($arQuestion['STRUCTURE']);
    $inputName = 'form_'.$formFieldInfo['FIELD_TYPE'].'_'.$formFieldInfo['ID'];
    $class = "";
    $inputLabel = $arResult['arQuestions'][$code]['TITLE'];
    $inputPlaceholder = $arResult['arQuestions'][$code]['COMMENTS'];
    $isPhone = false; 
    if (strpos(strtolower($inputLabel),'телефон') !== false){
        $isPhone = true; 
    }
    if (strpos(strtolower($inputLabel),'e-mail') !== false){
        $isEmail = true; 
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
    <div class="form-group">
            <div class="checkbox fs-14 for-rules<?=$class;?>">
            <label>
                <input type="checkbox" checked name="<?=$checkboxCheckCode?>[]" value="<?=$formFieldInfo['ID'];?>">
                <i class="<?=$class;?>"></i><span><?=$CheckSign;?></span>
            </label>
        </div>
    </div>        
    <?
    elseif ($formFieldInfo['FIELD_TYPE'] == "textarea"):?>
    <div class="form-group js-ShowNext">
        <textarea rows="2" id="<?=$code;?>" class="form-control<?=$class?>" name="<?=$inputName;?>" placeholder="<?=$inputLabel;?>" data-required="true"><?=$arResult['arrVALUES'][$inputName]?></textarea>
    </div>    
    <?  elseif ($inputLabel == "EMAIL_SEND"):?>
    <input value="<?=$arParams['EMAIL_SEND'];?>" id="<?=$code;?>" name="<?=$inputName;?>" type="hidden">       
    <? elseif (strpos(strtolower($inputLabel),'заголовок') !== false):?>
    <input value="<?=$APPLICATION->ShowTitle();?>" name="<?=$inputName;?>" type="hidden">
    <? elseif (strpos(strtolower($inputLabel),'тип') !== false):?>
    <input value="<?=$_SESSION['BXExtra']['SITE']['NAME'];?>" name="<?=$inputName;?>" type="hidden">
    <? elseif (strpos(strtolower($inputLabel),'урл') !== false):?>
    <input value="<?=$arParams['URL'];?>" name="<?=$inputName;?>" type="hidden">
    <? elseif (strpos(strtolower($inputLabel),'филиал') !== false):?>     
    <input value="<?=$_SESSION['BXExtra']['REGION']['IBLOCK']['REGION'];?>" id="<?=$code;?>" name="<?=$inputName;?>" type="hidden">    
    <? else:?>
    <div class="form-group<? if ($isPhone || $isEmail):?> none js-ShowNext<? endif;?>">
        <input 
            class="form-control<? if ($isPhone):?> js-InputMask<? endif;?><?=$class?>"   
            id="<?=$code;?>"      
            type="<?=$formFieldInfo['FIELD_TYPE'];?>" 
            name="<?=$inputName;?>" 
            <? if ($isEmail):?>data-type="email"<? endif;?>
            <? if ($isPhone):?>data-inputmask="'mask': '+7 999 999 99 99','placeholder':'Х'" <? endif;?>
            placeholder="<?=$inputLabel;?>" 
            value="<?=$arResult['arrVALUES'][$inputName]?>" 
            data-required="true"
        >
    </div>                    
    <? endif;?>
<? endforeach;?>    
    <p class="form-submit--btn">
       <button class="btn btn-orange block" data-action="btn-ajax-load" type="submit" disabled name="web_form_submit" value="<?=$arResult['arForm']['BUTTON'];?>"><span class="fa-angle-btn">Заказать</span></button>
   </p>
   <div class="text-center fs-14"> Оперативно перезвоним в рабочее время</div>  
</div>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
else {
  ?>
  <div class="text-center"><?=FormatHelper::Success('Спасибо! Ваша заявка принята!');?></div>
  <?
}
?>
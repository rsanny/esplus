<? 
/*
extra components params
@var EMAIL_SEND //email to wich send this form
@var HIDE_TITLE //hide top title
@var FORM_TITLE //form top title
@var IN_COLUMN //show fields in column
@var BRANCH_HIDDEN //hide branch select and show hidden input instead of it
@var BRANCH_EMAIL //get branch for email select
@var BRANCH_CNAHGE_EMAIL //change EMAIL_SEND field value to selected branch email in select
@var TITLE //title of page to send
@var URL //url of page to send
@var SUBSCRIBE_ID //Id of subscribtion, to which will sign up user after success form send
*/
if ($arParams['HIDE_TITLE'] != "Y" || $arParams['FORM_TITLE']):
    $FormTitle = $arResult['arForm']['NAME'];
    if ($arParams['FORM_TITLE'])
        $FormTitle = $arParams['FORM_TITLE'];
?>
    <div class="section-title text-center"><span><?=$FormTitle;?></span></div>
<? endif;?>
<?
if ($arResult["isFormNote"] != "Y")
{
?><? if ($arResult['arForm']['DESCRIPTION']):?><div class="popup-form--text text-center"><?=$arResult['arForm']['DESCRIPTION'];?></div><? endif;?>
<?=$arResult["FORM_HEADER"]?>
<div class="form">
<? 
$labelCol = "text-left form-label mb-10";
$fieldCol = "";
$oneInLineCol = "text-center";
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
    if (strpos(strtolower($inputLabel),'должность') !== false){
        $arResult['arrVALUES'][$inputName] = $arParams['TITLE'] ;
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
    <div class="row form-group flex-vertical">
        <div class="col col-12 <?=$labelCol;?>">
            <label for="<?=$code;?>"><?=$inputLabel;?> <? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
        </div>
        <div class="col col-12 <?=$fieldCol;?>">
            <textarea id="<?=$code;?>" class="form-control like-input<?=$class?>" name="<?=$inputName;?>" placeholder="<?=$inputPlaceholder;?>"><?=$arResult['arrVALUES'][$inputName]?></textarea>
        </div>
    </div>    
    <? elseif ($inputLabel == "EMAIL_SEND"):?>
    <input value="<?=$arParams['EMAIL_SEND'];?>" id="<?=$code;?>" name="<?=$inputName;?>" type="hidden">    
    <? elseif ($inputLabel == "Страница"):?>
    <input value="<?=$arParams['TITLE'];?>" name="<?=$inputName;?>" type="hidden">
    <? elseif (strpos(strtolower($inputLabel),'урл') !== false):?>
    <input value="<?=$arParams['URL'];?>" name="<?=$inputName;?>" type="hidden">
    <? 
    elseif (strpos(strtolower($inputLabel),'филиал') !== false || strpos(strtolower($inputLabel),'ваш регион') !== false) :
    ?>
    <input value="<?=$_SESSION['BXExtra']['REGION']['IBLOCK']['REGION'];?>" id="<?=$code;?>" name="<?=$inputName;?>" type="hidden">      
    <?
    elseif ($formFieldInfo['FIELD_TYPE'] == 'dropdown'):
        $selectName = 'form_'.$formFieldInfo['FIELD_TYPE'].'_'.$code;
    ?> 
        <div class="row form-group flex-vertical">
            <div class="col col-12 <?=$labelCol;?>">
                <label for="<?=$code;?>"><?=$inputLabel;?><? if($arQuestion['REQUIRED'] == "Y"):?> <span class="color-orange">*</span><? endif;?></label>
            </div>
            <div class="col col-12 <?=$fieldCol;?>">
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
        </div>
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
  <div class="text-center"><?=FormatHelper::Success('Спасибо! Ваша заявка принята!<br>Мы перезвоним Вам в рабочее время<br>(пн-пт 06:00-18:00, по МСК)');?></div>
  <?
}
?>
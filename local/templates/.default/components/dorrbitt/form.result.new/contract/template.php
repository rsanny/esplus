<?php 
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\DataArefmetikaCapchy\DataArefmetikaCapchy;
use DorrBitt\IB\IBOT;
use \OptimalGroup\Core;
$OptimalGroup = Core::Settings();
DataArefmetikaCapchy::ar_remove();
?>
<? if ($arResult['arForm']['DESCRIPTION']):?><div class="popup-form--text text-center"><?=$arResult['arForm']['DESCRIPTION'];?></div><? endif;?>
<?
if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
    <div style="display:none" class="bg-danger bg-message mb-20">Необходимо принять условия обработки данных</div>
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
    if (strpos(strtolower($inputLabel),'инн') !== false){
        $dataQEINN[] = $code;
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
                    <input class="<?=$class;?> check_box" type="checkbox" checked name="<?=$checkboxCheckCode?>[]" value="<?=$formFieldInfo['ID'];?>">
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
                    <input type="<?=$fieldType;?>" name="<?=$listCode?>" value="<?=$listItem['ID'];?>"<?=$selected;?>><i class="<?=$class;?>"></i><span style="font-size: 12px;"><?=$listItem['MESSAGE'];?></span>
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
    <?php
    elseif ($formFieldInfo['FIELD_TYPE'] == 'dropdown'):
        $selectName = 'form_' . $formFieldInfo['FIELD_TYPE'] . '_' . $code;
    ?>
        <div class="row form-group flex-vertical">
            <div class="col col-12 <?= $labelCol; ?>">
                <label for="<?= $code; ?>"><?= $inputLabel; ?><? if ($arQuestion['REQUIRED'] == "Y"): ?> <span
                            class="color-orange">*</span><? endif; ?></label>
            </div>
            <div class="col col-12 <?= $fieldCol; ?>">
                <div class="form-select js-select<?= $class; ?>">
                    <select id="<?= $code; ?>" name="<?= $selectName; ?>">
                        <option selected disabled hidden value=""><?= $inputPlaceholder; ?></option>
                        <? foreach ($arQuestion['STRUCTURE'] as $id => $arStructure): ?>
                            <option value="<?= $arStructure['ID']; ?>"<? if ($arStructure['ID'] == $arResult['arrVALUES'][$selectName]): ?> selected<? endif; ?>><?= $arStructure['MESSAGE']; ?></option>
                        <? endforeach; ?>
                    </select>
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
        </div>        
    <? else:?>
    <?php if($inputName == "form_text_853" || $inputName == "form_text_854" || $inputName == "form_text_856" || $inputName == "form_text_857" 
             || $inputName == "form_text_858" || $inputName == "form_text_859" || $inputName == "form_text_860" 
             || $inputName == "form_text_861" || $inputName == "form_text_862" || $inputName == "form_text_863" 
             || $inputName == "form_text_864" || $inputName == "form_text_865" || $inputName == "form_text_866" 
             || $inputName == "form_text_867" || $inputName == "form_text_868" || $inputName == "form_text_869"):?>
        <?php if(IBOT::is_bot() == 0):?>
            <div id="xyz_text" >
                <input id="<?= $code; ?>" type="hidden" data-name="<?= $inputName; ?>" name="<?= $inputName; ?>" class="form-control<?= $class ?>" placeholder="" value="capcha" >
            </div>
        <?php endif;?>
    <?php else:?>
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
    <?php endif;?>               
    <? endif;?>
<? endforeach;?>    
    <div class="row form-group">
        <div class="col col-12 <?=$oneInLineCol;?>">
            <button class="btn btn-orange w-170" name="web_form_submit" value="<?=$arResult['arForm']['BUTTON'];?>"><?=$arResult['arForm']['BUTTON'];?></button>
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
if (isset($arResult['FORM_ERRORS'])){?>
    <script>
        $(document).ready(function(){
            var scroll_el = $(".is-error").first().attr('id'); // возьмем содержимое атрибута href, должен быть селектором, т.е. например начинаться с # или .
            if ($("#"+scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
                $('html, body').animate({ scrollTop: $("#"+scroll_el).offset().top }, 500); // анимируем скроолинг к элементу scroll_el
            }
            if($(".check_box").hasClass("is-error"))
            {
                $(".bg-danger").show();
                $('html, body').animate({scrollTop: $(".bg-danger").offset().top}, 500);
                //alert(444);
            }
            return false; // выключаем стандартное действие
        });
    </script>
<?}
?>

<script type="text/javascript">
$(document).ready(function() {
    $("#<?=$dataQEINN[0]?>").inputmask('Regex', {regex: "\\d*"});
});
</script>
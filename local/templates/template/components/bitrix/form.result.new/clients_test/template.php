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
    <div class="section-title text-center"><span><?= $FormTitle; ?></span></div>
<? endif; ?>
<? if ($arResult['arForm']['DESCRIPTION']): ?>
    <div class="popup-form--text text-center"><?= $arResult['arForm']['DESCRIPTION']; ?></div><? endif; ?>
<?
if ($arResult["isFormNote"] != "Y") {
    ?>
    <?= $arResult["FORM_HEADER"] ?>
    <div class="form">
        <div class="none">
            <?= implode(",", $arResult['FORM_ERRORS']); ?>
        </div>
        <?
        $labelCol = "col-md-4 col-lg-5 text-left form-label";
        $fieldCol = "col-md-8 col-lg-7";
        $oneInLineCol = "col-md-8 offset-md-4 col-lg-7 offset-lg-5 text-md-left text-center";
        $hasBranch = false;
        if ($arParams['IN_COLUMN']) {
            $labelCol = "text-left form-label mb-10";
            $fieldCol = "";
            $oneInLineCol = "text-center";
        }

        $arRequiredFields = [];

        foreach ($arResult['QUESTIONS'] as $code => $arQuestion):
            $formFieldInfo = reset($arQuestion['STRUCTURE']);
            $inputName = 'form_' . $formFieldInfo['FIELD_TYPE'] . '_' . $formFieldInfo['ID'];
            $class = "";
            $inputLabel = $arResult['arQuestions'][$code]['TITLE'];
            $inputPlaceholder = $arResult['arQuestions'][$code]['COMMENTS'];
            $isPhone = false;

            if ($arQuestion['REQUIRED'] == "Y") {
                $arRequiredFields[] = $inputName;
            }

            if (strpos(strtolower($inputLabel), 'телефон') !== false) {
                $isPhone = true;
                $class .= " js-InputMask";
            }
            if (strpos(strtolower($inputLabel), 'e-mail') !== false) {
                $isEmail = true;
                $class .= " js-Email";
            }
            if (isset($arResult['FORM_ERRORS'][$code])) {
                $class .= " is-error";
            }
            if (strpos(strtolower($inputLabel), 'должность') !== false) {
                $arResult['arrVALUES'][$inputName] = $arParams['TITLE'];
            }


            if ($formFieldInfo['FIELD_TYPE'] == "checkbox"):
                $checkboxCheckCode = 'form_' . $formFieldInfo['FIELD_TYPE'] . '_' . $code;
                $CheckSign = $inputPlaceholder;
                if (constant($inputPlaceholder)) {
                    $CheckSign = constant($inputPlaceholder);
                }
                ?>
                <div class="row form-group">
                    <div class="col col-12 <?= $oneInLineCol; ?>">
                        <div class="checkbox for-rules<?= $class; ?>">
                            <label>
                                <input type="checkbox" checked name="<?= $checkboxCheckCode ?>[]"
                                       value="<?= $formFieldInfo['ID']; ?>">
                                <i class="<?= $class; ?>"></i><span><?= $CheckSign; ?></span>
                            </label>
                        </div>
                    </div>
                </div>
            <?
            elseif ($formFieldInfo['FIELD_TYPE'] == "textarea"):?>
                <div class="row form-group flex-vertical">
                    <div class="col col-12 <?= $labelCol; ?>">
                        <label for="<?= $code; ?>"><?= $inputLabel; ?> <? if ($arQuestion['REQUIRED'] == "Y"): ?> <span
                                    class="color-orange">*</span><? endif; ?></label>
                    </div>
                    <div class="col col-12 <?= $fieldCol; ?>">
                        <textarea id="<?= $code; ?>" class="form-control like-input<?= $class ?>"
                                  name="<?= $inputName; ?>"
                                  placeholder="<?= $inputPlaceholder; ?>"><?= $arResult['arrVALUES'][$inputName] ?></textarea>
                    </div>
                </div>
            <?
            elseif ($inputLabel == "EMAIL_SEND"):
                $EMAIL_SEND = $code;
                ?>
                <input value="<?= $arParams['EMAIL_SEND']; ?>" id="<?= $code; ?>" name="<?= $inputName; ?>"
                       type="hidden">
            <? elseif ($inputLabel == "Услуга" || $inputLabel == "Страница"): ?>
                <input value="<?= $arParams['TITLE']; ?>" name="<?= $inputName; ?>" type="hidden">
            <? elseif (strpos(strtolower($inputLabel), 'товар') !== false): ?>
                <input value="<?= $arParams['PRODUCT']; ?>" name="<?= $inputName; ?>" type="hidden">
            <? elseif (strpos(strtolower($inputLabel), 'заголовок') !== false): ?>
                <input value="<?= $arParams['TITLE']; ?>" name="<?= $inputName; ?>" type="hidden">
            <? elseif (strpos(strtolower($inputLabel), 'тип') !== false): ?>
                <input value="<?= $_SESSION['BXExtra']['SITE']['NAME']; ?>" name="<?= $inputName; ?>" type="hidden">
            <? elseif (strpos(strtolower($inputLabel), 'урл') !== false): ?>
                <input value="<?= $arParams['URL']; ?>" name="<?= $inputName; ?>" type="hidden">
            <?
            elseif (strpos(strtolower($inputLabel), 'филиал') !== false || strpos(strtolower($inputLabel), 'ваш регион') !== false) :
                if ($arParams['BRANCH_HIDDEN']):
                    ?>
                    <input value="<?= $_SESSION['BXExtra']['REGION']['IBLOCK']['REGION']; ?>" id="<?= $code; ?>"
                           name="<?= $inputName; ?>" type="hidden">
                <?
                else:
                    $hasBranch = true;
                    $BranchId = $code;
                    ?>
                    <div class="row form-group flex-vertical">
                        <div class="col col-12 <?= $labelCol; ?>">
                            <label for="<?= $code; ?>"><?= $inputLabel; ?><? if ($arQuestion['REQUIRED'] == "Y"): ?>
                                    <span class="color-orange">*</span><? endif; ?></label>
                        </div>
                        <div class="col col-12 <?= $fieldCol; ?>">
                            <div class="form-select js-select<?= $class; ?>">
                                <select id="<?= $code; ?>" name="<?= $inputName; ?>">
                                    <option value=""><?= $arResult['arQuestions'][$code]['COMMENTS']; ?></option>
                                    <?
                                    foreach ($arResult['BRANCH'] as $id => $arBranch):
                                        $selected = false;
                                        if ($arBranch['NAME'] == $arResult['arrVALUES'][$inputName])
                                            $selected = true;
                                        elseif ($arBranch['SELECTED'] == "Y" && !$arResult['arrVALUES'][$inputName])
                                            $selected = true;
                                        ?>
                                        <option value="<?= $arBranch['NAME']; ?>"<? if ($selected): ?> selected<? endif; ?>
                                                data-email="<?= $arBranch['EMAIL']; ?>"><?= $arBranch['NAME']; ?></option>
                                    <? endforeach; ?>
                                </select>
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                    </div>
                <?
                endif;

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
                                <option value=""><?= $inputPlaceholder; ?></option>
                                <? foreach ($arQuestion['STRUCTURE'] as $id => $arStructure): ?>
                                    <option value="<?= $arStructure['ID']; ?>"<? if ($arStructure['ID'] == $arResult['arrVALUES'][$selectName]): ?> selected<? endif; ?>><?= $arStructure['MESSAGE']; ?></option>
                                <? endforeach; ?>
                            </select>
                            <i class="fa fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
            <? elseif ($formFieldInfo['FIELD_TYPE'] == 'file'): ?>
                <? $i = 0; ?>
                <? foreach ($arQuestion['STRUCTURE'] as $arAnswer): ?>
                    <div id="row_file_input_<?= $arAnswer['ID'] ?>" class="row form-group flex-vertical row-file-input"
                         <? if ($i > 0): ?>hidden<? endif; ?>>
                        <div class="col col-12 <?= $labelCol; ?>">
                            <? if ($i == 0): ?>
                                <label for="<?= $code; ?>"><?= $inputLabel; ?><? if ($arQuestion['REQUIRED'] == "Y"): ?>
                                        <span class="color-orange">*</span><? endif; ?></label>
                            <? endif; ?>
                        </div>
                        <div class="col col-12 <?= $fieldCol; ?>">
                            <div class="form-control--container">
                                <div class="form-control-file form-control<?= $class ?>">
                                    <i>Выберите файл</i>
                                    <!--                        --><? //=$arQuestion['HTML_CODE'];?>
                                    <input name="form_file_<?= $arAnswer['ID'] ?>" class="inputfile" size="0"
                                           type="<?= $arAnswer['FIELD_TYPE'] ?>" <?= $arAnswer['FIELD_PARAM'] ?>>
                                    <script>
                                        $('input[name=form_file_<?=$arAnswer["ID"]?>]').change(function (e) {
                                            if (this.files && this.files[0]) {
                                                $(this).closest('#row_file_input_<?=$arAnswer["ID"]?>').next('.row-file-input').prop('hidden', false);
                                            }
                                        })
                                    </script>
                                    <span></span>
                                    <a href="#"></a>
                                </div>
                                <? if ($inputPlaceholder): ?>
                                    <i class="form-control--question js-toolTip"
                                       data-text="<?= $inputPlaceholder; ?>"></i>
                                <? endif; ?>
                            </div>
                        </div>
                    </div>
                    <? $i++; ?>
                <? endforeach; ?>
            <? else: ?>
                <div class="row form-group flex-vertical">
                    <div class="col col-12 <?= $labelCol; ?>">
                        <label for="<?= $code; ?>"><?= $inputLabel; ?><? if ($arQuestion['REQUIRED'] == "Y"): ?> <span
                                    class="color-orange">*</span><? endif; ?></label>
                    </div>
                    <div class="col col-12 <?= $fieldCol; ?>">
                        <input
                                id="<?= $code; ?>"
                                type="<?= $formFieldInfo['FIELD_TYPE']; ?>"
                                name="<?= $inputName; ?>"
                                class="form-control<?= $class ?>"
                            <? if ($isPhone): ?> data-inputmask="'mask': '+7 999 999 99 99','placeholder':'Х'"<? endif; ?>
                                placeholder="<?= $inputPlaceholder; ?>"
                                value="<?= $arResult['arrVALUES'][$inputName] ?>"
                        >
                    </div>
                </div>
            <? endif; ?>
        <? endforeach; ?>
        <? if (!empty($arRequiredFields)): ?>
            <script>
                $(window).load(function () {
                    var arRequiredFields = <?= json_encode($arRequiredFields) ?>;

                    var funcCheckFields = function () {
                        var disabled = false;

                        for (var k in arRequiredFields) {
                            var field = $('[name=' + arRequiredFields[k] + ']');
                            if (field.val() !== undefined) {
                                if (field.hasClass('is-error') || !field.val().trim()) {
                                    disabled = true;
                                    $('button[name=web_form_submit]').prop('disabled', true);
                                }
                            }
                        }

                        if (!disabled) {
                            $('button[name=web_form_submit]').prop('disabled', false);
                        }

                        return disabled;
                    };

                    funcCheckFields();

                    $('form[name=<?= $arResult['arForm']["SID"] ?>]').on('input', 'input, textarea', function (e) {
                        $(this).trigger('change');
                        funcCheckFields();
                    });

                    $('form[name=<?= $arResult['arForm']["SID"] ?>]').on('change', 'input, textarea, select', function (e) {
                        funcCheckFields();
                    });

                    //$('form[name=<?//= $arResult['arForm']["SID"] ?>//]').on('click', 'button[name=web_form_submit]', function (e) {
                    //    e.preventDefault();
                    //
                    //    if(funcCheckFields()){
                    //        return false;
                    //    }
                    //
                    //    return true;
                    //});
                });
            </script>
        <? endif; ?>
        <div class="row form-group">
            <div class="col col-12 <?= $oneInLineCol; ?>">
                <button class="btn btn-orange w-170" name="web_form_submit"
                        value="<?= $arResult['arForm']['BUTTON']; ?>"><?= $arResult['arForm']['BUTTON']; ?></button>
            </div>
        </div>
    </div>
    <? if ($hasBranch && $arParams['BRANCH_CNAHGE_EMAIL'] == "Y"): ?>
        <script>
            $(function () {
                $('#<?=$EMAIL_SEND;?>').val($('#<?=$BranchId;?>').find('option:selected').data('email'));
                $('body').on('change', '#<?=$BranchId;?>', function (e) {
                    var email = $(this).find('option:selected').data('email');
                    $('#<?=$EMAIL_SEND;?>').val(email);
                });
            });
        </script>
    <? endif; ?>
    <?= $arResult["FORM_FOOTER"] ?>
    <?
} //endif (isFormNote)
else {
    ?>
    <div class="text-center"><?= FormatHelper::Success('Спасибо! Ваша заявка принята!'); ?></div>
    <script>
        <?
        $FromDataSubmit = array(
            "ID" => $arParams['WEB_FORM_ID'],
            "RESULT_ID" => $_REQUEST['RESULT_ID'],
            "TITLE" => $arParams['TITLE'],
            "URL" => $arParams['URL']
        );
        if ($arParams['ANALYTICS']) {
            $FromDataSubmit['ANALYTICS'] = $arParams['ANALYTICS'];
        }
        ?>
        top.OptimalGroup.Form.Success(<?=json_encode($FromDataSubmit);?>);
    </script>
    <?
}
?>
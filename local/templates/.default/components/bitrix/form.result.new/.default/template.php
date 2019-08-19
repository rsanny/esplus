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
<!--<pre>--><? //print_r($arResult)?><!--</pre>-->
<? if ($arResult['arForm']['DESCRIPTION']): ?>
    <div class="popup-form--text text-center"><?= $arResult['arForm']['DESCRIPTION']; ?></div><? endif; ?>
<?
if ($arResult["isFormNote"] != "Y") {
    ?>
    <?= $arResult["FORM_HEADER"] ?>
    <div style="display:none" class="bg-danger bg-message mb-20">Необходимо принять условия обработки данных</div>
    <div class="form">
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
                                <input class="<?= $class; ?> check_box" type="checkbox" checked
                                       name="<?= $checkboxCheckCode ?>[]"
                                       value="<?= $formFieldInfo['ID']; ?>">
                                <i class="<?= $class; ?>"></i><span style="font-size: 12px;"><?= $CheckSign; ?></span>
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
                                    <option selected disabled hidden
                                            value=""><?= $arResult['arQuestions'][$code]['COMMENTS']; ?></option>
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
                                <option selected disabled hidden value=""><?= $inputPlaceholder; ?></option>
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
                    <div <? if ($i > 0): ?>style="display: none;"<? endif; ?> id="row_file_input_<?= $arAnswer['ID'] ?>"
                         class="row form-group flex-vertical row-file-input">
                        <div class="col col-12 <?= $labelCol; ?>">
                            <? if ($i == 0): ?>
                                <label for="<?= $code; ?>"><?= $inputLabel; ?><? if ($arQuestion['REQUIRED'] == "Y"): ?>
                                        <span class="color-orange">*</span><? endif; ?></label>
                            <? endif; ?>
                        </div>
                        <div class="col col-12 <?= $fieldCol; ?>">
                            <div class="form-control--container"
                                 <? if ($i > 0 && $arResult["ID"] == 27): ?>style="margin-top: -40px;"<? endif; ?>>
                                <div class="form-control-file form-control<?= $class ?>">
                                    <i>Выберите файлы</i>
                                    <!--                        --><? //=$arQuestion['HTML_CODE'];?>
                                    <script>
                                        var request_solution = true;
                                    </script>
                                    <input onchange="if(request_solution){files_ajax(this.files); request_solution = false;} else {request_solution = true;}" name="form_file_<?= $arAnswer['ID'] ?>"
                                           size="0"
                                           type="<?= $arAnswer['FIELD_TYPE'] ?>" multiple>
                                    <div class="question form-control--question js-toolTip new_question"
                                         data-text="Возможно загрузить не более 6 файлов общим размером до 10 МБ. Допустимые форматы файлов: jpg, jpeg, png, bmp, pdf, doc, docx, rtf, xls, xlsx. "></div>
                                    <script>
                                        /*$('input[name=form_file_<?=$arAnswer["ID"]?>]').change(function () {
                                            if (this.files && this.files[0]) {
                                                var razmer=this.files[0].size/1024/1024;
                                                if(razmer<2) {
                                                    var reader = new FileReader();
                                                    reader.onload = function (e) {
                                                        $('#img-preview<?=$arAnswer["ID"]?>').attr('src', e.target.result);
                                                    }
                                                    reader.readAsDataURL(this.files[0]);
                                                    $(".imgandsize<?=$arAnswer["ID"]?>").html('<img height="100" width="100" id="img-preview<?=$arAnswer["ID"]?>" src="" alt=""><span></span>')
                                                    $(".imgandsize<?=$arAnswer["ID"]?>").children().next().text(razmer.toFixed(2) + " мб");
                                                    $(this).closest('#row_file_input_<?=$arAnswer["ID"]?>').next('.row-file-input').prop('hidden', false);
                                                    $("#tooltip<?=$arAnswer["ID"]?>").show();
                                                }
                                                else
                                                {
                                                    alert("Размер файла слишком большой!("+razmer.toFixed(2)+" мб) Максимальный размер 2 мб");
                                                    $("[data-input=<?=$arAnswer["ID"]?>]").click();
                                                }
                                            }
                                        });*/
                                    </script>
                                    <span></span>
                                    <a data-input="<?= $arAnswer['ID'] ?>" href="#"></a>

                                </div>
                                <div class="imgandsize imgandsize<?= $arAnswer["ID"] ?>"></div>
                                <? if ($inputPlaceholder): ?>
                                    <i class="form-control--question js-toolTip"
                                       data-text="<?= $inputPlaceholder; ?>"></i>
                                <? endif; ?>
                            </div>
                        </div>
                    </div>
                    <? if ($i == 0): ?>
                        <div class="loader_files">Загрузка файлов...</div>
                        <div class="error_load"></div>
                    <? endif; ?>
                    <? $i++; ?>
                <? endforeach; ?>
                <div id="output_image"
                     <? if ($arParams["WEB_FORM_ID"] == 24): ?>style="display: flow-root!important;width: 60%!important;position: relative!important;left: 255px!important;"<? endif; ?>>

                </div>

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
        <script>
            var filesLoad = false;
            var sizes = 0;
            var count_file = 0;

            var img_path = "";

            var request_solution = true;

            function files_ajax(files) {
                var data1 = new FormData();
                $.each(files, function (key, value) {
                    data1.append(key, value);
                });
                data1.append("sizes", sizes);
                data1.append("count_file", count_file);
                //console.log(data1);
                $.ajax({ // инициaлизируeм ajax зaпрoс
                    url: '/gogogo.php',
                    type: 'POST',
                    data: data1,
                    cache: false,
                    dataType: 'json',
                    processData: false, // Не обрабатываем файлы (Don't process the files)
                    contentType: false, // Так jQuery скажет серверу что это строковой запрос
                    beforeSend: function (respond) { // сoбытиe дo oтпрaвки
                        $(".error_load").hide();
                        $(".loader_files").show();
                    },
                    success: function (respond, textStatus, jqXHR) {
                        if (respond.error == "false") {
                            $(".loader_files").hide();
                            var files_path = respond.files;
                            for (id in files_path) {
                                img_path += '<div style="float:left" id="EXTRACTION_' + files_path[id].size + '"><img width="50" height="50 " class="thumb"  src="' + files_path[id].src + '" /><span data-sizes="' + (files_path[id].size / 1024 / 1024).toFixed(2) + '" data-del="' + id + '" class="delete_prew">x</span><div>' + (files_path[id].size / 1024 / 1024).toFixed(2) + ' мб </div></div>';
                            }
                            $("#output_image").append(img_path);
                            img_path = "";

                            var found = {};

                            // $('div[id^=EXTRACTION_]').filter(function () {
                            //     var ending = this.id.replace("EXTRACTION_", "");
                            //     if (found.hasOwnProperty(ending)) {
                            //         return this;
                            //     } else {
                            //         found[ending] = ending;
                            //     }
                            // }).remove();
                            sizes = respond.sizes;
                            count_file = respond.count_file;
                            console.log(respond);

                        } else {
                            console.log(respond);
                            $(".is-visible").click();
                            $(".loader_files").hide();
                            $(".error_load").text(respond.error);
                            $(".error_load").show();
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log('ОШИБКИ AJAX запроса: ' + textStatus + '; ' + errorThrown);
                        // $(".is-visible").click();
                        // $(".loader_files").hide();
                        // $(".error_load").text('Ошибка при прикреплении файла! Попробуйте ещё раз.');
                        // $(".error_load").show();
                    }
                });
            }

            $(document).on("click", ".delete_prew", function (event) {
                var id_del = $(this).data("del");
                var size_img = $(this).data("sizes");
                sizes = sizes;
                count_file = count_file;
                $(this).parent().remove();
                var data1 = new FormData();
                data1.append("sizes", sizes);
                data1.append("count_file", count_file);
                data1.append("del", id_del);
                data1.append("size_img", size_img);

                $.ajax({ // инициaлизируeм ajax зaпрoс
                    url: '/gogogo1.php',
                    type: 'POST',
                    data: data1,
                    cache: false,
                    dataType: 'json',
                    processData: false, // Не обрабатываем файлы (Don't process the files)
                    contentType: false, // Так jQuery скажет серверу что это строковой запрос
                    success: function (respond, textStatus, jqXHR) {
                        sizes = respond.sizes;
                        count_file = respond.count_file;
                        console.log(respond);
                    },
                });

            });
        </script>
        <? if (!empty($arRequiredFields)): ?>
            <script>
                $(window).load(function () {
                    var arRequiredFields = <?= json_encode($arRequiredFields) ?>;

                    var funcCheckFields = function () {
                        //var disabled = false;

                        for (var k in arRequiredFields) {
                            var field = $('[name=' + arRequiredFields[k] + ']');
                            if (field.val() !== undefined) {
                                /*if (field.hasClass('is-error') || !field.val().trim()) {
                                    disabled = true;
                                    $('button[name=web_form_submit]').prop('disabled', true);
                                }*/
                            }
                        }

                        /*if (!disabled) {
                            $('button[name=web_form_submit]').prop('disabled', false);
                        }*/

                        //return disabled;
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
                <button class="btn btn-orange w-170 1" name="web_form_submit"
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
if (isset($arResult['FORM_ERRORS'])) {
    if ($arParams["WEB_FORM_ID"] == 8) {
        ?>
        <script>

            $(document).ready(function () {
                var scroll_el = $(".is-error").first().attr('id'); // возьмем содержимое атрибута href, должен быть селектором, т.е. например начинаться с # или .
                /*if ($("#" + scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
                    $('html, body').animate({scrollTop: $("#" + scroll_el).offset().top}, 500); // анимируем скроолинг к элементу scroll_el
                }*/

                $(".fancybox-overlay").scrollTop($("#" + scroll_el).offset().top - $(window).scrollTop());

                if ($(".check_box").hasClass("is-error")) {
                    $(".bg-danger").show();
                    $(".fancybox-overlay").scrollTop($(".bg-danger").offset().top - $(window).scrollTop());
                }


                //return false; // выключаем стандартное действие
            });
        </script>
        <?
    } else {
        ?>
        <script>
            $(document).ready(function () {
                var scroll_el = $(".is-error").first().attr('id'); // возьмем содержимое атрибута href, должен быть селектором, т.е. например начинаться с # или .
                if ($("#" + scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
                    $('html, body').animate({scrollTop: $("#" + scroll_el).offset().top}, 500); // анимируем скроолинг к элементу scroll_el
                }
                if ($(".check_box").hasClass("is-error")) {
                    $(".bg-danger").show();
                    $('html, body').animate({scrollTop: $(".bg-danger").offset().top}, 500);
                    //alert(444);
                }
                return false; // выключаем стандартное действие

            });
        </script>
    <?
    }
}
?>





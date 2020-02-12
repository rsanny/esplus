// на таких проектах лучше не используй const и let
$(document).ready(function() {
    const els = {
        formWrapper: '.form-send-wrapper',
        btnSubmit: '[data-js-submit]',
        labelCheckbox: '[data-checkbox-label]',
        requiredField: '[data-js-required]:not([type="checkbox"])'
    };

    const checkLabelCheckbox = function(e) {
        let currentForm = $(e.currentTarget).closest('form');
        let currentBtnSubmit = $(currentForm).find(els.btnSubmit);
        var validCount = 0;
        var requiredFieldsLength = currentForm.find(els.requiredField).length;

        currentForm.find(els.requiredField).each(function () {
            var valid = OptimalGroup.Form.ValidateInput.call(this);
            if (valid) {
                validCount++;
            }
        });

        let checkboxAll= $(currentForm).find( '.checkbox-required .icheckbox');
        let checkedCheckbox = $(currentForm).find('.checkbox-required .icheckbox--checked');

        if(checkboxAll.length !== checkedCheckbox.length || validCount !== requiredFieldsLength) {
            $(currentBtnSubmit).addClass('btn--disabled');
        } else {
            $(currentBtnSubmit).removeClass('btn--disabled');
            $(currentBtnSubmit).removeAttr("disabled");
        }
    };

    $(els.labelCheckbox).on('click', function (e) {
        setTimeout(function() {
            checkLabelCheckbox(e);
        }, 250)
    });

    $(els.requiredField).on('change', function(e)  {
        setTimeout(function() {
            checkLabelCheckbox(e);
        }, 250)
    });
});
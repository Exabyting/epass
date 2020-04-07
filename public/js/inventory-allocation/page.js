$(document).ready(function () {
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");
    $('.select').select2();

    let categoryRepeater = $(`.repeater-category-request`).repeater({
        // isFirstItemUndeletable: true,
        initEmpty: true,
        show: function () {

            if ($('.item-category-select').length !== 0) {
                dropdownSync('.item-category-select', inventoryItems, allItemsValues);
            }
            initiateTasks(this);
        },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        }
    });

    if (activeItemsOfThisRequest.length) {
        categoryRepeater.setList(activeItemsOfThisRequest);
    }

});


let validator = $('.inventory-allocation-form').validate({
    ignore: [],
    errorClass: 'danger',
    successClass: 'success',
    highlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function (error, element) {
        if (element.attr('type') == 'radio') {
            error.insertBefore(element.parents().siblings('.radio-error'));
        } else if (element[0].tagName == "SELECT") {
            error.insertAfter(element.siblings('.select2-container'));
        } else if (element.attr('id') == 'ckeditor') {
            error.insertAfter(element.siblings('#cke_ckeditor'));
        } else {
            error.insertAfter(element);
        }
    },
    rules: {},
    submitHandler: function (form, event) {
        form.submit();
    }
});

function dropdownSync(element, allItems, allValues) {

    let allSelectedValues = [];
    let difference = [];

    $(element).not(':last').each(function (e) {
        //this returns only the selected value
        let selectedValue = $(this).val();
        if (selectedValue)
            allSelectedValues.push(parseInt(selectedValue));
    });

    //get the difference between the two array
    difference = allValues.filter(x => !allSelectedValues.includes(x));

    let lastSelectElement = $(element).last();
    lastSelectElement.empty();

    difference.forEach(element => {
        lastSelectElement.append('<option value="' + element + '">' + allItems[element] + '</option>')
    });
}

function initiateTasks(instance) {
    $(instance).slideDown();
    $(instance).find('.repeater-select').select2();
}

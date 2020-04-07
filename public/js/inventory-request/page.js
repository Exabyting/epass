$(document).ready(function () {
    let isCategoryInitialized = false, isBoughtCategoryInitialized = false;

    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");

    let categoryRepeater = $(`.repeater-category-request`).repeater({
        // isFirstItemUndeletable: true,
        initEmpty: true,
        show: function () {
            if ($('.item-category-select').length !== 0 && isCategoryInitialized) {
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

    isCategoryInitialized = true;

    let boughtCategoryRepeater = $(`.repeater-bought-category-request`).repeater({
        // isFirstItemUndeletable: true,
        initEmpty: true,
        show: function () {
            if ($('.bought-category-select').length !== 0 && isBoughtCategoryInitialized) {
                dropdownSync('.bought-category-select', inventoryBoughtItems, allBoughtItemsValues);
            }
            initiateTasks(this);
        },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }


        }
    });

    if (inactiveItemsOfThisRequest.length) {
        boughtCategoryRepeater.setList(inactiveItemsOfThisRequest);
    }

    isBoughtCategoryInitialized = true;

    $(`.repeater-new-category-request`).repeater({
        // isFirstItemUndeletable: true,
        initEmpty: true,
        show: function () {
            initiateTasks(this);
        },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        }
    });

});


let validator = $('.inventory-request-form').validate({
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

$('.item-category-select').click(function (e) {
    console.log('click');
    dropdownSync('.item-category-select', inventoryItems, allItemsValues);
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

    console.log(allSelectedValues);

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

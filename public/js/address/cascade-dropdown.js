function getAjaxData(url) {
    return {
        delay: 250,
        cache: true,
        url: url,
        processResults: function (data) {
            return {
                results: data.map(data => {
                    return {
                        id: data.id,
                        text: data.name
                    }
                })
            };
        },
    };
}

function prepareSelect2(selector, url) {
    $(selector).val('').trigger('change');
    $(selector).select2({
        ajax: getAjaxData(url)
    });
}

$('select[name=division_id]').on('change', function (e) {
    let url = `/divisions/${e.target.value}/districts`;
    let districtSelector = 'select[name=district_id]';

    $('select[name=thana_id]').val('').trigger('change');
    $('select[name=union_id]').val('').trigger('change');
    prepareSelect2(districtSelector, url);
});

$('select[name=district_id]').on('change', function (e) {
    let url = `/districts/${e.target.value}/thanas`;
    let thanaSelector = 'select[name=thana_id]';

    $('select[name=union_id]').val('').trigger('change');
    prepareSelect2(thanaSelector, url);
});

$('select[name=thana_id]').on('change', function (e) {
    let url = `/thanas/${e.target.value}/unions`;
    let unionSelector = 'select[name=union_id]';

    prepareSelect2(unionSelector, url);
});
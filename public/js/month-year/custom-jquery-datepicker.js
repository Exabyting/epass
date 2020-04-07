function monthYearDatePicker(selector) {
    $(selector).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'MM yy',
        onClose: function () {
            var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
        },
        beforeShow: function () {
            if ((selDate = $(this).val()).length > 0) {
                iYear = selDate.substring(selDate.length - 4, selDate.length);
                iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), $(this).datepicker('option', 'monthNames'));
                $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
                $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
            }
        },
        onChangeMonthYear: function () {
            $(this).datepicker('hide');
        }

    });
}

function currentFiscalYear() {
    if (moment().quarter() == 4 || moment().quarter() == 3) {
        var current_fiscal_year_start = moment().month('July').startOf('month');
        var current_fiscal_year_end = moment().add(1, 'year').month('June').endOf('month');
    } else {
        var current_fiscal_year_start = moment().subtract(1, 'year').month('July').startOf('month');
        var current_fiscal_year_end = moment().month('June').endOf('month');
    }

    return {
        start: current_fiscal_year_start,
        end: current_fiscal_year_end
    };
}

function lastFiscalYear() {
    if (moment().quarter() == 4 || moment().quarter() == 3) {
        var last_fiscal_year_start = moment().subtract(1, 'year').month('July').startOf('month');
        var last_fiscal_year_end = moment().month('June').endOf('month');
    } else {
        var last_fiscal_year_start = moment().subtract(2, 'year').month('July').startOf('month');
        var last_fiscal_year_end = moment().subtract(1, 'year').month('June').endOf('month');
    }

    return {
        start: last_fiscal_year_start,
        end: last_fiscal_year_end
    };
}
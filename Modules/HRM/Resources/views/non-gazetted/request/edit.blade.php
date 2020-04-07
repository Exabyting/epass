@extends('hrm::layouts.master')
@section('title', 'Appraisal Request Create')

@section('content')
    <!-- Striped row layout section start -->
    <section id="striped-row-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="striped-row-layout-basic">@lang('hrm::appraisal.title') @lang('labels.form')
                            (@lang('labels.non-gazetted') @lang('labels.officer'))</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            {{--                            <ul class="list-inline mb-0">--}}
                            {{--                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>--}}
                            {{--                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                            {{--                            </ul>--}}
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['route' =>  ['ng-appraisal-request.update', $ngAppraisalRequest->id],'class' => 'form appraisal-request-form']) !!}
                            @include('hrm::non-gazetted.request.partials.edit-form')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('page-js')
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>

    <script>
        $(document).ready(() => {
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");

            $('.select').select2();


        {{--    let customMinDate = '{{ $startDateOfRequest }}';--}}
        {{--    let minDate = customMinDate ? new Date(customMinDate) : '-2y';--}}

        {{--    var today = new Date();  //Get today's date--}}
        {{--    var startDate = new Date(today.getFullYear(), 0, 1);  //To get the 1st Jan of current year--}}
        {{--    var lastDate = new Date(today.getFullYear(), 11, 31);  //To get the 31st Dec of current year--}}

        {{--    $("#reportingDateStart").datepicker({--}}
        {{--        dateFormat: 'yy-mm-dd',--}}
        {{--        changeMonth: true,--}}
        {{--        // changeYear: true,--}}
        {{--        minDate: startDate,--}}
        {{--        // maxDate: '+3y',--}}
        {{--        onSelect: function (date) {--}}

        {{--            // var selectedDate = new Date(date);--}}
        {{--            // var msecsInADay = 86400000*90;--}}
        {{--            // var endDate = new Date(selectedDate.getTime() + msecsInADay);--}}
        {{--            var endDate = new Date(date);--}}

        {{--            //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker--}}
        {{--            $("#reportingDateEnd").datepicker("option", "minDate", endDate);--}}
        {{--            //$("#reportingDateEnd").datepicker( "option", "maxDate", '+3y' );--}}

        {{--        }--}}
        {{--    });--}}


        {{--    $("#reportingDateEnd").datepicker({--}}
        {{--        dateFormat: 'yy-mm-dd',--}}
        {{--        changeMonth: true,--}}
        {{--        // changeYear: true--}}
        {{--        maxDate: lastDate,--}}
        {{--    });--}}

        {{--    $(`.history-entry-repeater`).repeater({--}}
        {{--        isFirstItemUndeletable: true,--}}
        {{--        // initEmpty: true,--}}
        {{--        show: function () {--}}
        {{--            $(this).slideDown();--}}
        {{--        },--}}
        {{--        hide: function (deleteElement) {--}}
        {{--            if (confirm('Are you sure you want to delete this element?')) {--}}
        {{--                $(this).slideUp(deleteElement);--}}
        {{--            }--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        jQuery.validator.addMethod("birthDate", function (value, element) {
            return this.optional(element) || /^(?=\d)(?:(?:31(?!.(?:0?[2469]|11))|(?:30|29)(?!.0?2)|29(?=.0?2.(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(?:\x20|$))|(?:2[0-8]|1\d|0?[1-9]))([-.\/])(?:1[012]|0?[1-9])\1(?:1[6-9]|[2-9]\d)?\d\d(?:(?=\x20\d)\x20|$))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/.test(value);
        });

        // , "Please specify the correct Date!"

        let validator = $('.appraisal-request-form').validate({
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
            rules: {
                birth_date: {
                    required: true,
                    birthDate: true,
                },
            },
            submitHandler: function (form, event) {
                form.submit();
            }
        });
    </script>
@endpush

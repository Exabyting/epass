@extends('hrm::layouts.master')
@section('title', 'Appraisal Report Create')

@section('content')
    <!-- Striped row layout section start -->
    <section id="striped-row-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">@lang('hrm::appraisal.report') @lang('labels.form')</h4>
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
                            {!! Form::open(['route' =>  ['appraisal-report.store'],'class' => 'form appraisal-report-form']) !!}
                            @include('hrm::appraisal.report.partials.form')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('page-js')
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

    <script>
        $(document).ready(() => {
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");

            $('.select').select2();

            $("#reportingDateStart").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                // minDate: new Date(),
                maxDate: '+3y',
                onSelect: function(date){

                    var selectedDate = new Date(date);
                    var msecsInADay = 86400000;
                    var endDate = new Date(selectedDate.getTime() + msecsInADay);

                    //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker
                    $("#reportingDateEnd").datepicker( "option", "minDate", endDate );
                    $("#reportingDateEnd").datepicker( "option", "maxDate", '+3y' );

                }
            });

            $("#reportingDateEnd").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true
            });
        });


        let validator = $('.appraisal-report-form').validate({
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
    </script>
@endpush

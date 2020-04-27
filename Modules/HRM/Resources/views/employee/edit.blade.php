@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.edit_employee'))

@section("content")
    @php
        $tab_action = isset($employee_id) ? '' : 'disabled';
        $employee_id = isset($employee_id) ? $employee_id : '';
    @endphp
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="repeat-form">@lang('hrm::employee.edit_employee')</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements">
                    {{--                    <ul class="list-inline mb-0">--}}
                    {{--                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>--}}
                    {{--                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>--}}
                    {{--                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                    {{--                    </ul>--}}
                </div>

            </div>
            <div class="card-content collapse show" style="">
                <div class="card-body">
                    <div class="tab-content px-1 pt-1">
                        {!! Form::model($employee, ['url' => ['/hrm/employee', $employee->id], 'method' =>'put' , 'files'=>'true', 'class'=>'form form-horizontal', 'novalidate']) !!}
                        @include('hrm::employee.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/photo-upload.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
    <script>
        var employee_id = "{{ $employee->id }}";
        let selectPlaceholder = '{!! trans('labels.select') !!}';

        $(document).ready(function () {
            $('.DatePicker').pickadate({});
            $('.addMore').click(function () {
                $('.EmployeeId').val(employee_id);
                $('.DatePicker').pickadate({});
                // $(".instituteSelection, .addDepartmentSection, .academicDegreeSelect").select2({width: '100%'});

                $('input,select,textarea').jqBootstrapValidation('destroy');
                $('input,select,textarea').jqBootstrapValidation();

            });


            var url = document.URL;
            var hash = url.substring(url.indexOf('#'));

            $(".nav-tabs").find("li a").each(function (key, val) {
                if (hash == $(val).attr('href')) {
                    $(val).click();
                }

                $(val).click(function (ky, vl) {
                    location.hash = $(this).attr('href');
                });
            });


        })
    </script>
@endpush

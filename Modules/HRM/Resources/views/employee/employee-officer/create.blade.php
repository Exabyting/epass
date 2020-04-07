@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.add_employee_officer'))

@section("content")
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="repeat-form">@lang('hrm::employee.add_employee_officer')</h4>
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
                        {!! Form::open(['route' => 'employee-officer.store', 'class'=>'form form-horizontal employee-officer-form', 'novalidate', 'files'=> true]) !!}
                        <div class="form-group {{ $errors->has('employee_id') ? ' error' : '' }}">
                            {{ Form::label('employee_id', trans('hrm::employee.employee'), ['class' => 'required']) }}
                            {!! Form::select('employee_id',$allEmployees, null,
                               [
                                   'placeholder' => trans('labels.select'),
                                   'class' => 'form-control select required',
                                   'data-msg-required'=> trans('labels.This field is required')
                               ])
                            !!}
                            @if ($errors->has('employee_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('employee_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        @include('hrm::employee.employee-officer.partials.form')
                        <div class="form-actions col-md-12 ">
                            <div class="pull-right">
                                {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
                                <a href="{{ url('/hrm/employee') }}">
                                    <button type="button" class="btn btn-warning mr-1">
                                        <i class="la la-times"></i> @lang('labels.cancel')
                                    </button>
                                </a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('.employee-officer-repeater').repeater({
                isFirstItemUndeletable: true,
                // initEmpty: true,
                show: function () {
                    $(this).slideDown();
                    $('.select2-container').remove();
                    $('.select').select2();
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        });

        jQuery.validator.addMethod("date", function (value, element) {
            return this.optional(element) || /^(?=\d)(?:(?:31(?!.(?:0?[2469]|11))|(?:30|29)(?!.0?2)|29(?=.0?2.(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(?:\x20|$))|(?:2[0-8]|1\d|0?[1-9]))([-.\/])(?:1[012]|0?[1-9])\1(?:1[6-9]|[2-9]\d)?\d\d(?:(?=\x20\d)\x20|$))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/.test(value);
        });

        let validator = $('.employee-officer-form').validate({
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
                iro_id: {
                    required: true,
                    // date: true,
                },
                cro_id: {
                    required: true,
                    // date: true,
                },start_date: {
                    required: true,
                    date: true,
                },
                end_date: {
                    required: true,
                    date: true,
                },
            },
            submitHandler: function (form, event) {
                form.submit();
            }
        });
    </script>
@endpush

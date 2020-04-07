@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.edit_employee_officer'))

@section("content")
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>@lang('hrm::employee.add_employee_officer')</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered employee-officer-repeater">
                        <thead>
                        <tr style="text-align: center">
                            <th width="35%">{{trans('hrm::appraisal.recipient')}}</th>
                            <th width="35%">{{trans('hrm::appraisal.approved_by')}}</th>
                            <th width="24%">{{trans('hrm::appraisal.start_date')}}</th>
                            <th width="24%">{{trans('hrm::appraisal.end_date')}}</th>
                            <th width="10%">@lang('labels.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            {!! Form::open(['route' =>  ['employee-officer.update','employeeOfficer' => $employeeOfficer->id], 'class'=>'form form-horizontal', 'novalidate',]) !!}
                            @csrf
                            <td width="50%">
                                {!! Form::select('iro_id',$employeeList, $employeeOfficer->iro_id,
                                    [
                                    'required' => 'required',
                                    'placeholder' => trans('labels.select'),
                                    'class' => 'form-control select required ',
                                    'data-msg-required'=> trans('labels.This field is required')
                                    ])
                                 !!}
                            </td>
                            <td width="50%">
                                {!! Form::select('cro_id',$employeeList, $employeeOfficer->cro_id,
                                    [
                                    'required' => 'required',
                                    'placeholder' => trans('labels.select'),
                                    'class' => 'form-control select required ',
                                    'data-msg-required'=> trans('labels.This field is required')
                                    ])
                                 !!}
                            </td>
                            <td width="24%">
                                {!! Form::text('start_date', $employeeOfficer->start_date,
                                    [
                                        'class' => "form-control ",
                                        //"placeholder" => "DD-MM-YYYY",//trans('hrm::appraisal.birth_date'),
                                        'data-msg-required' => trans('labels.This field is required'),
                                    ])
                                !!}
                            </td>
                            <td width="24%">
                                {!! Form::text('end_date', $employeeOfficer->end_date,
                                    [
                                        'class' => "form-control ",
                                        //"placeholder" => "DD-MM-YYYY",//trans('hrm::appraisal.birth_date'),
                                        'data-msg-required' => trans('labels.This field is required'),
                                    ])
                                !!}
                            </td>
                            <td>{{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}</td>
                            {!! Form::close() !!}
                        </tr>
                        </tbody>
                    </table>
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
    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
@endpush

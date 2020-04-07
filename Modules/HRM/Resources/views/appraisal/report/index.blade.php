@extends('hrm::layouts.master')
@section('title', trans('hrm::appraisal.report'))

@section('content')

    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::appraisal.report') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
{{--                            <ul class="list-inline mb-0">--}}
{{--                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>--}}
{{--                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>--}}
{{--                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
{{--                                <li><a data-action="close"><i class="ft-x"></i></a></li>--}}
{{--                            </ul>--}}
                            @can('acr-request-access')
                                <a href="{{ route('appraisal-report.create') }}" class="btn btn-primary btn-lg">
                                    <i class="ft-plus white"></i> রিপোর্ট @lang('labels.form')
                                </a>
                            @endcan
                        </div>
                    </div>


                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <table class="table table-striped table-bordered zero-configuration text-center">
                                <thead>
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('hrm::appraisal.submitted_by')</th>
                                    <th>@lang('labels.id')</th>
                                    <th>@lang('hrm::designation.designation')</th>
                                    <th>@lang('labels.date')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($appraisalReports as $report)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td><a href="{{ route('appraisal-report.show', $report->id) }}">{{ $report->requester->first_name }} {{ $report->requester->last_name }}</a></td>
                                            <td>{{$report->requester->employee_id}}</td>
                                            <td>{{$report->requester->designation->name}}</td>
                                            <td>{{ date('d M, Y h:i A', strtotime($report->created_at)) }}</td>
                                            <td>
                                                <button id="btnAction" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnAction" class="dropdown-menu mt-1 dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('appraisal-report.show', $report->id) }}"><i class="ft-eye"></i> @lang('labels.details')</a>
    {{--                                                    <div class="dropdown-divider"></div>--}}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('page-css')

@endpush
@push('page-js')

@endpush

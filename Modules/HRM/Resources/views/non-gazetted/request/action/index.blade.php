@extends('hrm::layouts.master')
@section('title', 'Appraisal Request')

@section('content')

    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::appraisal.request') @lang('labels.list')
                            (@lang('labels.non-gazetted') @lang('labels.officer'))</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            {{--                            <ul class="list-inline mb-0">--}}
                            {{--                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>--}}
                            {{--                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>--}}
                            {{--                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                            {{--                                <li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                            {{--                            </ul>--}}
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
                                    <th>@lang('hrm::appraisal.ng-recipient')</th>
                                    <th>@lang('hrm::appraisal.approved_by')</th>
                                    <th>@lang('labels.status')</th>
                                    <th>@lang('labels.date')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($actions as $action)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>
                                            <a href="{{ route('ng-appraisal-request.action-approved-view', $action->appraisalRequest->id) }}"> {{ $action->appraisalRequest->requester->first_name }} {{ $action->appraisalRequest->requester->last_name }} </a>
                                        </td>
                                        <td>{{$action->appraisalRequest->requester->employee_id}}</td>
                                        <td>{{$action->appraisalRequest->requester->designation->name}}</td>
                                        <td>
                                            <a href="{{ route('ng-appraisal-request.action-approved-view', $action->appraisalRequest->id) }}"> {{ $action->appraisalRequest->receiver->first_name }} {{ $action->appraisalRequest->receiver->last_name }} </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('ng-appraisal-request.action-approved-view', $action->appraisalRequest->id) }}"> {{ $action->actor->first_name }} {{ $action->actor->last_name }} </a>
                                        </td>
                                        <td>{{optional($action->appraisalRequest->approval)->status ?? 'On processing'}}</td>
                                        <td>{{ date('d M, Y h:i A', strtotime($action->created_at)) }}</td>
                                        <td>
                                            <button id="btnAction" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    class="btn btn-info dropdown-toggle">
                                                <i class="la la-cog"></i>
                                            </button>
                                            <span aria-labelledby="btnAction"
                                                  class="dropdown-menu mt-1 dropdown-menu-right">
                                                    <a class="dropdown-item"
                                                       href="{{ route('ng-appraisal-request.action-approved-view', $action->appraisalRequest->id) }}"><i
                                                            class="ft-eye"></i> @lang('labels.details')</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" target="_blank"
                                                       href="{{ route('ng-acr.print', $action->appraisalRequest->id) }}"><i
                                                            class="la la-print"></i> @lang('labels.print')</a>
                                                @can('system-super-admin')
                                                    @if(optional(optional($action->appraisalRequest)->approval)->status !== 'Completed')
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item"
                                                           href="{{ route('ng-appraisal-request-approval.create', $action->appraisalRequest->id) }}"><i
                                                                class="la la-print"></i> @lang('labels.system-admin-action')</a>
                                                    @endif
                                                @endcan
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

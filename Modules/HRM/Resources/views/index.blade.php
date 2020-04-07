@extends('hrm::layouts.master')
@section('title', 'HRM')
@section('content')
    <div class="container">
        <section id="minimal-statistics-bg">
            @can('acr-request-access')
                <div class="row">
                    @can('gazetted-officer')
                        <div class="col-xl-3 col-lg-6 col-12">
                            <a href="{{ route('appraisal-request.create') }}" class="eti-link">
                                <div class="card bg-warning">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="align-self-center">
                                                    <img class="title-icon" alt="title-icon"
                                                         src="https://i.imgur.com/fgZUgjr.png">
                                                </div>
                                                <div class="media-body text-white text-right">
                                                    <h3 class="text-white">গোপন রিপোর্ট @lang('labels.form')</h3>
                                                    <span>@lang('labels.gazetted') @lang('labels.officer')</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endcan
                    @can('non-gazetted-officer')
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('ng-appraisal-request.create') }}" class="eti-link">
                            <div class="card bg-warning">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <img class="title-icon" alt="title-icon"
                                                     src="https://i.imgur.com/fgZUgjr.png">
                                            </div>
                                            <div class="media-body text-white text-right">
                                                <h3 class="text-white">গোপন রিপোর্ট @lang('labels.form')</h3>
                                                <span>@lang('labels.non-gazetted') @lang('labels.officer')</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endcan
                    @can('gazetted-cadre-officer')
                        <div class="col-xl-3 col-lg-6 col-12">
                            <a href="{{ route('gco-appraisal-request.create') }}" class="eti-link">
                                <div class="card bg-warning">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="align-self-center">
                                                    <img class="title-icon" alt="title-icon"
                                                         src="https://i.imgur.com/fgZUgjr.png">
                                                </div>
                                                <div class="media-body text-white text-right">
                                                    <h3 class="text-white">গোপন রিপোর্ট @lang('labels.form')</h3>
                                                    <span>@lang('labels.gazetted-cadre-officer') @lang('labels.officer')</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endcan
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('appraisal-report.create') }}" class="eti-link">
                            <div class="card bg-success">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <img class="title-icon" alt="title-icon"
                                                     src="https://i.imgur.com/tsXDyJN.png">
                                            </div>
                                            <div class="media-body text-white text-right">
                                                <h3 class="text-white">রিপোর্ট</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @php
                    $isExistCRO = $data['evaluatedRequests']->count();
                    $isExistIRO = $data['actionTakenRequests']->count();
                @endphp
                @if($isExistCRO || $isExistIRO)
                    @php
                        $activeCRO = ($isExistCRO && !$isExistIRO) ? 'active' : '';
                        $activeIRO = (!$isExistCRO && $isExistIRO) ? 'active' : '';
                        $activeCRO = ($isExistCRO && $isExistIRO) ? 'active' : $activeCRO;
                    @endphp
                    <div class="row match-height">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">@lang('hrm::appraisal.request') @lang('labels.list')</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs nav-underline no-hover-bg">
                                            @if($isExistCRO)
                                                <li class="nav-item">
                                                    <a class="nav-link {{ $activeCRO }}" data-toggle="tab"
                                                       aria-controls="cro-tab"
                                                       href="#cro-tab" aria-expanded="true">As CRO</a>
                                                </li>
                                            @endif
                                            @if($isExistIRO)
                                                <li class="nav-item">
                                                    <a class="nav-link {{ $activeIRO }}" data-toggle="tab"
                                                       aria-controls="iro-tab" href="#iro-tab"
                                                       aria-expanded="false">As IRO</a>
                                                </li>
                                            @endif
                                        </ul>
                                        <div class="tab-content px-1 pt-1">
                                            @if($isExistCRO)
                                                <div role="tabpanel" class="tab-pane {{ $activeCRO }}" id="cro-tab"
                                                     aria-expanded="true" aria-labelledby="base-cro-tab">
                                                    <table
                                                            class="table table-striped table-bordered zero-configuration text-center">
                                                        <thead>
                                                        <tr>
                                                            <th>@lang('labels.serial')</th>
                                                            <th>@lang('hrm::appraisal.submitted_by')</th>
                                                            <th>@lang('labels.id')</th>
                                                            <th>@lang('hrm::designation.designation')</th>
                                                            <th>@lang('hrm::appraisal.recipient')</th>
                                                            <th>@lang('hrm::appraisal.date_range')</th>
                                                            <th>@lang('labels.date')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($data['evaluatedRequests'] as $request)
                                                            <tr>
                                                                <th scope="row">{{$loop->iteration}}</th>
                                                                <td>{{ $request->requester->first_name }} {{ $request->requester->last_name }}</td>
                                                                <td>{{$request->requester->employee_id}}</td>
                                                                <td>{{$request->requester->designation->name}}</td>
                                                                <td>{{ $request->receiver->first_name }} {{ $request->receiver->last_name }}</td>
                                                                <td>{{ date('d M, Y', strtotime($request->reporting_date_start)) }}
                                                                    - {{ date('d M, Y', strtotime($request->reporting_date_end)) }}</td>
                                                                <td>{{ date('d M, Y h:i A', strtotime($request->created_at)) }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>

                                                    </table>
                                                </div>
                                            @endif
                                            @if($isExistIRO)
                                                <div class="tab-pane {{ $activeIRO }}" id="iro-tab"
                                                     aria-labelledby="base-iro-tab">
                                                    <table
                                                            class="table table-striped table-bordered zero-configuration text-center">
                                                        <thead>
                                                        <tr>
                                                            <th>@lang('labels.serial')</th>
                                                            <th>@lang('hrm::appraisal.submitted_by')</th>
                                                            <th>@lang('labels.id')</th>
                                                            <th>@lang('hrm::designation.designation')</th>
                                                            <th>@lang('hrm::appraisal.recipient')</th>
                                                            <th>@lang('hrm::appraisal.date_range')</th>
                                                            <th>@lang('labels.date')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($data['actionTakenRequests'] as $request)
                                                            <tr>
                                                                <th scope="row">{{$loop->iteration}}</th>
                                                                <td>{{ $request->requester->first_name }} {{ $request->requester->last_name }}</td>
                                                                <td>{{$request->requester->employee_id}}</td>
                                                                <td>{{$request->requester->designation->name}}</td>
                                                                <td>{{ $request->receiver->first_name }} {{ $request->receiver->last_name }}</td>
                                                                <td>{{ date('d M, Y', strtotime($request->reporting_date_start)) }}
                                                                    - {{ date('d M, Y', strtotime($request->reporting_date_end)) }}</td>
                                                                <td>{{ date('d M, Y h:i A', strtotime($request->created_at)) }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>

                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endcan
        </section>
    </div>

    @if(count($allRequests))
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4 class="card-title">@lang('hrm::appraisal.request') @lang('labels.list')
                        (@lang('hrm::appraisal.not_evaluated')) (@lang('labels.gazetted') @lang('labels.officer'))</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table class="table table-striped table-bordered text-center zero-configuration">
                                <thead>
                                <tr>
                                    <th>@lang('hrm::appraisal.submitted_by')</th>
                                    <th>@lang('labels.id')</th>
                                    <th>@lang('hrm::designation.designation')</th>
                                    <th>@lang('hrm::appraisal.date_range')</th>
                                    <th>@lang('labels.date')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allRequests as $request)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>
                                            @if(!$request->is_submitted)
                                                @if($request->requester->user->id == auth()->user()->id)
                                                    <a class=""
                                                       href="{{ route('appraisal-request.show', $request->id) }}">
                                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                                @endif
                                            @elseif(!$request->is_evaluated)
                                                @if($request->requester->user->id == auth()->user()->id)
                                                    <a class=""
                                                       href="{{ route('appraisal-request.action-approved-view', $request->id) }}">
                                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                                @else
                                                    <a class=""
                                                       href="{{ route('appraisal-request.first-evaluation', $request->id) }}">
                                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                                @endif
                                            @elseif(!$request->is_evaluation_submitted)
                                                @if($request->requester->user->id == auth()->user()->id)
                                                    <a class=""
                                                       href="{{ route('appraisal-request.action-approved-view', $request->id) }}">
                                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                                @else
                                                    <a class=""
                                                       href="{{ route('appraisal-request.second-evaluation', $request->id) }}">
                                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                                @endif
                                            @elseif(!$request->is_action_taken)
                                                @if($request->requester->user->id == auth()->user()->id || $request->receiver->user->id == auth()->user()->id)
                                                    <a class=""
                                                       href="{{ route('appraisal-request.action-approved-view', $request->id) }}">
                                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                                @else
                                                    <a class=""
                                                       href="{{ route('appraisal-request.action', $request->id) }}"> {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{$request->requester->employee_id}}</td>
                                        <td>{{$request->requester->designation->name}}</td>
                                        <td>{{ date('d M, Y', strtotime($request->reporting_date_start)) }}
                                            - {{ date('d M, Y', strtotime($request->reporting_date_end)) }}</td>
                                        <td>{{ date('d M, Y h:i A', strtotime($request->created_at)) }}</td>
                                        <td>
                                            @if(!$request->is_submitted)
                                                @if($request->requester->user->id == auth()->user()->id)
                                                    <a class="btn btn-primary btn-sm btn-round"
                                                       href="{{ route('appraisal-request.show', $request->id) }}">
                                                        @lang('labels.submit') </a>
                                                @endif
                                            @elseif(!$request->is_evaluation_submitted)
                                                @if(!$request->is_evaluated && $request->receiver->user->id == auth()->user()->id)
                                                    <a class="btn btn-info btn-sm btn-round"
                                                       href="{{ route('appraisal-request.first-evaluation', $request->id) }}">
                                                        Evaluate </a>
                                                @elseif(!$request->is_evaluation_submitted && $request->receiver->user->id == auth()->user()->id)
                                                    <a class="btn btn-primary btn-sm btn-round"
                                                       href="{{ route('appraisal-request.second-evaluation', $request->id) }}">
                                                        Submit Evaluate </a>
                                                @endif
                                            @elseif(!$request->is_action_taken && $request->summarizedEvaluation->receiver->user->id === auth()->user()->id)
                                                <a class="btn btn-success btn-sm btn-round"
                                                   href="{{ route('appraisal-request.action', $request->id) }}">
                                                    Take Action </a>
                                            @else
                                                <a class="btn btn-info btn-sm btn-round"
                                                   href="{{ route('appraisal-request.action-approved-view', $request->id) }}">
                                                    @lang('labels.details') </a>
                                            @endif
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
    @endif

    @if(count($actionTakenRequests))
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('hrm::appraisal.request') @lang('labels.list')
                    (@lang('hrm::appraisal.evaluated')) (@lang('labels.gazetted') @lang('labels.officer'))</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
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
                            <th>@lang('hrm::appraisal.recipient')</th>
                            <th>@lang('hrm::appraisal.approved_by')</th>
                            <th>@lang('labels.status')</th>
                            <th>@lang('hrm::appraisal.date_range')</th>
                            <th>@lang('labels.date')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($actionTakenRequests as $request)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>
                                    <a href="{{ route('appraisal-request.action-approved-view', $request->id) }}">
                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }}</a>
                                </td>
                                <td>{{$request->requester->employee_id}}</td>
                                <td>{{$request->requester->designation->name}}</td>
                                <td>
                                    <a href="{{ route('appraisal-request.action-approved-view', $request->id) }}">
                                        {{ $request->receiver->first_name }} {{ $request->receiver->last_name }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('appraisal-request.action-approved-view', $request->id) }}">
                                        {{ $request->summarizedEvaluation->receiver->first_name }}
                                        {{ $request->summarizedEvaluation->receiver->last_name }}</a>
                                </td>
                                <td>{{optional($request->approval)->status ?? "On processing"}}</td>
                                <td>{{ date('d M, Y', strtotime($request->reporting_date_start)) }}
                                    - {{ date('d M, Y', strtotime($request->reporting_date_end)) }}</td>
                                <td>{{ date('d M, Y h:i A', strtotime($request->created_at)) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif


    @if(count($ngAllRequests))
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4 class="card-title">@lang('hrm::appraisal.request') @lang('labels.list')
                        (@lang('hrm::appraisal.not_evaluated')) (@lang('labels.non-gazetted') @lang('labels.officer'))
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table class="table table-striped table-bordered text-center zero-configuration">
                                <thead>
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('hrm::appraisal.submitted_by')</th>
                                    <th>@lang('labels.id')</th>
                                    <th>@lang('hrm::designation.designation')</th>
                                    <th>@lang('hrm::appraisal.date_range')</th>
                                    <th>@lang('labels.date')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ngAllRequests as $request)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>
                                            @if(!$request->is_submitted)
                                                @if($request->requester->user->id == auth()->user()->id)
                                                    <a class=""
                                                       href="{{ route('ng-appraisal-request.show', $request->id) }}">
                                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                                @endif
                                            @elseif(!$request->is_evaluated)
                                                @if($request->requester->user->id == auth()->user()->id)
                                                    <a class=""
                                                       href="{{ route('ng-appraisal-request.action-approved-view', $request->id) }}">
                                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                                @else
                                                    <a class=""
                                                       href="{{ route('ng-appraisal-request.first-evaluation', $request->id) }}">
                                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                                @endif
                                            @elseif(!$request->is_evaluation_submitted)
                                                @if($request->requester->user->id == auth()->user()->id)
                                                    <a class=""
                                                       href="{{ route('ng-appraisal-request.action-approved-view', $request->id) }}">
                                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                                @else
                                                    <a class=""
                                                       href="{{ route('ng-appraisal-request.second-evaluation', $request->id) }}">
                                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                                @endif
                                            @elseif(!$request->is_action_taken)
                                                @if($request->requester->user->id == auth()->user()->id || $request->receiver->user->id == auth()->user()->id )
                                                    <a class=""
                                                       href="{{ route('ng-appraisal-request.action-approved-view', $request->id) }}">
                                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                                @else
                                                    <a class=""
                                                       href="{{ route('ng-appraisal-request.action', $request->id) }}">
                                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{$request->requester->employee_id}}</td>
                                        <td>{{$request->requester->designation->name}}</td>
                                        <td>{{ date('d M, Y', strtotime($request->reporting_date_start)) }}
                                            - {{ date('d M, Y', strtotime($request->reporting_date_end)) }}</td>
                                        <td>{{ date('d M, Y h:i A', strtotime($request->created_at)) }}</td>
                                        <td>
                                            @if(!$request->is_submitted)
                                                @if($request->requester->user->id == auth()->user()->id)
                                                    <a class="btn btn-primary btn-sm btn-round"
                                                       href="{{ route('ng-appraisal-request.show', $request->id) }}">
                                                        @lang('labels.submit') </a>
                                                @endif
                                            @elseif(!$request->is_evaluation_submitted)
                                                @if(!$request->is_evaluated && $request->receiver->user->id == auth()->user()->id)
                                                    <a class="btn btn-info btn-sm btn-round"
                                                       href="{{ route('ng-appraisal-request.first-evaluation', $request->id) }}">
                                                        Evaluate </a>
                                                @elseif(!$request->is_evaluation_submitted && $request->receiver->user->id == auth()->user()->id)
                                                    <a class="btn btn-primary btn-sm btn-round"
                                                       href="{{ route('ng-appraisal-request.second-evaluation', $request->id) }}">
                                                        Submit Evaluate </a>
                                                @endif
                                            @elseif(!$request->is_action_taken && $request->summarizedEvaluation->receiver->user->id === auth()->user()->id)
                                                <a class="btn btn-success btn-sm btn-round"
                                                   href="{{ route('ng-appraisal-request.action', $request->id) }}">
                                                    Take Action </a>
                                            @else
                                                <a class="btn btn-info btn-sm btn-round"
                                                   href="{{ route('ng-appraisal-request.action-approved-view', $request->id) }}">
                                                    @lang('labels.details') </a>
                                            @endif
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
    @endif

    @if(count($ngActionTakenRequests))
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('hrm::appraisal.request') @lang('labels.list')
                    (@lang('hrm::appraisal.evaluated')) (@lang('labels.non-gazetted') @lang('labels.officer'))</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
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
                            <th>@lang('hrm::appraisal.recipient')</th>
                            <th>@lang('hrm::appraisal.approved_by')</th>
                            <th>@lang('labels.status')</th>
                            <th>@lang('hrm::appraisal.date_range')</th>
                            <th>@lang('labels.date')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ngActionTakenRequests as $request)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>
                                    <a href="{{ route('ng-appraisal-request.action-approved-view', $request->id) }}">
                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }}</a>
                                </td>
                                <td>{{$request->requester->employee_id}}</td>
                                <td>{{$request->requester->designation->name}}</td>
                                <td>
                                    <a href="{{ route('ng-appraisal-request.action-approved-view', $request->id) }}">
                                        {{ $request->receiver->first_name }} {{ $request->receiver->last_name }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('ng-appraisal-request.action-approved-view', $request->id) }}">
                                        {{ $request->summarizedEvaluation->receiver->first_name }}
                                        {{ $request->summarizedEvaluation->receiver->last_name }}</a>
                                </td>
                                <td>{{optional($request->approval)->status ?? 'On processing'}}</td>
                                <td>{{ date('d M, Y', strtotime($request->reporting_date_start)) }}
                                    - {{ date('d M, Y', strtotime($request->reporting_date_end)) }}</td>
                                <td>{{ date('d M, Y h:i A', strtotime($request->created_at)) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

{{--FOR GCO--}}

@if(count($gcoAllRequests))
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4 class="card-title">@lang('hrm::appraisal.request') @lang('labels.list')
                    (@lang('hrm::appraisal.not_evaluated')) (@lang('labels.gazetted-cadre-officer'))
                </h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <table class="table table-striped table-bordered text-center zero-configuration">
                            <thead>
                            <tr>
                                <th>@lang('labels.serial')</th>
                                <th>@lang('hrm::appraisal.submitted_by')</th>
                                <th>@lang('labels.id')</th>
                                <th>@lang('hrm::designation.designation')</th>
                                <th>@lang('hrm::appraisal.date_range')</th>
                                <th>@lang('labels.date')</th>
                                <th>@lang('labels.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($gcoAllRequests as $request)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>
                                        @if(!$request->is_submitted)
                                            @if($request->requester->user->id == auth()->user()->id)
                                                <a class=""
                                                   href="{{ route('gco-appraisal-request.show', $request->id) }}">
                                                    {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                            @endif

                                        @elseif(!$request->is_evaluated)
                                            @if($request->requester->user->id == auth()->user()->id)
                                                <a class=""
                                                   href="{{ route('gco-appraisal-request.action-approved-view', $request->id) }}">
                                                    {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                            @else
                                                <a class=""
                                                   href="{{ route('gco-appraisal-request.first-evaluation', $request->id) }}">
                                                    {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                            @endif
                                        @elseif(!$request->is_evaluation_submitted)
                                            @if($request->requester->user->id == auth()->user()->id)
                                                <a class=""
                                                   href="{{ route('gco-appraisal-request.action-approved-view', $request->id) }}">
                                                    {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                            @else
                                                <a class=""
                                                   href="{{ route('gco-appraisal-request.second-evaluation', $request->id) }}">
                                                    {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                            @endif
                                        @elseif(!$request->is_action_taken)
                                            @if($request->requester->user->id == auth()->user()->id || $request->receiver->user->id == auth()->user()->id )
                                                <a class=""
                                                   href="{{ route('gco-appraisal-request.action-approved-view', $request->id) }}">
                                                    {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                            @else
                                                <a class=""
                                                   href="{{ route('gco-appraisal-request.action', $request->id) }}">
                                                    {{ $request->requester->first_name }} {{ $request->requester->last_name }} </a>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{$request->requester->employee_id}}</td>
                                    <td>{{$request->requester->designation->name}}</td>
                                    <td>{{ date('d M, Y', strtotime($request->reporting_date_start)) }}
                                        - {{ date('d M, Y', strtotime($request->reporting_date_end)) }}</td>
                                    <td>{{ date('d M, Y h:i A', strtotime($request->created_at)) }}</td>
                                    <td>
                                        @can('gazetted-cadre-officer')
                                        @if((($request->is_submitted)== 1)&&(($request->is_submitted_personal_Info)== 0)
                                        &&(($request->is_save_personal_Info)== 0))
                                            @if($request->requester->user->id == auth()->user()->id)
                                                <a href="{{ route('gco-appraisal-request.create', $request->id) }}"><i
                                                            class="ft ft-mail"></i>Edit</a>
                                            @endif
                                        @elseif((($request->is_submitted)== 1)&&(($request->is_submitted_personal_Info)== 0)
                                                &&(($request->is_save_personal_Info)== 1))
                                            @if($request->requester->user->id == auth()->user()->id)
                                                <a href="{{ route('gco-appraisal-personal-request.show', $request->id) }}"><i
                                                            class="ft ft-mail"></i>Submit</a>
                                            @endif
                                        @elseif((($request->is_submitted)== 1)&&(($request->is_submitted_personal_Info)== 1))
                                            @if($request->requester->user->id == auth()->user()->id)
                                                <a href="{{ route('gco-appraisal-request.action-approved-view', $request->id) }}"> @lang('labels.details')</a>
                                            @endif
                                            @endif
                                        @endcan
                                        @if(!$request->is_submitted)
                                            @if($request->requester->user->id == auth()->user()->id)
                                                <a class="btn btn-primary btn-sm btn-round"
                                                   href="{{ route('gco-appraisal-request.show', $request->id) }}">
                                                    @lang('labels.submit') </a>
                                            @endif
                                        @elseif(!$request->is_evaluation_submitted)
                                            @if(!$request->is_evaluated && $request->receiver->user->id == auth()->user()->id)
                                                <a class="btn btn-info btn-sm btn-round"
                                                   href="{{ route('gco-appraisal-request.first-evaluation', $request->id) }}">
                                                    Evaluate </a>
                                            @elseif(!$request->is_evaluation_submitted && $request->receiver->user->id == auth()->user()->id)
                                                <a class="btn btn-primary btn-sm btn-round"
                                                   href="{{ route('gco-appraisal-request.second-evaluation', $request->id) }}">
                                                    Submit Evaluate </a>
                                            @endif
                                        @elseif(!$request->is_action_taken && $request->summarizedEvaluation->receiver->user->id === auth()->user()->id)
                                            <a class="btn btn-success btn-sm btn-round"
                                               href="{{ route('gco-appraisal-request.action', $request->id) }}">
                                                Take Action </a>
                                        @else
                                            <a class="btn btn-info btn-sm btn-round"
                                               href="{{ route('gco-appraisal-request.action-approved-view', $request->id) }}">
                                                @lang('labels.details') </a>
                                        @endif
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
@endif

@if(count($gcoActionTakenRequests))
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('hrm::appraisal.request') @lang('labels.list')
                (@lang('hrm::appraisal.evaluated')) (@lang('labels.gazetted-cadre-officer'))</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
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
                        <th>@lang('hrm::appraisal.recipient')</th>
                        <th>@lang('hrm::appraisal.approved_by')</th>
                        <th>@lang('labels.status')</th>
                        <th>@lang('hrm::appraisal.date_range')</th>
                        <th>@lang('labels.date')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($gcoActionTakenRequests as $request)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>
                                <a href="{{ route('gco-appraisal-request.action-approved-view', $request->id) }}">
                                    {{ $request->requester->first_name }} {{ $request->requester->last_name }}</a>
                            </td>
                            <td>{{$request->requester->employee_id}}</td>
                            <td>{{$request->requester->designation->name}}</td>
                            <td>
                                <a href="{{ route('gco-appraisal-request.action-approved-view', $request->id) }}">
                                    {{ $request->receiver->first_name }} {{ $request->receiver->last_name }}</a>
                            </td>
                            <td>
                                <a href="{{ route('gco-appraisal-request.action-approved-view', $request->id) }}">
                                    {{ $request->summarizedEvaluation->receiver->first_name }}
                                    {{ $request->summarizedEvaluation->receiver->last_name }}</a>
                            </td>
                            <td>{{optional($request->approval)->status ?? 'On processing'}}</td>
                            <td>{{ date('d M, Y', strtotime($request->reporting_date_start)) }}
                                - {{ date('d M, Y', strtotime($request->reporting_date_end)) }}</td>
                            <td>{{ date('d M, Y h:i A', strtotime($request->created_at)) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
@endsection


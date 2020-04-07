@extends('hrm::layouts.master')
@section('title', 'Appraisal Request')

@section('content')

    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::appraisal.request') @lang('labels.list')
                            (@lang('hrm::appraisal.not_evaluated'))</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            {{--                            <ul class="list-inline mb-0">--}}
                            {{--                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>--}}
                            {{--                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>--}}
                            {{--                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                            {{--                                <li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                            {{--                            </ul>--}}
                            @can('acr-request-access')
                                <a href="{{ route('gco-appraisal-request.create') }}" class="btn btn-primary btn-lg">
                                    <i class="ft-plus white"></i> গোপন রিপোর্ট @lang('labels.form')
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
                                    <th>@lang('hrm::appraisal.recipient')</th>
                                    <th>@lang('labels.date')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allRequests as $request)
                                    @if(!$request->is_evaluation_submitted)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                @cannot('acr-request-access')
                                                    @if(!$request->is_evaluated)
                                                        <a href="{{ route('gco-appraisal-request.first-evaluation', $request->id) }}">{{ $request->requester->first_name }} {{ $request->requester->last_name }}</a>
                                                    @elseif(!$request->is_evaluation_submitted)
                                                        <a href="{{ route('gco-appraisal-request.second-evaluation', $request->id) }}">{{ $request->requester->first_name }} {{ $request->requester->last_name }}</a>
                                                    @endif
                                                @elsecannot($request->requester->user->id == auth()->user()->id)
                                                    {{--@if(!$request->is_submitted)--}}

                                                    @if((($request->is_submitted)== 1)&&(($personalInfo->is_submitted)== 0))

                                                        <a href="{{ route('gco-appraisal-request.show', $request->id) }}">{{ $request->requester->first_name }} {{ $request->requester->last_name }}</a>
                                                  {{--  @else--}}
                                                    @elseif((($request->is_submitted)== 1)&&(($personalInfo->is_submitted)== 1))
                                                        <a href="{{ route('gco-appraisal-personal-request.show', $request->id) }}">{{ $request->requester->first_name }} {{ $request->requester->last_name }}</a>
                                                   @else
                                                        {{ $request->requester->first_name }} {{ $request->requester->last_name }}

                                                    @endif
                                                @endcannot
                                                @if($request->is_evaluation_submitted && $request->summarizedEvaluation && !$request->is_action_taken)
                                                    @if($request->summarizedEvaluation->receiver->user->id == auth()->user()->id)
                                                        <a target="_blank"
                                                           href="{{ route('evaluated-acr.print.preview', $request->id) }}">{{ $request->requester->first_name }} {{ $request->requester->last_name }}</a>
                                                        |
                                                        <a target="_blank"
                                                           href="{{ route('evaluated-acr.print', $request->id) }}">{{ $request->requester->first_name }} {{ $request->requester->last_name }}</a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{$request->requester->employee_id}}</td>
                                            <td>{{$request->requester->designation->name}}</td>
                                            <td>
                                                @cannot('acr-request-access')
                                                    @if(!$request->is_evaluated)
                                                        <a href="{{ route('gco-appraisal-request.first-evaluation', $request->id) }}">{{ $request->receiver->first_name }} {{ $request->receiver->last_name }}</a>
                                                    @elseif(!$request->is_evaluation_submitted)
                                                        <a href="{{ route('gco-appraisal-request.second-evaluation', $request->id) }}">{{ $request->receiver->first_name }} {{ $request->receiver->last_name }}</a>
                                                    @endif
                                                @elsecannot($request->requester->user->id == auth()->user()->id)
                                                  {{--  @if(!$request->is_submitted)--}}
                                                    @if((($request->is_submitted)== 1)&&(($personalInfo->is_submitted)== 0))
                                                        <a href="{{ route('gco-appraisal-request.show', $request->id) }}">{{ $request->receiver->first_name }} {{ $request->receiver->last_name }}</a>
                                                    @elseif((($request->is_submitted)== 1)&&(($personalInfo->is_submitted)== 1))
                                                    <a href="{{ route('gco-appraisal-personal-request.show', $request->id) }}">{{ $request->receiver->first_name }} {{ $request->receiver->last_name }}</a>
                                                    @else
                                                        {{ $request->receiver->first_name }} {{ $request->receiver->last_name }}
                                                    @endif
                                                @endcannot
                                                @if($request->is_evaluation_submitted && $request->summarizedEvaluation && !$request->is_action_taken)
                                                    @if($request->summarizedEvaluation->receiver->user->id == auth()->user()->id)
                                                        <a target="_blank"
                                                           href="{{ route('evaluated-acr.print.preview', $request->id) }}">{{ $request->receiver->first_name }} {{ $request->receiver->last_name }}</a>
                                                        |
                                                        <a target="_blank"
                                                           href="{{ route('evaluated-acr.print', $request->id) }}">{{ $request->receiver->first_name }} {{ $request->receiver->last_name }}</a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{ date('d M, Y h:i A', strtotime($request->created_at)) }}</td>
                                            <td>
                                                <button id="btnAction" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnAction"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                    @cannot('acr-request-access')
                                                        @if(!$request->is_evaluated)
                                                            <a class="dropdown-item"
                                                               href="{{ route('gco-appraisal-request.first-evaluation', $request->id) }}"><i
                                                                    class="ft ft-award"></i> Evaluate</a>
                                                        @elseif(!$request->is_evaluation_submitted)
                                                            <a class="dropdown-item"
                                                               href="{{ route('gco-appraisal-request.second-evaluation', $request->id) }}"><i
                                                                    class="ft ft-mail"></i> Submit Evaluation</a>
                                                        @endif
                                                    @endcannot

                                                        @can('gazetted-cadre-officer')
                                                        @if((($request->is_submitted)== 1)&&(($request->is_submitted_personal_Info)== 0)
                                                            &&(($request->is_save_personal_Info)== 0))
                                                            @if($request->requester->user->id == auth()->user()->id)
                                                                <a href="{{ route('gco-appraisal-request.create', $request->id) }}"><i
                                                                            class="ft ft-mail"></i>Edit</a>
                                                            @endif
                                                        @endif
                                                        @if((($request->is_submitted)== 1)&&(($request->is_submitted_personal_Info)== 0)
                                                                &&(($request->is_save_personal_Info)== 1))
                                                            @if($request->requester->user->id == auth()->user()->id)
                                                                <a href="{{ route('gco-appraisal-personal-request.show', $request->id) }}"><i
                                                                            class="ft ft-mail"></i>Submit</a>
                                                            @endif
                                                        @endif

                                                        {{--@if((($request->is_submitted) == 1)&&(($request->is_submitted_personal_Info) == 0)
                                                            &&(($request->is_save_personal_Info)== 0))


                                                            <a class="dropdown-item"
                                                               href="{{ route('gco-appraisal-request.create', $request->id) }}"><i
                                                                        class="ft ft-mail"></i> Submit </a>
                                                         @endif--}}

                                                        @if(($request->is_submitted) && ($request->is_submitted_personal_Info))

                                                            <a class="dropdown-item"
                                                           href="{{ route('gco-appraisal-request.action-approved-view', $request->id) }}"><i
                                                                    class="ft-eye"></i> @lang('labels.details')</a>
                                                       {{-- <a class="dropdown-item"
                                                           href="{{ route('gco-appraisal-personal-request.edit', $request->id) }}"><i
                                                                    class="ft ft-edit"></i> Edit</a>--}}

                                                        @endif


                                                    @if(!$request->is_submitted)
                                                        <a class="dropdown-item"
                                                           href="{{ route('gco-appraisal-request.edit', $request->id) }}"><i
                                                                class="ft ft-edit"></i> Edit</a>
                                                       {{-- <a class="dropdown-item"
                                                           href="{{ route('gco-appraisal-personal-request.submit', $request->id) }}"><i
                                                                class="ft ft-mail"></i> Submit</a>--}}
                                                    @endif
                                                   @endcan
                                                    @cannot('acr-request-access')
                                                        @if($request->is_evaluation_submitted && $request->summarizedEvaluation && !$request->is_action_taken)
                                                            @if($request->summarizedEvaluation->receiver->user->id == auth()->user()->id)
                                                                <a class="dropdown-item"
                                                                   href="{{ route('gco-appraisal-request.action', $request->id) }}"><i
                                                                        class="ft ft-mail"></i> Take Action</a>
{{--                                                                <a class="dropdown-item" target="_blank"--}}
{{--                                                                   href="{{ route('evaluated-acr.print.preview', $request->id) }}"><i--}}
{{--                                                                        class="la la-eye"></i> @lang('labels.print_preview')</a>--}}
                                                                <a class="dropdown-item" target="_blank"
                                                                   href="{{ route('evaluated-acr.print', $request->id) }}"><i
                                                                        class="la la-print"></i> @lang('labels.print')</a>
                                                            @endif
                                                        @endif
                                                    @endcannot
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::appraisal.request') @lang('labels.list')
                            (@lang('hrm::appraisal.evaluated') @lang('labels.and') @lang('hrm::appraisal.waitingForAction'))</h4>
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
                                    <th>@lang('hrm::appraisal.recipient')</th>
                                    <th>@lang('hrm::appraisal.approved_by')</th>
                                    <th>@lang('labels.date')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allRequests as $request)
                                    @if($request->is_evaluation_submitted)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <a href="{{ route('gco-appraisal-request.show', $request->id) }}">{{ $request->requester->first_name }} {{ $request->requester->last_name }}</a>
                                            </td>
                                            <td>{{$request->requester->employee_id}}</td>
                                            <td>{{$request->requester->designation->name}}</td>
                                            <td>
                                                @if($request->is_evaluation_submitted)
                                                    <a href="{{ route('gco-appraisal-request.action-approved-view', $request->id) }}">{{ $request->receiver->first_name }} {{ $request->receiver->last_name }}</a>

                                                    {{--<a href="{{ route('gco-appraisal-request.second-evaluation-show', $request->id) }}">{{ $request->receiver->first_name }} {{ $request->receiver->last_name }}</a>--}}
                                                @else
                                                    {{ $request->receiver->first_name }} {{ $request->receiver->last_name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($request->is_action_taken)
                                                    <a href="{{ route('gco-appraisal-request.action-approved-view', $request->id) }}">{{ $request->summarizedEvaluation->receiver->first_name }}
                                                        {{ $request->summarizedEvaluation->receiver->last_name }}</a>
                                                @else
                                                    {{ $request->summarizedEvaluation->receiver->first_name }}
                                                    {{ $request->summarizedEvaluation->receiver->last_name }}
                                                @endif
                                            </td>
                                            <td>{{ date('d M, Y h:i A', strtotime($request->created_at)) }}</td>
                                            <td>
                                                <button id="btnAction" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnAction"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                   {{-- <a class="dropdown-item"
                                                       href="{{ route('gco-appraisal-request.show', $request->id) }}"><i
                                                            class="ft-eye"></i> @lang('labels.details')</a>--}}
                                                     <a class="dropdown-item"
                                                        href="{{ route('gco-appraisal-request.action-approved-view', $request->id) }}"><i
                                                                 class="ft-eye"></i> @lang('labels.details')</a>
                                                    @cannot('acr-request-access')
                                                        @if(!$request->is_evaluated)
                                                            <a class="dropdown-item"
                                                               href="{{ route('gco-appraisal-request.first-evaluation', $request->id) }}"><i
                                                                    class="ft ft-award"></i> Evaluate</a>
                                                        @elseif(!$request->is_evaluation_submitted)
                                                            <a class="dropdown-item"
                                                               href="{{ route('gco-appraisal-request.second-evaluation', $request->id) }}"><i
                                                                    class="ft ft-mail"></i> Submit Evaluation</a>
                                                        @endif
                                                    @elsecannot($request->requester->user->id == auth()->user()->id)
                                                        @if(!$request->is_submitted)
                                                            <a class="dropdown-item"
                                                               href="{{ route('gco-appraisal-request.edit', $request->id) }}"><i
                                                                    class="ft ft-edit"></i> Edit</a>
                                                            <a class="dropdown-item"
                                                               href="{{ route('gco-appraisal-request.submit', $request->id) }}"><i
                                                                    class="ft ft-mail"></i> Submit</a>
                                                        @endif
                                                    @endcannot
                                                    @if($request->is_evaluation_submitted && !$request->is_action_taken)
                                                        @if($request->summarizedEvaluation->receiver->id == auth()->user()->id)
                                                            <a class="dropdown-item"
                                                               href="{{ route('gco-appraisal-request.action', $request->id) }}"><i
                                                                    class="ft ft-mail"></i> Take Action</a>
                                                            {{--<a class="dropdown-item" target="_blank"
                                                               href="{{ route('gco-evaluated-acr.print', $request->id) }}"><i
                                                                    class="la la-print"></i> @lang('labels.print')</a>--}}
                                                        @endif
                                                    @endif
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="configuration">
        <div class="row">
            <div class="col-12">
                @if(count($requests))
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@lang('hrm::appraisal.request') @lang('labels.list')
                                (@lang('hrm::appraisal.evaluated'))</h4>
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
                                    @foreach($requests as $request)
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

            </div>
        </div>
    </section>

@endsection
@push('page-css')

@endpush
@push('page-js')

@endpush

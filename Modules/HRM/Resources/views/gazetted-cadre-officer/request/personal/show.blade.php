@extends('hrm::layouts.master')
@section('title', 'Appraisal Request')

@section('content')
    <!-- Striped row layout section start -->
    <section id="striped-row-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="striped-row-layout-basic">@lang('hrm::appraisal.title') @lang('hrm::appraisal.request')
                            (@lang('labels.gazetted-cadre-officer') @lang('labels.officer'))</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                {{--                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>--}}
                                {{--                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                                {{--                                @if($ngAppraisalRequest->requester->user->id == auth()->user()->id && !$ngAppraisalRequest->is_submitted)--}}
                                {{--                                    <a href="{{ route('appraisal-request.edit', $ngAppraisalRequest->id) }}"--}}
                                {{--                                       class="btn btn-primary btn-lg">--}}
                                {{--                                        <i class="la la-edit white"></i> @lang('hrm::appraisal.report') @lang('labels.edit')--}}
                                {{--                                    </a>--}}
                                {{--                                @endif--}}
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                @include('hrm::gazetted-cadre-officer.request.partials.request-personal-form-details')
                            </div>
                            @if($gcoAppraisalRequest->requester->user->id == auth()->user()->id && !$gcoAppraisalRequest->is_submitted)
                                <a href="{{ route('gco-appraisal-personal-request.edit', $gcoAppraisalRequest->id) }}"
                                   class="btn btn-primary btn-lg">
                                    <i class="la la-edit white"></i> @lang('hrm::appraisal.report') @lang('labels.edit')
                                </a>
                            @endif
                            @if(!$gcoAppraisalRequest->is_submitted)
                                <a href="{{ route('gco-appraisal-personal-request.submit', $gcoAppraisalRequest->id) }}"
                                   class="btn btn-primary btn-lg">
                                    <i class="ft-mail white"></i> @lang('labels.submit')
                                </a>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="form-section">
                            <i class="ft-tag"></i>@lang('labels.timeline')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7 timeline-wrapper">
                                    <table>
                                        <ul class="timeline">
                                            @if($gcoAppraisalRequest->is_submitted)
                                                <div class="timeline-badge">
                                                    <li class="timeline-item">
                                                        <label><strong> আবেদনকারী </strong></label> :
                                                        {{ $gcoAppraisalRequest->requester->first_name }}
                                                        {{ $gcoAppraisalRequest->requester->last_name }}
                                                        <i class="la la-arrow-right"></i>
                                                        <label><strong> অনুরোধ করেছেন </strong></label>
                                                        <i class="la la-arrow-right"></i>
                                                        {{ $gcoAppraisalRequest->receiver->first_name }}
                                                        {{ $gcoAppraisalRequest->receiver->last_name }}
                                                    </li>
                                                </div>
                                            @endif
                                            @if($gcoAppraisalRequest->is_evaluated)
                                                <div class="timeline-badge">
                                                    <li class="timeline-item">
                                                        <label><strong>রিপোর্ট প্রদানকারী অফিসার </strong></label> :
                                                        {{ $gcoAppraisalRequest->receiver->first_name }}
                                                        {{ $gcoAppraisalRequest->receiver->last_name }}
                                                        <i class="la la-arrow-right"></i>
                                                        <label><strong> মূল্যায়ন করেছেন </strong></label>
                                                    </li>
                                                </div>
                                            @endif
                                            @if($gcoAppraisalRequest->is_evaluation_submitted)
                                                <div class="timeline-badge">
                                                    <li class="timeline-item">
                                                        <label><strong> রিপোর্ট প্রদানকারী অফিসার </strong></label>
                                                        :
                                                        {{ $gcoAppraisalRequest->receiver->first_name }}
                                                        {{ $gcoAppraisalRequest->receiver->last_name }}
                                                        <i class="la la-arrow-right"></i>
                                                        <label><strong> মূল্যায়ন জমা দিয়েছেন </strong></label>
                                                        <i class="la la-arrow-right"></i>
                                                        {{ $gcoAppraisalRequest->summarizedEvaluation->receiver->first_name }}
                                                        {{ $gcoAppraisalRequest->summarizedEvaluation->receiver->last_name }}
                                                    </li>
                                                </div>
                                            @endif
                                            @if($gcoAppraisalRequest->is_action_taken)
                                                <div class="timeline-badge">
                                                    <li class="timeline-item">
                                                        <label><strong> প্রতিস্বাক্ষরকারী অফিসার </strong></label> :
                                                        {{ $gcoAppraisalRequest->summarizedEvaluation->receiver->first_name }}
                                                        {{ $gcoAppraisalRequest->summarizedEvaluation->receiver->last_name }}
                                                        <i class="la la-arrow-right"></i>
                                                        <label><strong> ব্যবস্থা নিয়েছেন </strong></label>
                                                    </li>
                                                </div>
                                            @endif
                                        </ul>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

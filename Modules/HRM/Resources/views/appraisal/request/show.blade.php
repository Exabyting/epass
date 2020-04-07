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
                            id="striped-row-layout-basic">@lang('hrm::appraisal.title') @lang('hrm::appraisal.request')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                {{--                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>--}}
                                {{--                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                                {{--                                @if($appraisalRequest->requester->user->id == auth()->user()->id && !$appraisalRequest->is_submitted)--}}
                                {{--                                    <a href="{{ route('appraisal-request.edit', $appraisalRequest->id) }}"--}}
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
                                <div class="col-md-7">
                                    <h4 class="form-section"><i
                                            class="ft-tag"></i> @lang('hrm::appraisal.personal_info')</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.job_name')</th>
                                            <td>{{ $appraisalRequest->job_name }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.date_range')</th>
                                            <td>{{ date('d M, Y', strtotime($appraisalRequest->reporting_date_start)) }}
                                                - {{ date('d M, Y', strtotime($appraisalRequest->reporting_date_end)) }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::employee.menu_name')</th>
                                            <td>{{ $appraisalRequest->requester->first_name }} {{ $appraisalRequest->requester->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.educational_qualifications')</th>
                                            <td>{{ $appraisalRequest->educational_qualifications }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.birth_date')</th>
                                            <td>{{ $appraisalRequest->birth_date }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.job_period')</th>
                                            <td>{{ $appraisalRequest->total_job_period }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.special_training')</th>
                                            <td>{{ $appraisalRequest->special_training }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.known_languages')</th>
                                            <td>{{ $appraisalRequest->languages }}</td>

                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.actual_job_period_under_officer')</th>
                                            <td>{{ $appraisalRequest->reporting_job_period }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.report_giving_officer')</th>
                                            <td>{{ $appraisalRequest->receiver->first_name }} {{ $appraisalRequest->receiver->last_name }}</td>
                                        </tr>
                                    </table>
                                </div>
                                @if($appraisalRequest->jobHistories)
                                    <div class="col-md-5">
                                        <h4 class="form-section"><i class="ft-tag"></i> আলোচ্য সময় যে পদে বহাল ছিলেন
                                        </h4>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>পদ</th>
                                                <th>সময়</th>
                                                <th>বেতন ও বেতন স্কেল</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($appraisalRequest->jobHistories as $jobHistory)
                                                <tr>
                                                    <td>{{ $jobHistory->designation }}</td>
                                                    <td>{{ $jobHistory->duration }}</td>
                                                    <td>{{ $jobHistory->salary_scale }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            @if($appraisalRequest->requester->user->id == auth()->user()->id && !$appraisalRequest->is_submitted)
                                <a href="{{ route('appraisal-request.edit', $appraisalRequest->id) }}"
                                   class="btn btn-primary btn-lg">
                                    <i class="la la-edit white"></i> @lang('hrm::appraisal.report') @lang('labels.edit')
                                </a>
                            @endif
                            @if(!$appraisalRequest->is_submitted)
                                <a href="{{ route('appraisal-request.submit', $appraisalRequest->id) }}"
                                   class="btn btn-primary btn-lg">
                                    <i class="ft-mail white"></i> @lang('labels.submit')
                                </a>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        {{--                        <h4 class="card-title" id="striped-row-layout-basic">--}}
                        <h4 class="form-section">
                            <i class="ft-tag"></i>@lang('labels.timeline')
                        </h4>
                        {{--                        </h4>--}}
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 timeline-wrapper">
                                    <table>
                                        <ul class="timeline">
                                            @if($appraisalRequest->is_submitted)
                                                <div class="timeline-badge">
                                                    <li class="timeline-item">
                                                        <label><strong> আবেদনকারী </strong></label> :
                                                        {{ $appraisalRequest->requester->first_name }}
                                                        {{ $appraisalRequest->requester->last_name }}
                                                        <i class="la la-arrow-right"></i>
                                                        <label><strong> অনুরোধ করেছেন </strong></label>
                                                        <i class="la la-arrow-right"></i>
                                                        {{ $appraisalRequest->receiver->first_name }}
                                                        {{ $appraisalRequest->receiver->last_name }}
                                                    </li>
                                                </div>
                                            @endif
                                            @if($appraisalRequest->is_evaluated)
                                                <div class="timeline-badge">
                                                    <li class="timeline-item">
                                                        <label><strong>রিপোর্ট প্রদানকারী অফিসার </strong></label> :
                                                        {{ $appraisalRequest->receiver->first_name }}
                                                        {{ $appraisalRequest->receiver->last_name }}
                                                        <i class="la la-arrow-right"></i>
                                                        <label><strong> মূল্যায়ন করেছেন </strong></label>
                                                    </li>
                                                </div>
                                            @endif
                                            @if($appraisalRequest->is_evaluation_submitted)
                                                <div class="timeline-badge">
                                                    <li class="timeline-item">
                                                        <label><strong> রিপোর্ট প্রদানকারী অফিসার </strong></label>
                                                        :
                                                        {{ $appraisalRequest->receiver->first_name }}
                                                        {{ $appraisalRequest->receiver->last_name }}
                                                        <i class="la la-arrow-right"></i>
                                                        <label><strong> মূল্যায়ন জমা দিয়েছেন </strong></label>
                                                        <i class="la la-arrow-right"></i>
                                                        {{ $appraisalRequest->summarizedEvaluation->receiver->first_name }}
                                                        {{ $appraisalRequest->summarizedEvaluation->receiver->last_name }}
                                                    </li>
                                                </div>
                                            @endif
                                            @if($appraisalRequest->is_action_taken)
                                                <div class="timeline-badge">
                                                    <li class="timeline-item">
                                                        <label><strong> প্রতিস্বাক্ষরকারী অফিসার </strong></label> :
                                                        {{ $appraisalRequest->summarizedEvaluation->receiver->first_name }}
                                                        {{ $appraisalRequest->summarizedEvaluation->receiver->last_name }}
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

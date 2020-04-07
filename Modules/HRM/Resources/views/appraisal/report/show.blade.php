@extends('hrm::layouts.master')
@section('title', trans('hrm::appraisal.report'))

@section('content')
    <!-- Striped row layout section start -->
    <section id="striped-row-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">@lang('hrm::appraisal.report')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
{{--                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>--}}
{{--                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <h4 class="form-section"><i class="ft-tag"></i> @lang('hrm::appraisal.personal_info')</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.job_name')</th>
                                            <td>{{ $appraisalReport->job_name }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.date_range')</th>
                                            <td>{{ date('d M, Y', strtotime($appraisalReport->reporting_date_start)) }} - {{ date('d M, Y', strtotime($appraisalReport->reporting_date_end)) }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::employee.menu_name')</th>
                                            <td>{{ $appraisalReport->requester->first_name }} {{ $appraisalReport->requester->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.educational_qualifications')</th>
                                            <td>{{ $appraisalReport->educational_qualifications }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.birth_date')</th>
                                            <td>{{ $appraisalReport->birth_date }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.job_period')</th>
                                            <td>{{ $appraisalReport->total_job_period }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.special_training')</th>
                                            <td>{{ $appraisalReport->special_training }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.known_languages')</th>
                                            <td>{{ $appraisalReport->languages }}</td>

                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.actual_job_period_under_officer')</th>
                                            <td>{{ $appraisalReport->reporting_job_period }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.report_giving_officer')</th>
                                            <td>{{ $appraisalReport->receiver->first_name }} {{ $appraisalReport->receiver->last_name }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-md-5">
                                    <h4 class="form-section"><i class="ft-tag"></i> আলোচ্য সময় যে পদে বহাল ছিলেন</h4>
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <th>পদ</th>
                                            <td>{{ $appraisalReport->job_history_designation }}</td>
                                        </tr>
                                        <tr>
                                            <th>সময়</th>
                                            <td>{{ $appraisalReport->job_history_duration }}</td>
                                        </tr>
                                        <tr>
                                            <th>বেতন ও বেতন স্কেল</th>
                                            <td>{{ $appraisalReport->job_history_salary_scale }}</td>
                                        </tr>
                                        <tr>
                                            <th>মন্তব্য</th>
                                            <td>{{ $appraisalReport->job_history_comment }}</td>
                                        </tr>
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

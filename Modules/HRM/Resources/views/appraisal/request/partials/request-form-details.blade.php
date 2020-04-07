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
        @if($appraisalRequest->comment)
            <tr>
                <th width="50%">@lang('hrm::appraisal.cause_of_special_request')</th>
                <td>{{ $appraisalRequest->comment }}</td>
            </tr>
        @endif
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

<div class="col-md-10">
    <h4 class="form-section"><i
            class="ft-tag"></i> @lang('hrm::appraisal.personal_info')</h4>
    <table class="table table-bordered">
        <tr>
            <th width="50%">@lang('hrm::employee.menu_name')</th>
            <td>{{ $ngAppraisalRequest->requester->first_name }} {{ $ngAppraisalRequest->requester->last_name }}</td>
        </tr>

        <tr>
            <th width="50%">@lang('hrm::designation.designation')</th>
            <td>{{ $ngAppraisalRequest->requester->designation->name }}</td>
        </tr>

        <tr>
            <th width="50%">@lang('hrm::appraisal.birth_date')</th>
            <td>{{ $ngAppraisalRequest->birth_date }}</td>
        </tr>

        <tr>
            <th width="50%">@lang('hrm::appraisal.salary_scale')</th>
            <td>{{ $ngAppraisalRequest->salary_scale }}</td>
        </tr>

        <tr>
            <th width="50%">@lang('hrm::appraisal.date_range')</th>
            <td>{{ date('d M, Y', strtotime($ngAppraisalRequest->reporting_date_start)) }}
                - {{ date('d M, Y', strtotime($ngAppraisalRequest->reporting_date_end)) }}</td>
        </tr>

        <tr>
            <th width="50%">@lang('hrm::appraisal.joining_date_govt_job')</th>
            <td>{{ $ngAppraisalRequest->joining_date_govt_job }}</td>
        </tr>

        <tr>
            <th width="50%">@lang('hrm::appraisal.is_divisional_exam_passed')
                , @lang('hrm::appraisal.divisional_exam_passed_date')</th>
            <td>{{ config('constants.boolean.'.$ngAppraisalRequest->is_divisional_exam_passed) }}
                {{ $ngAppraisalRequest->is_divisional_exam_passed ? ', '.$ngAppraisalRequest->divisional_exam_passed_date : "" }}</td>
        </tr>

        <tr>
            <th width="50%">@lang('hrm::appraisal.job_state')</th>
            <td>{{ config('constants.job_state.'.$ngAppraisalRequest->job_state) }}</td>
        </tr>

        <tr>
            <th width="50%">@lang('hrm::appraisal.current_post_joining_date')</th>
            <td>{{ $ngAppraisalRequest->current_post_joining_date }}</td>
        </tr>

        <tr>
            <th width="50%">@lang('hrm::appraisal.educational_qualifications')</th>
            <td>{{ $ngAppraisalRequest->educational_qualifications }}</td>
        </tr>


        <tr>
            <th width="50%">@lang('hrm::appraisal.known_languages')</th>
            <td>{{ $ngAppraisalRequest->languages }}</td>
        </tr>

        <tr>
            <th width="50%">@lang('hrm::appraisal.special_training')</th>
            <td>{{ $ngAppraisalRequest->special_training }}</td>
        </tr>

        <tr>
            <th width="50%">@lang('hrm::appraisal.actual_job_period_under_officer')</th>
            <td>{{ date(' d-m-Y ', time($ngAppraisalRequest->reporting_date_start )) }} @lang('hrm::appraisal.to') {{ date(' d-m-Y ', time($ngAppraisalRequest->reporting_date_end )) }} </td>
        </tr>
        @if($ngAppraisalRequest->comment)
            <tr>
                <th width="50%">@lang('hrm::appraisal.cause_of_special_request')</th>
                <td>{{ $ngAppraisalRequest->comment }}</td>
            </tr>
        @endif
        <tr>
            <th width="50%">@lang('hrm::appraisal.report_giving_officer')</th>
            <td>{{ $ngAppraisalRequest->receiver->first_name }} {{ $ngAppraisalRequest->receiver->last_name }}</td>
        </tr>
    </table>
</div>

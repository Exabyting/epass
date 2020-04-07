<div class="col-md-10">
    {{--<h4 class="card-title" id="striped-row-layout-basic">
        (@lang('labels.gazetted-cadre-officer'))</h4>--}}
    <h4 class="card-title" id="striped-row-layout-basic">১ম অংশ (আবেদনকারীর তত্থ্য)</h4>
    <h4 class="form-section"><i
            class="ft-tag"></i> @lang('hrm::appraisal.report of health examination')</h4>
    <table class="table table-bordered">
        <tr>
            <th width="50%">@lang('hrm::employee.menu_name')</th>
            <td>{{ $gcoAppraisalRequest->requester->first_name }} {{ $gcoAppraisalRequest->requester->last_name }}</td>
        </tr>

        <tr>
            <th width="50%">@lang('hrm::designation.designation')</th>
            <td>{{ $gcoAppraisalRequest->requester->designation->name }}</td>
        </tr>
        <tr>
            <th>@lang('hrm::cadre_officer_info.image_medical')</th>
            <td><img src="{{ url('file/get?filePath=' . $gcoAppraisalRequest->medical_report_photo) }}" width="300px" height="200px"></td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::appraisal.actual_job_period_under_officer')</th>
{{--            <td>{{en2bn( date(' d-m-Y ', time($gcoAppraisalRequest->reporting_date_start ))) }} @lang('hrm::appraisal.to')
                {{en2bn( date(' d-m-Y ', time($gcoAppraisalRequest->reporting_date_end ))) }} </td>--}}
            <td>{{en2bn($gcoAppraisalRequest->reporting_date_start) }} @lang('hrm::appraisal.to')
                {{en2bn($gcoAppraisalRequest->reporting_date_end ) }} </td>
        </tr>
        @if($gcoAppraisalRequest->comment)
            <tr>
                <th width="50%">@lang('hrm::appraisal.cause_of_special_request')</th>
                <td>{{ $gcoAppraisalRequest->comment }}</td>
            </tr>
        @endif
        <tr>
            <th width="50%">@lang('hrm::appraisal.report_giving_officer')</th>
            <td>{{ $gcoAppraisalRequest->receiver->first_name }} {{ $gcoAppraisalRequest->receiver->last_name }}</td>
        </tr>
    </table>
</div>

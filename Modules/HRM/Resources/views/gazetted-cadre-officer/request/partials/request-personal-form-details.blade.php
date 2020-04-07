
    <div class="col-md-10">
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
                                <td><img src="{{ url('file/get?filePath=' . $gcoAppraisalRequest->GCOAppraisalPersonalInfoRequest->medical_report_photo) }}" width="300px" height="200px"></td>
                            </tr>
                        </table>
    </div>

<div class="col-md-10">
    <h4 class="form-section"><i
            class="ft-tag"></i> @lang('hrm::appraisal.personal_info')</h4>
{{--    <table class="table table-bordered">
        <tr>
            <th width="50%">@lang('hrm::employee.menu_name')</th>
            <td>{{ $gcoAppraisalRequest->requester->first_name }} {{ $gcoAppraisalRequest->requester->name }}</td>
        </tr>

        <tr>
            <th width="50%">@lang('hrm::designation.designation')</th>
            <td>{{ $gcoAppraisalRequest->requester->designation->name }}</td>
        </tr>
    </table>--}}
    <table class="table table-bordered">
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.name')</th>
            <td>{{ $gcoAppraisalRequest->name }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.designation')</th>
            <td>{{ $gcoAppraisalRequest->designation }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.birth_date')</th>
            <td>{{ $gcoAppraisalRequest->birth_date }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.father_name')</th>
            <td>{{ $gcoAppraisalRequest->father_name }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.marital_status')</th>
            <td>{{ $gcoAppraisalRequest->marital_status }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.number_of_children')</th>
            <td>{{ $gcoAppraisalRequest->number_of_children }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.service_cadre_name')</th>
            <td>{{ $gcoAppraisalRequest->service_cadre_name }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.office_name')</th>
            <td>{{ $gcoAppraisalRequest->office_name }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.govt_service_start_date')</th>
            <td>{{ $gcoAppraisalRequest->govt_service_start_date }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.gazetted_service_start_date')</th>
            <td>{{ $gcoAppraisalRequest->gazetted_service_start_date }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.cadre_service_start_date')</th>
            <td>{{ $gcoAppraisalRequest->cadre_service_start_date }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.current_post_joining_date')</th>
            <td>{{ $gcoAppraisalRequest->current_post_joining_date }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.salary_scale')</th>
            <td>{{ $gcoAppraisalRequest->salary_scale }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.current_salary_scale')</th>
            <td>{{ $gcoAppraisalRequest->current_salary_scale }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.educational_qualifications')</th>
            <td>{{ $gcoAppraisalRequest->educational_qualifications }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.training_country')</th>
            <td>{{ $gcoAppraisalRequest->training_country }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.training_forign')</th>
            <td>{{ $gcoAppraisalRequest->training_forign }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.forign_skill_reading')</th>
            <td>{{ $gcoAppraisalRequest->forign_skill_reading }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.forign_skill_speaking')</th>
            <td>{{ $gcoAppraisalRequest->forign_skill_speaking }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.forign_skill_writing')</th>
            <td>{{ $gcoAppraisalRequest->forign_skill_writing }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.comment_one')</th>
            <td>{{ $gcoAppraisalRequest->comment_one }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.comment_two')</th>
            <td>{{ $gcoAppraisalRequest->comment_two }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.comment_three')</th>
            <td>{{ $gcoAppraisalRequest->comment_three }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.comment_four')</th>
            <td>{{ $gcoAppraisalRequest->comment_four }}</td>
        </tr>
        <tr>
            <th width="50%">@lang('hrm::cadre_officer_info.comment_five')</th>
            <td>{{ $gcoAppraisalRequest->comment_five }}</td>
        </tr>

        <tr>
            <th width="50%">@lang('hrm::appraisal.actual_job_period_under_officer')</th>
            <td>{{ en2bn($gcoAppraisalRequest->reporting_date_start ) }} @lang('hrm::appraisal.to') {{en2bn($gcoAppraisalRequest->reporting_date_end ) }} </td>
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

{{--<div class="form-body">--}}
{{--    <h4 class="form-section"><i class="ft-user"></i> @lang('hrm::appraisal.request_info')</h4>--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="form-group {{ $errors->has('name') ? ' error' : '' }}">--}}
{{--                {!! Form::label('job_name', trans('hrm::appraisal.job_name'), ['class' => 'form-label required']) !!}--}}
{{--                {!! Form::text('job_name', $ngAppraisalRequest->job_name,--}}
{{--                    [--}}
{{--                        'class' => "form-control",--}}
{{--                        "required ",--}}
{{--                        "placeholder" => trans('hrm::appraisal.job_name'),--}}
{{--                        'data-rule-maxlength' => 100,--}}
{{--                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),--}}
{{--                        'data-msg-required' => trans('labels.This field is required')--}}
{{--                    ])--}}
{{--                !!}--}}
{{--                <div class="help-block"></div>--}}
{{--                @if ($errors->has('job_name'))--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $errors->first('job_name') }}</strong>--}}
{{--                    </span>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            <div class="form-group {{ $errors->has('name') ? ' error' : '' }}">--}}

{{--            </div>--}}
{{--            {!! Form::label('reporting_date_range', trans('hrm::appraisal.date_range'), ['class' => 'form-label required']) !!}--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group {{ $errors->has('reporting_date_start') ? ' error' : '' }}">--}}
{{--                        <div class="position-relative">--}}
{{--                            {!! Form::text('reporting_date_start', date('Y-m-d', strtotime($ngAppraisalRequest->reporting_date_start)),--}}
{{--                                [--}}
{{--                                    'id' => 'reportingDateStart',--}}
{{--                                    'class' => "form-control",--}}
{{--                                    "required",--}}
{{--                                    'readonly',--}}
{{--                                    "placeholder" => trans('hrm::appraisal.date_range'),--}}
{{--                                    'data-msg-required' => trans('labels.This field is required')--}}
{{--                                ])--}}
{{--                            !!}--}}
{{--                            <div class="help-block"></div>--}}
{{--                            @if ($errors->has('reporting_date_start'))--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                    <strong>{{ $errors->first('reporting_date_start') }}</strong>--}}
{{--                                </span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group {{ $errors->has('reporting_date_end') ? ' error' : '' }}">--}}
{{--                        <div class="position-relative">--}}
{{--                            {!! Form::text('reporting_date_end', date('Y-m-d', strtotime($ngAppraisalRequest->reporting_date_end)),--}}
{{--                                [--}}
{{--                                    'id' => 'reportingDateEnd',--}}
{{--                                    'class' => "form-control",--}}
{{--                                    "required",--}}
{{--                                    'readonly',--}}
{{--                                    "placeholder" => trans('hrm::appraisal.date_range'),--}}
{{--                                    'data-msg-required' => trans('labels.This field is required')--}}
{{--                                ])--}}
{{--                            !!}--}}
{{--                            <div class="help-block"></div>--}}
{{--                            @if ($errors->has('reporting_date_end'))--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                    <strong>{{ $errors->first('reporting_date_end') }}</strong>--}}
{{--                                </span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="form-body">
    <h4 class="form-section"><i class="ft-user"></i> @lang('hrm::appraisal.personal_info')</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('birth_date') ? ' error' : '' }}">
                {!! Form::label('birth_date', trans('hrm::appraisal.birth_date'), ['class' => 'form-label required']) !!}
                {!! Form::text('birth_date', $ngAppraisalRequest->birth_date,
                    [
                        'id' => 'birthDate',
                        'class' => "form-control",
                        "required ",
                        "placeholder" => "DD-MM-YYYY",//trans('hrm::appraisal.birth_date'),
                        'data-msg-required' => trans('labels.This field is required'),
                        'data-msg-birthDate' => trans("labels.Please specify the correct date")
                    ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('birth_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('birth_date') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('joining_date_govt_job') ? ' error' : '' }}">
                {!! Form::label('joining_date_govt_job', trans('hrm::appraisal.joining_date_govt_job'), ['class' => 'form-label required']) !!}
                {!! Form::text('joining_date_govt_job', $ngAppraisalRequest->joining_date_govt_job,
                    [
                        'class' => "form-control",
                        "required ",
                        "placeholder" => "DD-MM-YYYY",
                        'data-msg-required' => trans('labels.This field is required'),
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                        'data-msg-birthDate' => trans("labels.Please specify the correct date"),
                    ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('joining_date_govt_job'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('joining_date_govt_job') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('is_divisional_exam_passed') ? ' error' : '' }}">
                {!! Form::label('is_divisional_exam_passed', trans('hrm::appraisal.is_divisional_exam_passed'), ['class' => 'form-label required']) !!}

                {!! Form::select('is_divisional_exam_passed',
                  config('constants.boolean'), $ngAppraisalRequest->is_divisional_exam_passed,
                  [
                      'placeholder' => trans('labels.select'),
                      'required',
                      'class'=>'form-control select required' . ($errors->has('is_divisional_exam_passed') ? ' is-invalid' : ''),
                      'data-msg-required' => trans('labels.This field is required'),
                  ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('is_divisional_exam_passed'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('is_divisional_exam_passed') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('divisional_exam_passed_date') ? ' error' : '' }}">
                {!! Form::label('divisional_exam_passed_date', trans('hrm::appraisal.divisional_exam_passed_date'), ['class' => 'form-label']) !!}
                {!! Form::text('divisional_exam_passed_date', $ngAppraisalRequest->divisional_exam_passed_date,
                    [
                        'class' => "form-control",
                        "placeholder" => "DD-MM-YYYY",
                        'data-msg-birthDate' => trans("labels.Please specify the correct date"),
                    ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('divisional_exam_passed_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('divisional_exam_passed_date') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('job_state') ? ' error' : '' }}">
                {!! Form::label('job_state', trans('hrm::appraisal.job_state'), ['class' => 'form-label required']) !!}

                {!! Form::select('job_state',
                  config('constants.job_state'), $ngAppraisalRequest->job_state,
                  [
                      'placeholder' => trans('labels.select'),
                      'required',
                      'class'=>'form-control select required' . ($errors->has('job_state') ? ' is-invalid' : ''),
                      'data-msg-required' => trans('labels.This field is required'),
                  ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('job_state'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('job_state') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('current_post_joining_date') ? ' error' : '' }}">
                {!! Form::label('current_post_joining_date', trans('hrm::appraisal.current_post_joining_date'), ['class' => 'form-label required']) !!}
                {!! Form::text('current_post_joining_date', $ngAppraisalRequest->current_post_joining_date,
                    [
                        'class' => "form-control",
                        "required ",
                        "placeholder" => "DD-MM-YYYY",
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                        'data-msg-required' => trans('labels.This field is required'),
                        'data-msg-birthDate' => trans("labels.Please specify the correct date"),
                    ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('current_post_joining_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('current_post_joining_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('salary_scale') ? ' error' : '' }}">
                {!! Form::label('salary_scale', trans('hrm::appraisal.salary_scale'), ['class' => 'form-label required']) !!}
                {{ Form::text('salary_scale', $ngAppraisalRequest->salary_scale,
                                [
                                    'placeholder' => trans('hrm::appraisal.salary_scale'),
                                    'class' => 'form-control required',
                                    'data-msg-required' => trans('labels.This field is required'),
                                ]
                            )
                        }}
                <div class="help-block"></div>
                @if ($errors->has('salary_scale'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('salary_scale') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('') ? ' error' : '' }}">
                {!! Form::label('educational_qualifications', trans('hrm::appraisal.educational_qualifications'), ['class' => 'form-label required']) !!}
                {!! Form::text('educational_qualifications', $ngAppraisalRequest->educational_qualifications,
                    [
                        'class' => "form-control",
                        "required ",
                        "placeholder" => trans('hrm::appraisal.educational_qualifications'),
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                        'data-msg-required' => trans('labels.This field is required')
                    ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('educational_qualifications'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('educational_qualifications') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('languages') ? ' error' : '' }}">
                {!! Form::label('languages', trans('hrm::appraisal.known_languages_ng'), ['class' => 'form-label ']) !!}
                {!! Form::text('languages', $ngAppraisalRequest->languages,
                    [
                        'class' => "form-control",
                        "placeholder" => trans('hrm::appraisal.known_languages'),
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                        'data-msg-required' => trans('labels.This field is required'),
                    ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('languages'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('languages') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('special_training') ? ' error' : '' }}">
                {!! Form::label('special_training', trans('hrm::appraisal.special_training'), ['class' => 'form-label']) !!}
                {!! Form::text('special_training', $ngAppraisalRequest->special_training,
                    [
                        'class' => "form-control",
                        "placeholder" => trans('hrm::appraisal.special_training')
                    ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('special_training'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('special_training') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('reporting_job_period') ? ' error' : '' }}">
                {!! Form::label('reporting_job_period', trans('hrm::appraisal.actual_job_period_under_officer'), ['class' => 'form-label required']) !!}
                {!! Form::text('reporting_job_period', $ngAppraisalRequest->reporting_job_period,
                    [
                        'class' => "form-control",
                        "required",
                        "placeholder" =>  trans('hrm::appraisal.job_period'),
                        'data-msg-required' => trans('labels.This field is required'),
                    ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('reporting_job_period'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('reporting_job_period') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

</div>

<h4 class="form-section"><i class="ft-tag"></i> {{trans('hrm::appraisal.report_giving_officer')}} </h4>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('employee_officer_id') ? ' error' : '' }}">
            {!! Form::label('employee_officer_id',  trans('hrm::appraisal.report_giving_officer'), ['class' => 'form-label required']) !!}

            {!! Form::select('employee_officer_id',
                $reportingOfficers, $ngAppraisalRequest->employee_officer_id,
                [
                    'class'=>'form-control select required' . ($errors->has('employee_officer_id') ? ' is-invalid' : ''),
                    'data-msg-required' => trans('labels.This field is required'),
                ])
            !!}
            <div class="help-block"></div>
            @if ($errors->has('employee_officer_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('employee_officer_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i> @lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{ route('ng-appraisal-request.index') }}">
        <i class="ft-x"></i> Go Back
    </a>
</div>

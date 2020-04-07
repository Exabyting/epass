<div class="form-body">
    <h4 class="card-title" id="striped-row-layout-basic"><i class="ft-tag"></i> @lang('hrm::cadre_officer_info.eight_part')</h4>
    <h4 class="card-title" id="striped-row-layout-basic">(মন্ত্রনালয়/বিভাগ কর্তৃক পূরণের জন্য)</h4>
    <h4 class="form-section"><i class="ft-user"></i> @lang('hrm::appraisal.final_info')</h4>
    <div class="row justify-content">
        <div class="col-md-6">
            {{ Form::hidden('appraisal_request_id', $gcoAppraisalRequest->id ) }}
            <div class="form-group {{ $errors->has('filled_up_date') ? ' error' : '' }}">
                {!! Form::label('filled_up_date', trans("hrm::appraisal.filled_up_date"), ['class' => 'form-label']) !!}
                {!! Form::text('filled_up_date', date('d-m-Y', time($gcoAppraisalRequest->updated_at)),
                    [
                        'class' => "form-control",
                        "readonly",
                        "placeholder" => trans('hrm::appraisal.filled_up_date'),
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                        'data-msg-required' => trans('labels.This field is required')
                    ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('filled_up_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('filled_up_date') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('cause_of_late') ? ' error' : '' }}">
                {!! Form::label('cause_of_late', trans("hrm::appraisal.cause_of_late"), ['class' => 'form-label']) !!}
                {!! Form::text('cause_of_late', optional($gcoAppraisalRequest->approval)->cause_of_late,
                    [
                        'class' => "form-control",
                        "placeholder" => trans("hrm::appraisal.cause_of_late"),
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                        'data-msg-required' => trans('labels.This field is required')
                    ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('cause_of_late'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('cause_of_late') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('work_on_application') ? ' error' : '' }}">
                {!! Form::label('work_on_application', trans("hrm::appraisal.work_on_application"), ['class' => 'form-label']) !!}
                {!! Form::text('work_on_application', optional($gcoAppraisalRequest->approval)->work_on_application,
                    [
                        'class' => "form-control",
                        "placeholder" => trans('hrm::appraisal.work_on_application'),
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                        'data-msg-required' => trans('labels.This field is required')
                    ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('work_on_application'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('work_on_application') }}</strong>
                    </span>
                @endif
            </div>

        </div>
    </div>
</div>

<div class="form-body">
    <h4 class="form-section"><i class="ft-user"></i> @lang('labels.responsible_officer_sign_seal')</h4>
    <div class="row justify-content">
        <div class="col-md-6">
            <table>
                <tr>
                    <th>@lang('labels.name')</th>
                    <th>:</th>
                    <td>{{auth()->user()->name}}</td>
                </tr>
                <tr>
                    <th>@lang('labels.designation')</th>
                    <th>:</th>
                    <td>{{auth()->user()->employee->designation->name}}</td>
                </tr>
                <tr>
                    <th>@lang('labels.id_no')</th>
                    <th>:</th>
                    <td>{{en2bn(auth()->user()->employee->id)}}</td>
                </tr>
                <tr>
                    <th>@lang('labels.date'):</th>
                    <th>:</th>
                    <td>{{en2bn(date('d-m-Y', time()))}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="form-actions text-center">
    <button type="submit" name="action" value="save" class="btn btn-primary">
        <i class="la la-check-square-o"></i> @lang('labels.save')
    </button>
    <button type="submit" name="action" value="Approve" class="btn btn-success">
        <i class="la la-check-square-o"></i> @lang('labels.approve')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{ route('gco-appraisal-request.action-list') }}">
        <i class="la la-chevron-left"></i> @lang('labels.go_back')
    </a>
</div>

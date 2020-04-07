<div class="form-body">
    <h4 class="form-section"><i class="ft-user"></i> @lang('hrm::appraisal.report of health examination')</h4>
    <b><label class="required"> @lang('hrm::cadre_officer_info.report_photo')</label> </b>&nbsp;&nbsp;
    <a href= "{{ route('download') }}" class="btn btn-warning mr-1" ><i class="icon-download"> </i>ডাউনলোড </a>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <b><label class="required">@lang('hrm::appraisal.upload_medical_report_photo')</label></b>
                <div class="report-upload">

                        <input type='file' name="medical_report_photo" class ="form-control required" id="imageUpload"
                               accept=".png, .jpg, .jpeg"  >
                        <label for="imageUpload"></label>
                    <div class="help-block"></div>
                </div>
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
                $reportingOfficers, null,
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

    @can('special-user')
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('comment') ? ' error' : '' }}">
                {!! Form::label('comment',  trans('hrm::appraisal.cause_of_special_request'), ['class' => 'form-label required']) !!}

                {!! Form::textarea('comment', null,
                    [
                        'rows' => 4,
                        'class'=>'form-control required' . ($errors->has('comment') ? ' is-invalid' : ''),
                        'data-msg-required' => trans('labels.This field is required'),
                    ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('comment'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('comment') }}</strong>
                </span>
                @endif
            </div>
        </div>
    @endcan
</div>

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i> @lang('labels.next_step')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{ route('gco-appraisal-request.index') }}">
        <i class="la la-chevron-left"></i> @lang('labels.go_back')
    </a>
</div>

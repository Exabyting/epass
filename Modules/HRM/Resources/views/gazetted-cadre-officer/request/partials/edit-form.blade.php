<div class="form-body">
    <h4 class="form-section"><i class="ft-user"></i> @lang('hrm::appraisal.report of health examination')</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <b><label class="required">@lang('hrm::appraisal.upload_medical_report_photo')</label></b>
                @php
                    $isPhotoExist = false; $employeePhoto = '';

                    if(!empty($gcoAppraisalRequest) && isset($gcoAppraisalRequest)){
                        if($gcoAppraisalRequest->medical_report_photo) {
                            $isPhotoExist = true;
                            $medicalPhoto = $gcoAppraisalRequest->medical_report_photo;
                        }
                    }

                @endphp
                <div class="avatar-upload">
                    <div class="avatar-preview">
                        @if($isPhotoExist)
                            <div id="imagePreview">
                                <img src="{{ url('file/get?filePath=' . $gcoAppraisalRequest->medical_report_photo) }}"
                                     width="400px" height="400px">
                            </div>
                        @else
                            <div id="imagePreview"
                                 style="background-image: url({{ asset('/images/default-profile-picture.png') }});"></div>
                        @endif
                    </div>
                    <br>
                    <div class="avatar-edit">
                        <input type='file' name="medical_report_photo" id="imageUpload" accept=".png, .jpg, .jpeg"
                               class ="form-control required"
                               @if(!$isPhotoExist)
                               data-validation-required-message="{{ trans('labels.Picture field is required') }}
                               @endif"/>
                        <label for="imageUpload"></label>
                    </div>
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
                $reportingOfficers, $gcoAppraisalRequest->employee_officer_id,
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
    <a class="btn btn-warning mr-1" role="button" href="{{ route('gco-appraisal-request.index') }}">
        <i class="ft-x"></i> Go Back
    </a>
</div>


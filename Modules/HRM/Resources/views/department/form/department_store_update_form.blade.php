<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> @lang('hrm::department.department_form') </h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-group {{ $errors->has('name') ? ' error' : '' }}">
                    {{ Form::label('name', trans('labels.name'), ['class' => 'required']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Human Resource', 'required' => 'required', 'data-validation-required-message'=> trans('labels.This field is required')]) }}
                    <div class="help-block"></div>
                    @if ($errors->has('name'))
                        <div class="help-block">  {{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('department_code') ? ' error' : '' }}">
                    {{ Form::label('name', trans('hrm::department.department_code') . " (". trans('labels.optional'). ") ") }}
                    {{ Form::text('department_code', null, ['class' => 'form-control', 'placeholder' => 'HR']) }}
                    <div class="help-block"></div>
                    @if ($errors->has('department_code'))
                        <div class="help-block">  {{ $errors->first('department_code') }}</div>
                    @endif
                </div>
                {{ Form::hidden('id', null) }}
            </div>
            <div class="form-actions col-md-12 ">
                <div class="pull-right">
                    {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
                    <a href="{{ url('/hrm/department') }}">
                        <button type="button" class="btn btn-warning mr-1">
                            <i class="la la-times"></i> @lang('labels.cancel')
                        </button>
                    </a>

                </div>
            </div>
        </div>
    </div>

</div>
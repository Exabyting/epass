<div class="table-responsive">
    <table class="table table-bordered employee-officer-repeater">
        <thead>
        <tr style="text-align: center">
            <th width="1%">
                <button data-repeater-create class="btn btn-info" type="button">
                    <i class="la la-plus-circle"></i> যোগ করুন
                </button>
            </th>
            <th><label class="required">{{trans('hrm::appraisal.recipient')}}</label></th>
            <th><label class="required">{{trans('hrm::appraisal.approved_by')}}</label></th>
            <th><label class="required">{{trans('hrm::appraisal.start_date')}}</label></th>
            <th><label class="required">{{trans('hrm::appraisal.end_date')}}</label></th>

        </tr>
        </thead>
        <tbody data-repeater-list="employee-officer">
        <tr data-repeater-item>
            <td><i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i></td>
            <td>
                {!! Form::select('iro_id',$allEmployees, null,
                    [
                        'placeholder' => trans('labels.select'),
                        'class' => 'form-control select required',
                        'data-msg-required'=> trans('labels.This field is required')
                    ])
                 !!}
                <div class="help-block"></div>
                @if ($errors->has('iro_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('iro_id') }}</strong>
                    </span>
                @endif
            </td>
            <td>
                {!! Form::select('cro_id',$allEmployees, null,
                    [
                        'placeholder' => trans('labels.select'),
                        'class' => 'form-control select required',
                        'data-msg-required'=> trans('labels.This field is required')
                    ])
                 !!}
                <div class="help-block"></div>
                @if ($errors->has('cro_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('cro_id') }}</strong>
                    </span>
                @endif
            </td>
            <td>
                {!! Form::text('start_date', null,
                    [
                        'required',
                        'class' => "form-control required",
                        "placeholder" => "DD-MM-YYYY",//trans('hrm::appraisal.birth_date'),
                        'data-msg-required' => trans('labels.This field is required'),
                        'data-msg-date' => trans("labels.Please specify the correct date"),
                    ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('start_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('start_date') }}</strong>
                    </span>
                @endif
            </td>
            <td>
                {!! Form::text('end_date', null,
                    [
                        'required',
                        'class' => "form-control required",
                        "placeholder" => "DD-MM-YYYY",//trans('hrm::appraisal.birth_date'),
                        'data-msg-required' => trans('labels.This field is required'),
                        'data-msg-date' => trans("labels.Please specify the correct date"),
                    ])
                !!}
                <div class="help-block"></div>
                @if ($errors->has('end_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('end_date') }}</strong>
                    </span>
                @endif
            </td>

        </tr>
        </tbody>
    </table>
</div>

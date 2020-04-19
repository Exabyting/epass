<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? ' error' : '' }}">
            {{ Form::label('name', trans('labels.name'), ['class' => 'required'] ) }}
            {{ Form::text('name', isset($employee) ? $employee->first_name . ' ' . $employee->last_name : null, ['class' => 'form-control', 'placeholder' => 'Jon', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->has('name'))
                <div class="help-block">  {{ $errors->first('name') }}</div>
            @endif
        </div>

        {{--        <div class="form-group {{ $errors->has('first_name') ? ' error' : '' }}">--}}
        {{--            {{ Form::label('first_name', trans('labels.first_name'), ['class' => 'required'] ) }}--}}
        {{--            {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Jon', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}--}}
        {{--            <div class="help-block"></div>--}}
        {{--            @if ($errors->has('first_name'))--}}
        {{--                <div class="help-block">  {{ $errors->first('first_name') }}</div>--}}
        {{--            @endif--}}
        {{--        </div>--}}

        {{--        <div class="form-group {{ $errors->has('last_name') ? ' error' : '' }}">--}}
        {{--            {{ Form::label('last_name', trans('labels.last_name'), ['class' => 'required']) }}--}}
        {{--            {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Doe', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}--}}
        {{--            <div class="help-block"></div>--}}
        {{--            @if ($errors->has('last_name'))--}}
        {{--                <div class="help-block">  {{ $errors->first('last_name') }}</div>--}}
        {{--            @endif--}}
        {{--        </div>--}}
        <div class="form-group {{ $errors->has('employee_id') ? ' error' : '' }}">
            {{ Form::label('employee_id', trans('hrm::employee_general_info.employee_id'), ['class' => 'required']) }}
            {{ Form::text('employee_id', null, ['class' => 'form-control', 'placeholder' => '', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->has('employee_id'))
                <div class="help-block">  {{ $errors->first('employee_id') }}</div>
            @endif
        </div>
        <div class="form-group {{ $errors->has('department_id') ? ' error' : '' }}">
            {{ Form::label('department', trans('hrm::department.department'), ['class' => 'required']) }}
            {{ Form::select('department_id',$departments, null, ['id'=> 'department_id', 'placeholder' => trans('labels.select'),'class' => 'form-control select', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->has('department_id'))
                <div class="help-block">  {{ $errors->first('department_id') }}</div>
            @endif
        </div>
        <div class="form-group {{ $errors->has('designation_id') ? ' error' : '' }}">
            {{ Form::label('designation_id', trans('hrm::designation.designation'), ['class' => 'required']) }}
            {{ Form::select('designation_id', $designations,  null, ['placeholder' => trans('labels.select'), 'class' => 'form-control select', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->has('designation_id'))
                <div class="help-block">  {{ $errors->first('designation_id') }}</div>
            @endif
        </div>
        <div class="form-group {{ $errors->has('gender') ? ' error' : '' }}">
            {{ Form::label('gender', trans('labels.gender'), ['class' => 'required']) }}
            {{ Form::select('gender', config('constants.gender'),  null, ['placeholder' => trans('labels.select'), 'class' => 'form-control select', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->has('gender'))
                <div class="help-block">  {{ $errors->first('gender') }}</div>
            @endif
        </div>
        <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
            {{ Form::label('status', trans('labels.status'), ['class' => 'required']) }}
            {{ Form::select('status', config('constants.employee_available_status'),  null, ['placeholder' => trans('labels.select'), 'class' => 'form-control select', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->has('status'))
                <div class="help-block">  {{ $errors->first('status') }}</div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('email') ? ' error' : '' }}">
            {{ Form::label('email', trans('labels.email_address'), ['class' => 'required']) }}
            {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'info@example.com', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @foreach ($errors->get('email') as $message)
                <div class="help-block">  {{ $message }}</div>
            @endforeach
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <h1><label class="required">@lang('hrm::employee_general_info.upload_employee_photo')</label></h1>
            @php
                $isPhotoExist = false; $employeePhoto = '';

                if(!empty($employee) && isset($employee)){
                    if($employee->photo) {
                        $isPhotoExist = true;
                        $employeePhoto = $employee->photo;
                    }
                }

            @endphp
            <div class="avatar-upload">
                <div class="avatar-edit">
                    <input type='file' name="photo" id="imageUpload" accept=".png, .jpg, .jpeg"
                           @if(!$isPhotoExist)
                           data-validation-required-message="{{ trans('labels.Picture field is required') }}
                           @endif"/>
                    <label for="imageUpload"></label>
                </div>
                <div class="avatar-preview">
                    @if($isPhotoExist)
                        <div id="imagePreview"
                             style="background-image: url({{ url('file/get?filePath=' . $employee->photo) }});"></div>
                    @else
                        <div id="imagePreview"
                             style="background-image: url({{ asset('/images/default-profile-picture.png') }});"></div>
                    @endif
                </div>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group {{ $errors->has('mobile') ? ' error' : '' }}">
            {{ Form::label('mobile', trans('labels.mobile'), ['class' => 'required']) }}
            {{ Form::text('mobile', null, ['class' => 'form-control','placeholder' => '017XXXXXXXX','required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required'),  'minlength' =>'11', 'data-validation-minlength-message'=>trans('labels.At least 11 characters'), 'maxlength' =>'13', 'data-validation-maxlength-message'=>'Enter maximum 13 digit',]) }}
            <div class="help-block"></div>
            @foreach ($errors->get('mobile') as $message)
                <div class="help-block">  {{ $message }}</div>
            @endforeach
        </div>
    </div>
    <hr>
    {{ Form::hidden('id', null) }}
    <div class="form-actions col-md-12 ">
        <div class="pull-right">
            {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
            <a href="{{ url('/hrm/employee') }}">
                <button type="button" class="btn btn-warning mr-1">
                    <i class="la la-times"></i> @lang('labels.cancel')
                </button>
            </a>

        </div>
    </div>
</div>
@push('page-js')
    <script>
        $(document).ready(function () {

            $('.select').select2();

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imageUpload").change(function () {
                readURL(this);
            });

            // $('.employee-officer-repeater').repeater({
            //     isFirstItemUndeletable: true,
            //     // initEmpty: true,
            //     show: function () {
            //         $(this).slideDown();
            //         $('.select2-container').remove();
            //         $('.select').select2();
            //     },
            //     hide: function (deleteElement) {
            //         if (confirm('Are you sure you want to delete this element?')) {
            //             $(this).slideUp(deleteElement);
            //         }
            //     }
            // });
        });

        $("#department_id").change(function () {
            var url = "{{ url('hrm/get-sections-by-dept-id/') }}";
            $.get(url + '/' + $('#department_id').val(), function (data) {
                $('#section_id').find('option').remove();
                $('#section_id').append(new Option("{{ trans('labels.select') }}", ''));
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        $('#section_id').append(new Option(data[i]['name'], data[i]['id']));
                    }
                }
            });
        });

    </script>

@endpush

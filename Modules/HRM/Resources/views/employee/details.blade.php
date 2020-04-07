<table class="table ">
    <tbody>
    <tr>
        <th>@lang('labels.image')</th>
        <td><img src="{{ url('file/get?filePath=' . $employee->photo) }}" width="200px" height="200px"></td>
    </tr>
    <tr>
        <th class="">@lang('labels.first_name')</th>
        <td>{{$employee->first_name}}</td>
    </tr>
    <tr>

        <th class="">@lang('labels.last_name')</th>
        <td>{{$employee->last_name}}</td>
    </tr>
    <tr>
        <th class="">@lang('labels.email_address')</th>
        <td>{{$employee->email}}</td>
    </tr>
    <tr>
        <th class="">@lang('labels.gender')</th>
        <td>{{$employee->gender}}</td>
    </tr>
    <tr>
        <th class="">@lang('hrm::department.department')</th>
        <td>{{$employee->department ? $employee->department->name : ''}}</td>
    </tr>
    <tr>
        <th class="">@lang('hrm::department.section_title')</th>
        <td>{{$employee->section ? $employee->section->name : ''}}</td>
    </tr>
    <tr>
        <th class="">@lang('labels.status')</th>
        <td>{{$employee->status}}</td>
    </tr>
    <tr>
        <th class="">@lang('labels.tel_office')</th>
        <td>{{$employee->tel_office}}</td>
    </tr>
    {{--    <tr>--}}
    {{--        <th class="">@lang('labels.tel_office')</th>--}}
    {{--        <td>{{$employee->tel_home}}</td>--}}
    {{--    </tr>--}}
    <tr>
        <th class="">@lang('labels.mobile')</th>
        <td>{{$employee->mobile_one}}</td>
    </tr>
    {{--    <tr>--}}
    {{--        <th class="">@lang('labels.mobile') (2)</th>--}}
    {{--        <td>{{$employee->mobile_two}}</td>--}}
    {{--    </tr>--}}
    <tr>
        <th>Signature</th>
        <td><img src="{{ url('file/get?filePath=' . $employee->signature) }}" width="100px" height="50px"></td>
    </tr>
    </tbody>
</table>
<div class="table-responsive">
    <table class="table table-bordered zero-configuration">
        <thead>
        <tr style="text-align: center">
            <th width="50%">{{trans('hrm::appraisal.recipient')}}</th>
            <th width="50%">{{trans('hrm::appraisal.approved_by')}}</th>
            <th width="24%">{{trans('hrm::appraisal.start_date')}}</th>
            <th width="24%">{{trans('hrm::appraisal.end_date')}}</th>
        </tr>
        </thead>
        <tbody data-repeater-list="employee-officer">
        @foreach($employee->officers as $officer)
            <tr>
                <td width="50%">
                    {{$officer->iroOfficer->first_name}} {{$officer->iroOfficer->last_name}}
                </td>
                <td width="50%">
                    {{$officer->croOfficer->first_name}} {{$officer->croOfficer->last_name}}
                </td>
                <td width="24%">
                    {{$officer->start_date}}
                </td>
                <td width="24%">
                    {{$officer->end_date}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{--<a href="{{url('/hrm/employee/')}}"--}}
<a class="btn btn-small btn-info" href="{{ url('/hrm/employee/' . $employee->id . '/edit') }}">@lang('labels.edit') </a>

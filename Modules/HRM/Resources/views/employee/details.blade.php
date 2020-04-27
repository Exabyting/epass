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
        <th class="">@lang('labels.status')</th>
        <td>{{$employee->status}}</td>
    </tr>
    <tr>
        <th class="">@lang('labels.mobile')</th>
        <td>{{$employee->mobile}}</td>
    </tr>
    </tbody>
</table>
{{--<a href="{{url('/hrm/employee/')}}"--}}
<a class="btn btn-small btn-info" href="{{ url('/hrm/employee/' . $employee->id . '/edit') }}">@lang('labels.edit') </a>
<a href="{{ url('/hrm/employee') }}">
    <button type="button" class="btn btn-warning mr-1">
        <i class="la la-times"></i> @lang('labels.cancel')
    </button>
</a>

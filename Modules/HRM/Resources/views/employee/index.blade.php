@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.list_title'))
{{--@section("employee_create", 'active')--}}


@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::employee.list_title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{url('/hrm/employee/create')}}" class="btn btn-primary btn-lg">
                                <i class="ft-plus white"></i> @lang('labels.add')
                            </a>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="employee-list table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('labels.id')</th>
                                        <th scope="col">@lang('labels.name')</th>
                                        <th scope="col">@lang('hrm::designation.designation')</th>
{{--                                        <th scope="col">@lang('labels.gender')</th>--}}
                                        <th scope="col">@lang('hrm::department.department')</th>
{{--                                        <th scope="col">@lang('labels.status')</th>--}}
                                        <th scope="col">@lang('labels.tel')</th>
                                        <th scope="col">@lang('labels.mobile')</th>
                                        <th scope="col">@lang('labels.action')</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($employeeList)>0)
                                        @foreach($employeeList as $employee)

                                            <tr>
                                                <th width="2%">{{$loop->iteration}}</th>
                                                <th width="10%">
                                                    <a href="{{ url('/hrm/employee',$employee->id) }}">
                                                        {{ $employee->employee_id }}
                                                    </a>
                                                </th>
                                                <td>{{$employee->first_name . " " . $employee->last_name}}</td>
                                                <td>{{ ($employee->designation) ? $employee->designation->name : '' }}</td>
{{--                                                <td>{{$employee->gender}}</td>--}}
                                                <td>{{ isset($employee->department->name) ? $employee->department->name : ''}}</td>
{{--                                                <td>{{$employee->status}}</td>--}}
                                                <td>{{$employee->tel_office}}</td>
                                                <td>{{$employee->mobile_one}}</td>

                                                <td>
                                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i></button>
                                                    <span aria-labelledby="btnSearchDrop2"
                                                          class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ url('/hrm/employee',$employee->id) }}"
                                                           class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                                            <div class="dropdown-divider"></div>
                                                        <a href="{{ url('/hrm/employee/' . $employee->id . '/edit')  }}"
                                                           class="dropdown-item"><i class="la la-edit-2"></i> @lang('labels.edit')</a>

                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/tables/datatable/dataTables.buttons.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/tables/jszip.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/tables/pdfmake.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/tables/vfs_fonts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/tables/buttons.print.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/tables/buttons.colVis.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            let table = $('.employee-list').DataTable({
                dom:"lBfrtip",
                "columnDefs": [
                    {"orderable": false, "targets": 1}
                ],
                // buttons:["copyHtml5","excelHtml5","csvHtml5","print"],
                buttons:[
                    {
                        extend: "print",
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    }
                ],
                "language": {
                    "search": "{{ trans('labels.search') }}",
                    "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
                    "lengthMenu": "{{ trans('labels.show') }} _MENU_ {{ trans('labels.records') }}",
                    "info": "{{trans('labels.showing')}} _START_ {{trans('labels.to')}} _END_ {{trans('labels.of')}} _TOTAL_ {{ trans('labels.records') }}",
                    "infoFiltered": "( {{ trans('labels.total')}} _MAX_ {{ trans('labels.infoFiltered') }} )",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "{{ trans('labels.next') }}",
                        "previous": "{{ trans('labels.previous') }}"
                    },
                }
            });
        });
    </script>
@endpush

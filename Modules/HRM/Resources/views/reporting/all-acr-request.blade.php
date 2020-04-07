@extends('hrm::layouts.master')

@section('title', 'Individual Report')

@section('content')
    <section id="product-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::appraisal.individual_report')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="inventory-report-table table table-bordered">
                                    <thead>
                                    <tr>
                                        {{--                                        <th>@lang('labels.serial')</th>--}}
                                        <th>@lang('labels.requester')</th>
                                        <th>@lang('hrm::designation.designation')</th>
                                        <th>@lang('hrm::department.department')</th>
                                        <th>@lang('hrm::appraisal.report_date')</th>
                                        <th>@lang('hrm::appraisal.duration')</th>
                                        <th>@lang('hrm::appraisal.remarks')</th>
                                        {{--                                        <th>@lang('labels.action')</th>--}}
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reports as $report)
                                        <tr>
                                            {{--                                                <td>{{ $loop->iteration }}</td>--}}
                                            <td>{{ $report->requester->first_name }} {{ $report->requester->last_name }}</td>
                                            <td>{{ ($report->requester->designation) ? $report->requester->designation->name : '' }}</td>
                                            <td>{{ $report->requester->department->name }}</td>
                                            <td>{{ $report->created_at->format('d-m-Y') }}</td>
                                            <td>{{ date('d M, Y', strtotime($report->reporting_date_start)) }}
                                                - {{ date('d M, Y', strtotime($report->reporting_date_end)) }}</td>
                                            <td></td>
                                            <td>
                                                @can('system-super-admin')
                                                    @if(isset($report->is_action_taken))
                                                        <a target="_blank"
                                                           href="{{ route('acr.print.preview', $report->id) }}"><i
                                                                class="la la-eye"></i></a>
                                                    @else
                                                        <a target="_blank"
                                                           href="{{ route('report.print.preview', $report->id) }}"><i
                                                                class="la la-eye"></i></a>
                                                    @endif
                                                @endcan
                                            </td>
                                            <td>
                                                @can('system-super-admin')
                                                    @if(isset($report->is_action_taken))
                                                        <a target="_blank" href="{{ route('acr.print', $report->id) }}"><i
                                                                class="la la-print"></i></a>
                                                    @else
                                                        <a target="_blank"
                                                           href="{{ route('report.print', $report->id) }}"><i
                                                                class="la la-print"></i></a>
                                                    @endif
                                                @endcan
                                            </td>

                                        </tr>
                                    @endforeach
                                    @foreach($ngReports as $report)
                                        <tr>
                                            {{--                                                <td>{{ $loop->iteration }}</td>--}}
                                            <td>{{ $report->requester->first_name }} {{ $report->requester->last_name }}</td>
                                            <td>{{ ($report->requester->designation) ? $report->requester->designation->name : '' }}</td>
                                            <td>{{ $report->requester->department->name }}</td>
                                            <td>{{ $report->created_at->format('d-m-Y') }}</td>
                                            <td>{{ date('d M, Y', strtotime($report->reporting_date_start)) }}
                                                - {{ date('d M, Y', strtotime($report->reporting_date_end)) }}</td>
                                            <td></td>
                                            <td>
                                                @can('system-super-admin')
                                                    @if(isset($report->is_action_taken))
                                                        <a target="_blank"
                                                           href="{{ route('ng-acr.print.preview', $report->id) }}"><i
                                                                class="la la-eye"></i></a>
                                                    @else
                                                        <a target="_blank"
                                                           href="{{ route('ng-report.print.preview', $report->id) }}"><i
                                                                class="la la-eye"></i></a>
                                                    @endif
                                                @endcan
                                            </td>
                                            <td>
                                                @can('system-super-admin')
                                                    @if(isset($report->is_action_taken))
                                                        <a target="_blank" href="{{ route('ng-acr.print', $report->id) }}"><i
                                                                class="la la-print"></i></a>
                                                    @else
                                                        <a target="_blank"
                                                           href="{{ route('ng-report.print', $report->id) }}"><i
                                                                class="la la-print"></i></a>
                                                    @endif
                                                @endcan
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@push('page-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('theme/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('theme/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <style type="text/css">
        .dataTables_length {
            /*min-width: 1000px;*/
        }
    </style>
@endpush
@push('page-js')
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ asset('theme/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/tables/jszip.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/tables/pdfmake.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/tables/vfs_fonts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/tables/buttons.print.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/tables/buttons.colVis.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/month-year/custom-jquery-datepicker.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        let table = $('.inventory-report-table').DataTable({
            dom: "lBfrtip",
            "columnDefs": [
                {"orderable": false, "targets": 5}
            ],
            buttons: ["copyHtml5", "excelHtml5", "csvHtml5", {extend: "print", text: 'All list print'}],
            "language": {
                "search": "{{ trans('labels.search') }}",
                "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
                "lengthMenu": "{{ trans('labels.records') }}_MENU_",
                "info": "{{trans('labels.showing')}} _START_ {{trans('labels.to')}} _END_ {{trans('labels.of')}} _TOTAL_ {{ trans('labels.records') }}",
                "infoFiltered": "( {{ trans('labels.total')}} _MAX_ {{ trans('labels.infoFiltered') }} )",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "{{ trans('labels.next') }}",
                    "previous": "{{ trans('labels.previous') }}"
                },
            },

        });

        $('div.dataTables_length').append(`
            <label style="margin-left: 5px;">
                <input style="display: inline;" class= "form-control form-control-sm calendar-input"
                type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
            </label>
        `).append(`
            <label style="margin-left: 10px;">
                @lang('hrm::employee.employee')
        <select style="display: inline;" class="users-list form-control form-control-sm">
            <option value="all">Select Employee</options>
@foreach($requesters as $requester)
        <option value="{{ $requester->first_name }} {{ $requester->last_name }}">{{ $requester->first_name }} {{ $requester->last_name }}</option>
                        @endforeach
        </select>
</label>
`).append(`
            <label style="margin-left: 10px;">
                @lang('hrm::department.department')
        <select style="display: inline; width: 40%" class="department-list form-control form-control-sm">
            <option value="all">Select Department</options>
@foreach($departments as $department)
        <option value="{{ $department->name }}">{{ $department->name }}</option>
                    @endforeach
        </select>
    </label>
`);

        var dateRangePicker = $('input[name="daterange"]'),
            userLists = $('select.users-list'),
            departmentLists = $('select.department-list'),
            selectedUser = "all",
            selectedDepartment = "all",
            // startDate = moment('DD-MM-YYYY'),
            // endDate = moment('DD-MM-YYYY');
            startDate = moment().subtract(2, 'month').startOf('month'),
            endDate = moment();

        let current_fiscal_year = currentFiscalYear();
        let last_fiscal_year = lastFiscalYear();

        dateRangePicker.daterangepicker({
            opens: 'center',
            startDate: startDate,
            endDate: endDate,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                '3 Months': [moment().subtract(2, 'month').startOf('month'), moment()],
                '6 Months': [moment().subtract(5, 'month').startOf('month'), moment()],
                'Current Fiscal Year': [current_fiscal_year.start, current_fiscal_year.end],
                'Last Fiscal Year': [last_fiscal_year.start, last_fiscal_year.end]
            },
            locale: {
                format: 'DD-MM-YYYY'
            }

        }, function (start, end, label) {
            startDate = start;
            endDate = end;

        });

        dateRangePicker.on('apply.daterangepicker', function (e, picker) {
            startDate = picker.startDate;
            endDate = picker.endDate;

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    let date = moment(data[3], 'DD-MM-YYYY'),
                        userName = data[0],
                        status = false;

                    if (selectedUser === "all" || (selectedUser === userName)) {
                        status = true;
                    }

                    if (startDate == null && endDate == null && status === true) {
                        return true;
                    } else if (startDate == null && date <= endDate && status === true) {
                        return true;
                    } else if (endDate == null && date >= startDate && status === true) {
                        return true;
                    } else if (date <= endDate && date >= startDate && status === true) {
                        return true;
                    }

                    return false;
                }
            );

            table.draw();
            $.fn.dataTable.ext.search.pop();

        });

        userLists.on('change', function (e) {

            selectedUser = $(this).val();
            selectedDepartment = departmentLists.val();

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    return extracted(data);
                }
            );

            table.draw();
            $.fn.dataTable.ext.search.pop();

        });

        function extracted(data) {
            let departmentName = data[2],
                date = moment(data[3], 'DD-MM-YYYY'),
                userName = data[0],
                status = false;

            let hasDepartmentName = selectedDepartment === "all" || (selectedDepartment === departmentName);
            let hasUserName = selectedUser === "all" || (selectedUser === userName);

            if (hasDepartmentName && hasUserName) {
                status = true;
            }

            if (startDate == null && endDate == null && status === true) {
                return true;
            } else if (startDate == null && date <= endDate && status === true) {
                return true;
            } else if (endDate == null && date >= startDate && status === true) {
                return true;
            } else if (date <= endDate && date >= startDate && status === true) {
                return true;
            }

            return false;
        }

        departmentLists.on('change', function (e) {

            selectedDepartment = $(this).val();
            selectedUser = userLists.val();

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    return extracted(data);
                }
            );

            table.draw();
            $.fn.dataTable.ext.search.pop();

        });

    </script>
@endpush

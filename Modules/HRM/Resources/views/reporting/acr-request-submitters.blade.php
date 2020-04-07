@extends('hrm::layouts.master')

@section('title', 'Report Submitter/Non-Submitter List')

@section('content')
    <section id="product-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::appraisal.report_submitter_list')</h4>
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
                                <table class="submitter-table table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.id')</th>
                                        <th>@lang('labels.requester')</th>
                                        <th>@lang('hrm::designation.designation')</th>
                                        <th>@lang('hrm::department.department')</th>
                                        <th>@lang('hrm::department.section_title')</th>
                                        {{--                                            <th>@lang('labels.tel')</th>--}}
                                        <th>@lang('labels.mobile')</th>
                                        <th>@lang('hrm::appraisal.last_application_date')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($requestSubmitters as $requestSubmitter)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <th>{{ $requestSubmitter->employee_id }}</th>
                                            <td>{{ $requestSubmitter->first_name }} {{ $requestSubmitter->last_name }}</td>
                                            <td>{{ ($requestSubmitter->designation) ? $requestSubmitter->designation->name : '' }}</td>
                                            <td>{{ ($requestSubmitter->department) ? $requestSubmitter->department->name : '' }}</td>
                                            <td>{{ ($requestSubmitter->section) ? $requestSubmitter->section->name : '' }}</td>
                                            {{--                                                <td>{{ $requestSubmitter->tel_office }}</td>--}}
                                            <td>{{ $requestSubmitter->mobile_one }}</td>
                                            <td>{{ $requestSubmitter->last_application_date ? $requestSubmitter->last_application_date->created_at->format('d M, Y') : '' }}</td>
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::appraisal.report_non_submitter_list')</h4>
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
                                <table class="non-submitter-table table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.id')</th>
                                        <th>@lang('labels.requester')</th>
                                        <th>@lang('hrm::designation.designation')</th>
                                        <th>@lang('hrm::department.department')</th>
                                        <th>@lang('hrm::department.section_title')</th>
                                        {{--                                            <th>@lang('labels.tel')</th>--}}
                                        <th>@lang('labels.mobile')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($requestNonSubmitters as $requestNonSubmitter)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <th>{{ $requestNonSubmitter->employee_id }}</th>
                                            <td>{{ $requestNonSubmitter->first_name }} {{ $requestNonSubmitter->last_name }}</td>
                                            <td>{{ ($requestNonSubmitter->designation) ? $requestNonSubmitter->designation->name : '' }}</td>
                                            <td>{{ ($requestNonSubmitter->department) ? $requestNonSubmitter->department->name : '' }}</td>
                                            <td>{{ ($requestNonSubmitter->section) ? $requestNonSubmitter->section->name : '' }}</td>
                                            {{--                                            <td>{{ $requestNonSubmitter->tel_office }}</td>--}}
                                            <td>{{ $requestNonSubmitter->mobile_one }}</td>
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

        $('.submitter-table').DataTable({
            dom: "lBfrtip",
            "columnDefs": [
                {"orderable": false, "targets": 5}
            ],
            buttons: ["copyHtml5", "excelHtml5", "csvHtml5",
                {
                    extend: "print",
                    title: function () {
                        var printTitle = 'Report Submitter List';
                        return printTitle
                    }
                },
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
            },

        });
        $('.non-submitter-table').DataTable({
            dom: "lBfrtip",
            "columnDefs": [
                {"orderable": false, "targets": 5}
            ],
            buttons: ["copyHtml5", "excelHtml5", "csvHtml5",
                {
                    extend: "print",
                    title: function () {
                        var printTitle = 'Report Non-Submitter List';
                        return printTitle
                    }
                },
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
            },

        });

    </script>
@endpush

@extends('hrm::layouts.master')


@section('title', 'House Rent')

@section('content')

    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">House Information</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>


                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <table class="table table-striped table-bordered zero-configuration text-center">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Submitted By</th>
                                    <th>@lang('labels.date')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mohammad Imran Hossain</td>
                                    <td>24/03/2019</td>
                                    <td>
                                        <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false" class="btn btn-info dropdown-toggle">
                                            <i class="la la-cog"></i></button>
                                        <span aria-labelledby="btnSearchDrop2"
                                              class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{url('hrm/appraisal/12')}}"
                                                           class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                                         <div class="dropdown-divider"></div>
{{--                                                         <a href="#" class="dropdown-item"><i class="ft ft-trash"></i> @lang('labels.delete')</a>--}}
                                                </span>
                                        </span>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('page-css')

@endpush
@push('page-js')

@endpush

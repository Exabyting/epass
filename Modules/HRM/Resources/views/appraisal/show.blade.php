@extends('hrm::layouts.master')


@section('title', 'Note')

@push('page-css')


@endpush

@section('content')
    <!-- Striped row layout section start -->
    <section id="striped-row-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">Appraisal Form</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">

                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">

                            <form class="form form-horizontal striped-rows form-bordered">
                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput1">First Name</label>
                                        <div class="col-md-9">
                                            <input type="text" id="projectinput1" class="form-control"
                                                   placeholder="First Name"
                                                   name="fname" value="Imran">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput2">Last Name</label>
                                        <div class="col-md-9">
                                            <input type="text" id="projectinput2" class="form-control"
                                                   placeholder="Last Name"
                                                   name="lname" value="Hossain">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput3">E-mail</label>
                                        <div class="col-md-9">
                                            <input type="text" id="projectinput3" class="form-control"
                                                   placeholder="E-mail" name="email"
                                                   value="imran.hossain@brainstation-23.com">
                                        </div>
                                    </div>
                                    <div class="form-group row last">
                                        <label class="col-md-3 label-control" for="projectinput4">Contact Number</label>
                                        <div class="col-md-9">
                                            <input type="text" id="projectinput4" class="form-control"
                                                   placeholder="Phone" name="phone" value="01866803833">
                                        </div>
                                    </div>

                                    <!-- Project Informations -->
                                    <h4 class="form-section"><i
                                                {{--class="la  la-table"></i>{{__('hm::hostel.room').' '.__('labels.details')}}--}}
                                                class="la  la-table"></i>{{'Project '.__('labels.details')}}
                                    </h4>
                                    <!--Todo: Below values should be printed in loops  -->

                                    <div class="repeater-rooms">
                                        <div data-repeater-list="rooms">
                                            <div data-repeater-item="" style="">
                                                <div class="form row">

                                                    <div class="mb-1 col-sm-12 col-md-3 form-group">
                                                        <label for="room_type" class="required">Project Name</label>

                                                        <!-- Todo: Load this from an array  -->
                                                        <select class="form-control" required="required"
                                                                data-validation-required-message="The Room Type field is required."
                                                                id="room_type" name="room_type" disabled>

                                                            <option value="1">BARD</option>
                                                            <option value="2" selected>ONLINE KAIZEN</option>
                                                            <option value="3">LAZZ-PHARMA</option>
                                                            <option value="4">APEZ</option>
                                                        </select>
                                                        <div class="help-block"></div>
                                                    </div>
                                                    <div class="mb-1 col-sm-12 col-md-3">
                                                        <label for="room_type" class="required">Contributed As
                                                            : </label>

                                                        <!-- Todo: Load this from an array  -->
                                                        <select class="form-control" required="required"
                                                                data-validation-required-message="The Room Type field is required."
                                                                id="room_type" name="room_type" disabled>

                                                            <option value="1" selected>Team Leader</option>
                                                            <option value="2">Senior Software Engineer</option>
                                                            <option value="3">Associate Software Engineer</option>
                                                            <option value="4">Junior Software Engineer</option>
                                                        </select>
                                                        <div class="help-block"></div>
                                                    </div>


                                                    <div class="mb-1 col-sm-12 col-md-3 form-group">
                                                        <label for="room_type" class="required">Supervisor
                                                            Remarks: </label>
                                                        <input type="text" class="form-control"
                                                               name="supervisor_remarks"
                                                               id="supervisor_remarks">
                                                    </div>

                                                </div>
                                                <hr>
                                            </div>
                                        </div>


                                        <div class="form-actions text-center">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> Submit
                                            </button>
                                            <a class="btn btn-warning mr-1" role="button"
                                               href="#">
                                                <i class="ft-x"></i> Cancel
                                            </a>
                                        </div>
                                    </div>

                                    <!-- //Project Informations -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('page-js')
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('theme/js/scripts/forms/form-repeater.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->



@endpush

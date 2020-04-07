<!-- Striped row layout section start -->
<section id="striped-row-form-layouts">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="striped-row-layout-basic">@lang('hrm::appraisal.title') @lang('hrm::appraisal.request')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="row">
                            @include('hrm::gazetted-cadre-officer.request.partials.request-form-details')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(optional($gcoAppraisalRequest->receiver)->id == auth()->user()->id or optional(optional($gcoAppraisalRequest->action)->actor)->id == auth()->user()->id or auth()->user()->hasRole('ROLE_SUPER_ADMIN'))
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">২য় অংশ (জীবন বৃত্তান্ত)</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                {{--                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                @include('hrm::gazetted-cadre-officer.request.partials.iro-request-personal-form-details')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="striped-row-layout-basic"><i class="ft-tag"></i>
                                    ৩য় অংশ (ব্যক্তিগত বৈশিষ্ট্য)</h4>
                                <h4 class="card-title" id="striped-row-layout-basic">(অনুবেদনকারী পূরণ করিবেন)</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="row">
                                        @include('hrm::gazetted-cadre-officer.request.partials.first-evaluation-details')
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic"><i class="ft-tag"></i> @lang('hrm::cadre_officer_info.five_part')</h4>
                        <h4 class="card-title" id="striped-row-layout-basic">(অনুবেদনকারী পূরণ করিবেন)</h4>
                        {{-- <h4 class="card-title" id="striped-row-layout-basic">৩য় খণ্ড (প্রতিবেদনকারী অফিসার)</h4>--}}
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                {{--                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">

                                    <table class="table table-bordered">
                                        <tr>
                                            <td><b>অনুবেদনকারী মন্তব্য:-</b></td>
                                            <td>{{$gcoAppraisalRequest->summarizedEvaluation->comment }} </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic"><i class="ft-tag"></i> @lang('hrm::cadre_officer_info.six_part')</h4>
                        <h4 class="card-title" id="striped-row-layout-basic">(অনুবেদনকারী পূরণ করিবেন)</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                {{--                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="form-section"> @lang('hrm::cadre_officer_info.short_comment')</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>@lang('hrm::cadre_officer_info.special_trends_qualifications')</td>
                                            <td>@lang('hrm::cadre_officer_info.special_qualifications_options.' . $gcoAppraisalRequest->summarizedEvaluation->special_qualifications_options )</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hrm::cadre_officer_info.honesty_reputation')</td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hrm::cadre_officer_info.moral')</td>
                                            <td>{{$gcoAppraisalRequest->summarizedEvaluation->moral }} </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hrm::cadre_officer_info.intellectual')</td>
                                            <td>{{$gcoAppraisalRequest->summarizedEvaluation->intellectual }} </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hrm::cadre_officer_info.medical')</td>
                                            <td>{{$gcoAppraisalRequest->summarizedEvaluation->medical }} </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hrm::cadre_officer_info.further_recommendation')</td>
                                            <td>{{$gcoAppraisalRequest->summarizedEvaluation->further_recommendation }} </td>
                                        </tr>

                                    </table>
                                    <h4 class="form-section"> ২)  পদোন্নতির যোগ্যতা </h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>পদোন্নতির যোগ্যতা</td>
                                            <td>@lang('hrm::cadre_officer_info.final_decision.' . $gcoAppraisalRequest->summarizedEvaluation->final_decision)</td>
                                        </tr>

                                    </table>
                                    <h4 class="form-section"> অন্যান্য সুপারিশ (যদি থাকে) -- </h4>

                                    <table class="table table-bordered">
                                        <tr>
                                            <td><b>অন্যান্য সুপারিশ</b></td>
                                            <td>{{$gcoAppraisalRequest->summarizedEvaluation->comment }} </td>
                                        </tr>

                                    </table>

                                    <table class="table table-bordered">
                                        <tr>
                                            <th>{{ $gcoAppraisalRequest->receiver->first_name }} {{ $gcoAppraisalRequest->receiver->last_name }}</th>
                                        </tr>
                                        <tr>
                                            <td><img
                                                        src="{{ url('file/get?filePath=' . $gcoAppraisalRequest->receiver->signature) }}"
                                                        width="100px" height="50px"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic"><i class="ft-tag"></i> ৭ম অংশ (প্রতিস্বাক্ষরকারী কর্মকর্তার মন্তব্য)</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                {{--                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><b> আমি মনে করি যে, প্রতিবেদনকারী অফিসারের মূল্যায়নঃ </b></td>
                                            <td>
                                                @lang('hrm::appraisal.action-rating-options.' . $gcoAppraisalRequest->action->rating)
                                            </td>
                                        </tr>
                                        <tr >
                                            <th colspan="2"><b> অধিকিন্তু নিন্মে আমার মন্তব্য যোগ করিতেছিঃ</b></th>

                                        </tr>
                                        <tr>
                                            <td><b> (ক) সাধারণ মন্তব্যঃ </b></td>
                                            <td>{{$gcoAppraisalRequest->action->comment}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>@lang('hrm::cadre_officer_info.total_marks')</b></td>
                                            <td>{{ $gcoAppraisalRequest->action->total_marks }}</td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>{{ $gcoAppraisalRequest->action->actor->first_name }} {{ $gcoAppraisalRequest->action->actor->last_name }}</th>
                                        </tr>
                                        <tr>
                                            <td><img
                                                        src="{{ url('file/get?filePath=' . $gcoAppraisalRequest->action->actor->signature) }}"
                                                        width="100px" height="50px"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="form-actions text-center">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
</section>

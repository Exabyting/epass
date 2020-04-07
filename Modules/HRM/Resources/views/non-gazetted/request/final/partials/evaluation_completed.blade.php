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
                            @include('hrm::non-gazetted.request.partials.request-form-details')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(optional($ngAppraisalRequest->receiver)->id == auth()->user()->id or optional(optional($ngAppraisalRequest->action)->actor)->id == auth()->user()->id or auth()->user()->hasRole('ROLE_SUPER_ADMIN'))
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">২য় খন্ড (প্রতিবেদনকারী অফিসার)</h4>
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
                                @include('hrm::non-gazetted.request.partials.first-evaluation-details')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">৩য় খণ্ড (প্রতিবেদনকারী অফিসার)</h4>
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
                                    <h4 class="form-section"><i class="ft-tag"></i> পদোন্নতির যোগ্যতা</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><b>সমশ্রেণীর অন্যান্য অফিসারের সঙ্গে তুলনাক্রমে নিন্মের সঠিক কলামে
                                                    অনুসাক্ষর করিয়া এই অফিসার সম্পর্কে আপনার সাধারণ মূল্যায়ন
                                                    লিপিবদ্ধ
                                                    করুণঃ-</b></td>
                                            <td>@lang('hrm::appraisal.ng-rating-options.' . $ngAppraisalRequest->summarizedEvaluation->summarized_rating )</td>
                                        </tr>
                                        <tr>
                                            <td><b> নিম্নের সঠিক সিদ্ধান্ত নির্বাচন করুন</b></td>
                                            <td>@lang('hrm::appraisal.ng-final_decision.' . $ngAppraisalRequest->summarizedEvaluation->final_decision )</td>
                                        </tr>

                                    </table>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>{{ $ngAppraisalRequest->receiver->first_name }} {{ $ngAppraisalRequest->receiver->last_name }}</th>
                                        </tr>
                                        <tr>
                                            <td><img
                                                    src="{{ url('file/get?filePath=' . $ngAppraisalRequest->receiver->signature) }}"
                                                    width="100px" height="50px"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(optional(optional($ngAppraisalRequest->action)->actor)->id == auth()->user()->id or auth()->user()->hasRole('ROLE_SUPER_ADMIN'))
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="form-section"><i class="ft-tag"></i> ৪র্থ খন্ড- প্রতিস্বাক্ষরকারী অফিসার
                                        এর
                                        মন্তব্য</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><b> আমি মনে করি যে, রিপোর্ট প্রদানকারী অফিসারের মূল্যায়নঃ  </b></td>
                                            <td>
                                                @lang('hrm::appraisal.action-rating-options.' . $ngAppraisalRequest->action->rating)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b> অধিকিন্তু নিন্মে আমার মন্তব্য যোগ করিতেছিঃ</b></td>
                                            <td>{{$ngAppraisalRequest->action->comment}}</td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>{{ $ngAppraisalRequest->action->actor->first_name }} {{ $ngAppraisalRequest->action->actor->last_name }}</th>
                                        </tr>
                                        <tr>
                                            <td><img
                                                    src="{{ url('file/get?filePath=' . $ngAppraisalRequest->action->actor->signature) }}"
                                                    width="100px" height="50px"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="form-actions text-center">
                                <ul class="list-inline mb-0">
                                    {{--                                        <li>--}}
                                    {{--                                            <a target="_blank"--}}
                                    {{--                                               id="{{$ngAppraisalRequest->id}}"--}}
                                    {{--                                               href="{{ route('ng-acr.print.preview', $ngAppraisalRequest->id) }}"--}}
                                    {{--                                               class="btn btn-teal"><i--}}
                                    {{--                                                    class="la la-eye"></i> @lang('labels.print_preview')</a>--}}
                                    {{--                                        </li>--}}
                                    {{--                                        <li>--}}
                                    {{--                                            <a target="_blank" href="{{ route('ng-acr.print', $ngAppraisalRequest->id) }}"--}}
                                    {{--                                               class="btn btn-primary">--}}
                                    {{--                                                <i class="la la-print"></i> @lang('labels.print')</a>--}}
                                    {{--                                        </li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

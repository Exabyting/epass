@extends('hrm::layouts.master')
@section('title', 'Appraisal Request')

@section('content')
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
                               @include('hrm::appraisal.request.partials.request-form-details')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(optional($appraisalRequest->receiver)->id == auth()->user()->id or optional(optional($appraisalRequest->action)->actor)->id == auth()->user()->id or auth()->user()->hasRole('ROLE_SUPER_ADMIN'))
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="striped-row-layout-basic">২য় খন্ড (অনুস্বাক্ষরকারী অফিসার)</h4>
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
                                    <div class="col-md-6">
                                        {{--                                    <h4 class="form-section"><i class="ft-tag"></i> 1st Evaluation : Rating</h4>--}}
                                        <table class="table table-bordered">
                                            @foreach($primaryTable as $primaryData)
                                                <tr>
                                                    <th width="50%">{{ $primaryData['position'] }}
                                                        | {{ $primaryData['question'] }}</th>
                                                    <td>@lang('hrm::appraisal.rating-options.' . $primaryData['answer'] )</td>
                                                    <td><img
                                                            src="{{ url('file/get?filePath=' . $appraisalRequest->receiver->signature) }}"
                                                            width="50px" height="20px"></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        {{--                                    <h4 class="form-section"><i class="ft-tag"></i> 1st Evaluation : Special Rating</h4>--}}
                                        <table class="table table-bordered">
                                            @foreach($specialTable as $specialData)
                                                <tr>
                                                    <th width="50%">{{ $specialData['position'] }}
                                                        | {{ $specialData['question'] }}</th>
                                                    @if($specialData['answer'])
                                                        <td>@lang('hrm::appraisal.rating-options.' . $specialData['answer'] )</td>
                                                        <td><img
                                                                src="{{ url('file/get?filePath=' . $appraisalRequest->receiver->signature) }}"
                                                                width="50px" height="20px"></td>
                                                    @else
                                                        <td colspan="2"></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </table>
                                        <h4 class="form-section"><i class="ft-tag"></i> কেবলমাত্র প্রযোজ্য ক্ষেত্রেই
                                        </h4>
                                        <table class="table table-bordered">
                                            @foreach($optionalTable as $optionalData)
                                                <tr>
                                                    <th width="50%">{{ $optionalData['position'] }}
                                                        | {{ $optionalData['question'] }}</th>
                                                    @if($optionalData['answer'])
                                                        <td>{{ $optionalData['answer'] }}</td>
                                                        <td><img
                                                                src="{{ url('file/get?filePath=' . $appraisalRequest->receiver->signature) }}"
                                                                width="50px" height="20px"></td>
                                                    @else
                                                        <td colspan="2"></td>
                                                    @endif
                                                </tr>
                                            @endforeach
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
                            <h4 class="card-title" id="striped-row-layout-basic">৩য় খণ্ড (অনুস্বাক্ষরকারী অফিসার)</h4>
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
                                                <td>@lang('hrm::appraisal.rating-options.' . $appraisalRequest->summarizedEvaluation->summarized_rating )</td>
                                            </tr>
                                            <tr>
                                                <td><b> নিম্মনের সঠিক সিদ্ধান্ত নির্বাচন করুন</b></td>
                                                <td>@lang('hrm::appraisal.final_decision.' . $appraisalRequest->summarizedEvaluation->final_decision )</td>
                                            </tr>
                                            <tr>
                                                <td><b>- বিশেষ প্রবণতা থাকিলে উহার উপর মন্তব্য যেমন :- ( সচিবালয় ,
                                                        প্রশাসন ,
                                                        বিচার বিভাগ , উন্নয়ন বা কূটনীতি সম্পর্কিত কার্য )।</b></td>
                                                <td>{{ $appraisalRequest->summarizedEvaluation->comment }}</td>
                                            </tr>
                                        </table>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>{{ $appraisalRequest->receiver->first_name }} {{ $appraisalRequest->receiver->last_name }}</th>
                                            </tr>
                                            <tr>
                                                <td><img
                                                        src="{{ url('file/get?filePath=' . $appraisalRequest->receiver->signature) }}"
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
            @if(optional(optional($appraisalRequest->action)->actor)->id == auth()->user()->id or auth()->user()->hasRole('ROLE_SUPER_ADMIN'))
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="form-section"><i class="ft-tag"></i> ৪র্থ খন্ড- প্রতিস্বাক্ষরকারী
                                            অফিসার
                                            এর
                                            মন্তব্য</h4>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td><b> আমি মনে করি যে, রিপোর্ট প্রদানকারী অফিসারের মূল্যায়ন অত্যুত্তম/
                                                        যুক্তি সঙ্গতভাবেঃ </b></td>
                                                <td>
                                                    @lang('hrm::appraisal.action-rating-options.' . $appraisalRequest->action->rating)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b> অধিকিন্তু নিন্মে আমার মন্তব্য যোগ করিতেছিঃ</b></td>
                                                <td>{{$appraisalRequest->action->comment}}</td>
                                            </tr>
                                        </table>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>{{ $appraisalRequest->action->actor->first_name }} {{ $appraisalRequest->action->actor->last_name }}</th>
                                            </tr>
                                            <tr>
                                                <td><img
                                                        src="{{ url('file/get?filePath=' . $appraisalRequest->action->actor->signature) }}"
                                                        width="100px" height="50px"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions text-center">
                                    <ul class="list-inline mb-0">
{{--                                        <li><a target="_blank"--}}
{{--                                               id="{{$appraisalRequest->id}}"--}}
{{--                                               href="{{ route('acr.print.preview', $appraisalRequest->id) }}"--}}
{{--                                               class="btn btn-teal"><i--}}
{{--                                                    class="la la-eye"></i> @lang('labels.print_preview')</a>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a target="_blank" href="{{ route('acr.print', $appraisalRequest->id) }}"--}}
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
            @if(optional($appraisalRequest->approval)->status == "Completed" &&  auth()->user()->hasRole('ROLE_SUPER_ADMIN'))
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="form-section"><i class="ft-tag"></i>
                                            @lang('hrm::appraisal.final_info')</h4>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>
                                                    <b>
                                                        @lang("hrm::appraisal.filled_up_date")
                                                    </b>
                                                </td>
                                                <td>
                                                    {{en2bn(date('d-m-Y', time($appraisalRequest->updated_at)))}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>
                                                        @lang("hrm::appraisal.cause_of_late")
                                                    </b>
                                                </td>
                                                <td>{{optional($appraisalRequest->approval)->cause_of_late}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>
                                                        @lang("hrm::appraisal.work_on_application")
                                                    </b>
                                                </td>
                                                <td>{{optional($appraisalRequest->approval)->work_on_application}}</td>
                                            </tr>
                                        </table>
                                        <h4 class="form-section"><i class="ft-tag"></i>
                                            @lang('labels.responsible_officer_sign_seal')</h4>

                                        <table class="table table-bordered">
                                            <tr>
                                                <th>@lang('labels.name')</th>
                                                <td>{{auth()->user()->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('labels.designation')</th>
                                                <td>{{auth()->user()->employee->designation->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('labels.id_no')</th>
                                                <td>{{en2bn(auth()->user()->employee->employee_id)}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('labels.date'):</th>
                                                <td>{{en2bn(date('d-m-Y', time()))}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions text-center">
                                    <ul class="list-inline mb-0">
{{--                                        <li><a target="_blank"--}}
{{--                                               id="{{$appraisalRequest->id}}"--}}
{{--                                               href="{{ route('acr.print.preview', $appraisalRequest->id) }}"--}}
{{--                                               class="btn btn-teal"><i--}}
{{--                                                    class="la la-eye"></i> @lang('labels.print_preview')</a>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a target="_blank" href="{{ route('acr.print', $appraisalRequest->id) }}"--}}
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

@endsection


@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(() => {
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");

        });


        let validator = $('.appraisal-evaluation-form').validate({
            ignore: [],
            errorClass: 'danger',
            successClass: 'success',
            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorPlacement: function (error, element) {
                if (element.attr('type') == 'radio') {
                    error.insertBefore(element.parents().siblings('.radio-error'));
                } else if (element[0].tagName == "SELECT") {
                    error.insertAfter(element.siblings('.select2-container'));
                } else if (element.attr('id') == 'ckeditor') {
                    error.insertAfter(element.siblings('#cke_ckeditor'));
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {},
            submitHandler: function (form, event) {
                form.submit();
            }
        });
    </script>
@endpush

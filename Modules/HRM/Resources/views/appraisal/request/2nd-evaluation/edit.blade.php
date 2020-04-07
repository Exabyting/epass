@extends('hrm::layouts.master')
@section('title', 'Appraisal Request 1st Evaluation')

@section('content')
    <!-- Striped row layout section start -->
    <section id="striped-row-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">আবেদনকারীর ব্যক্তিগত তত্থ্য</h4>
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
                                <div class="col-md-7">
                                    <h4 class="form-section"><i
                                            class="ft-tag"></i> @lang('hrm::appraisal.personal_info')</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.job_name')</th>
                                            <td>{{ $appraisalRequest->job_name }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.date_range')</th>
                                            <td>{{ date('d M, Y', strtotime($appraisalRequest->reporting_date_start)) }}
                                                - {{ date('d M, Y', strtotime($appraisalRequest->reporting_date_end)) }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::employee.menu_name')</th>
                                            <td>{{ $appraisalRequest->requester->first_name }} {{ $appraisalRequest->requester->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.educational_qualifications')</th>
                                            <td>{{ $appraisalRequest->educational_qualifications }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.birth_date')</th>
                                            <td>{{ $appraisalRequest->birth_date }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.job_period')</th>
                                            <td>{{ $appraisalRequest->total_job_period }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.special_training')</th>
                                            <td>{{ $appraisalRequest->special_training }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.known_languages')</th>
                                            <td>{{ $appraisalRequest->languages }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.actual_job_period_under_officer')</th>
                                            <td>{{ $appraisalRequest->reporting_job_period }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.report_giving_officer')</th>
                                            <td>{{ $appraisalRequest->receiver->first_name }} {{ $appraisalRequest->receiver->last_name }}</td>
                                        </tr>
                                    </table>
                                </div>
                                @if($appraisalRequest->jobHistories)
                                    <div class="col-md-5">
                                        <h4 class="form-section"><i class="ft-tag"></i> আলোচ্য সময় যে পদে বহাল ছিলেন
                                        </h4>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>পদ</th>
                                                <th>সময়</th>
                                                <th>বেতন ও বেতন স্কেল</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($appraisalRequest->jobHistories as $jobHistory)
                                                <tr>
                                                    <td>{{ $jobHistory->designation }}</td>
                                                    <td>{{ $jobHistory->duration }}</td>
                                                    <td>{{ $jobHistory->salary_scale }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">২য় খন্ড (অনুস্বাক্ষরকারী অফিসার)</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                {{--                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                                {{--                                @if($appraisalRequest->receiver->user->id === auth()->user()->id && $appraisalRequest->is_evaluated)--}}
                                {{--                                    <a href="{{ route('appraisal-request.first-evaluation-edit', $appraisalRequest->id) }}" class="btn btn-primary btn-lg">--}}
                                {{--                                        <i class="la la-edit white"></i> @lang('labels.edit')--}}
                                {{--                                    </a>--}}
                                {{--                                @endif--}}
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
                                                @if($primaryData['answer'])
                                                    <td>@lang('hrm::appraisal.rating-options.' . $primaryData['answer'] )</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>{{ $primaryData['comment'] }}</td>
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
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>{{ $specialData['comment'] }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <h4 class="form-section"><i class="ft-tag"></i> কেবলমাত্র প্রযোজ্য ক্ষেত্রেই </h4>
                                    <table class="table table-bordered">
                                        @foreach($optionalTable as $optionalData)
                                            <tr>
                                                <th width="50%">{{ $optionalData['position'] }}
                                                    | {{ $optionalData['question'] }}</th>
                                                @if($optionalData['answer'])
                                                    <td>{{ $optionalData['answer'] }}</td>
                                                @else
                                                    <td></td>
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
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['route' =>  ['appraisal-request.second-evaluation-update', $appraisalRequest->id],'class' => 'form appraisal-evaluation-form']) !!}
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-tag"></i> পদোন্নতির যোগ্যতা</h4>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required"> সমশ্রেণীর অন্যান্য অফিসারের সঙ্গে
                                                তুলনাক্রমে নিন্মের সঠিক কলামে অনুসাক্ষর করিয়া এই অফিসার সম্পর্কে আপনার
                                                সাধারণ মূল্যায়ন লিপিবদ্ধ করুণঃ- </label>
                                            <label class="radio-error" style="display:none;">Please choose one.</label>
                                            <div class="row skin skin-square">
                                                <div class="col-md-12 col-sm-12">
                                                    @foreach(trans('hrm::appraisal.rating-options') as $key => $value)
                                                        <input type="radio" name="summarized_rating"
                                                               {{ $appraisalRequest->summarizedEvaluation->summarized_rating == $key ? "checked" : "" }}
                                                               class="form-control radio required" value="{{ $key }}"
                                                               data-msg-required="{{ trans('labels.This field is required')}}">
                                                        <label>{{ $value }}</label>
                                                    @endforeach
                                                    @if ($errors->has('summarized_rating'))
                                                        <h6 class="text-danger"> যে কোনো একটি বাছাই করুন </h6>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label required"> - নিম্মনের সঠিক সিদ্ধান্ত নির্বাচন
                                                করুন </label>
                                            <label class="radio-error" style="display:none;">Please choose one.</label>
                                            <div class="row skin skin-square radio">
                                                <div class="col-md-12 col-sm-12">
                                                    @foreach(trans('hrm::appraisal.final_decision') as $value => $decision)
                                                        <fieldset>
                                                            <input type="radio" name="final_decision"
                                                                   {{ $appraisalRequest->summarizedEvaluation->final_decision == $value ? "checked" : "" }}
                                                                   class="form-control radio required"
                                                                   value="{{ $value }} "
                                                                   data-msg-required="{{ trans('labels.This field is required')}}">
                                                            <label>{{ $decision }}</label>
                                                        </fieldset>
                                                    @endforeach
                                                    @if ($errors->has('final_decision'))
                                                        <h6 class="text-danger"> যে কোনো একটি বাছাই করুন </h6>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required"> - বিশেষ প্রবণতা থাকিলে উহার উপর মন্তব্য
                                                যেমন :- ( সচিবালয় , প্রশাসন , বিচার বিভাগ , উন্নয়ন বা কূটনীতি সম্পর্কিত
                                                কার্য )।</label>
                                            <textarea name="comment"
                                                      class="form-control required" rows="5"
                                                      data-msg-required="{{ trans('labels.This field is required')}}"
                                            >{{$appraisalRequest->summarizedEvaluation->comment}}</textarea>
                                        </div>
                                        @if ($errors->has('comment'))
                                            <h6 class="text-danger"> যে কোনো মন্তব্য লিখুন </h6>
                                        @endif
                                        <div class="form-group {{ $errors->has('name') ? ' error' : '' }}">
                                            {!! Form::label('receiver_id',  trans('hrm::appraisal.signing_officer'), ['class' => 'form-label required']) !!}

                                            {!! Form::select('receiver_id',
                                                $reportingOfficers, $appraisalRequest->summarizedEvaluation->receiver_id,
                                                [
                                                    'class'=>'form-control select required' . ($errors->has('receiver_id') ? ' is-invalid' : ''),
                                                    'data-msg-required' => trans('validation.required', ['attribute' => trans('ims::inventory.recipients.title')]),
                                                ])
                                            !!}

                                            <div class="help-block"></div>
                                            @if ($errors->has('receiver_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('receiver_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions text-center">
                                @if($appraisalRequest->receiver->user->id === auth()->user()->id && $appraisalRequest->is_evaluated)
                                    <a href="{{ route('appraisal-request.first-evaluation-edit', $appraisalRequest->id) }}"
                                       class="btn btn-primary">
                                        <i class="la la-edit white"></i> @lang('labels.edit')
                                    </a>
                                @endif
                                <button type="submit" class="btn btn-teal">
                                    <i class="la la-check-square-o"></i> @lang('labels.send')
                                </button>
                                <a class="btn btn-warning mr-1" role="button"
                                   href="{{ route('appraisal-request.second-evaluation-show', $appraisalRequest->id) }}">
                                    <i class="la la-chevron-left"></i> @lang('labels.go_back')
                                </a>

                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
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


    <script>
        $(document).ready(() => {
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");

            $('.skin-square input').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            $('input:radio').on('ifClicked', function (e) {
                if ($(this).is(':checked')) {
                    $(this).iCheck('uncheck');
                }
            });

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
            rules: {
                // summarized_rating: {
                //     required: true
                // }
            },
            // messages: {
            //     summarized_rating: {
            //         required: "We need your email address to contact you"
            //     }
            // },
            submitHandler: function (form, event) {
                form.submit();
            }
        });
    </script>
@endpush

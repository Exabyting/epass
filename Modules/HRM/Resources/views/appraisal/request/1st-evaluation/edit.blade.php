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
                                    <h4 class="form-section"><i class="ft-tag"></i> @lang('hrm::appraisal.personal_info')</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.job_name')</th>
                                            <td>{{ $appraisalRequest->job_name }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">@lang('hrm::appraisal.date_range')</th>
                                            <td>{{ date('d M, Y', strtotime($appraisalRequest->reporting_date_start)) }} - {{ date('d M, Y', strtotime($appraisalRequest->reporting_date_end)) }}</td>
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
                                    <h4 class="form-section"><i class="ft-tag"></i> আলোচ্য সময় যে পদে বহাল ছিলেন</h4>
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
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['route' =>  ['appraisal-request.first-evaluation-update', $appraisalRequest->id],'class' => 'form appraisal-evaluation-form']) !!}
                            <div class="form-body">
{{--                                <h4 class="form-section"><i class="ft-tag"></i> 1st Evaluation : Rating</h4>--}}
                                <div class="row">
                                    @foreach($evaluationQuestions as $evaluationQuestion)
                                        @if($evaluationQuestion->type == config('constants.question_type.primary'))
                                            @php
                                                $primaryIndex = array_search($evaluationQuestion->id, array_map(function($data) {return $data['id'];}, $primaryTable));
                                                $primaryData = $primaryTable[$primaryIndex];
                                            @endphp
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{{ $evaluationQuestion->position }}| {{ $evaluationQuestion->question }}</label>
                                                <div class="row skin skin-square">
                                                    <div class="col-md-12 col-sm-12">
                                                        @foreach(trans('hrm::appraisal.rating-options') as $key => $value)
                                                            <input type="radio"
                                                                   {{ $primaryData['answer'] == $key ? "checked" : "" }}
                                                                   name="rating[{{$evaluationQuestion->id}}]"
                                                                   value="{{ $key }}" >  <label>{{ $value }}</label>
                                                        @endforeach
                                                        <br>
                                                        <label>@lang('labels.comment')</label> <input type="text" name="comment[{{$evaluationQuestion->id}}]" value="{{ $primaryData['comment'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>

{{--                                <h4 class="form-section"><i class="ft-tag"></i> 1st Evaluation : Special Rating</h4>--}}
                                <div class="row">
                                    @foreach($evaluationQuestions as $evaluationQuestion)
                                        @if($evaluationQuestion->type == config('constants.question_type.special'))
                                            @php
                                                $specialIndex = array_search($evaluationQuestion->id, array_map(function($data) {return $data['id'];}, $specialTable));
                                                $specialData = $specialTable[$specialIndex];
                                            @endphp
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @if($evaluationQuestion->question)
                                                        <label class="form-label">{{ $evaluationQuestion->position }}| {{ $evaluationQuestion->question }}</label>
                                                    @else
                                                        <fieldset>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">{{ $evaluationQuestion->position }}</span>
                                                                </div>
                                                                <input type="text" name="special[{{$evaluationQuestion->id}}]" class="form-control" placeholder="Special" value="{{ $specialData['question'] }}">
                                                            </div>
                                                        </fieldset>
                                                    @endif
                                                    <div class="row skin skin-square">
                                                        <div class="col-md-12 col-sm-12">
                                                            @foreach(trans('hrm::appraisal.rating-options') as $key => $value)
                                                                <input type="radio"
                                                                       {{ $specialData['answer'] == $key ? "checked" : "" }}
                                                                       name="rating[{{$evaluationQuestion->id}}]"
                                                                       value="{{ $key }}">  <label>{{ $value }}</label>
                                                            @endforeach
                                                                <br>
                                                                <label>@lang('labels.comment')</label> <input type="text" name="comment[{{$evaluationQuestion->id}}]" value="{{ $specialData['comment'] }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <h4 class="form-section"><i class="ft-tag"></i> কেবলমাত্র প্রযোজ্য ক্ষেত্রেই </h4>
                                <div class="row">
                                    @foreach($evaluationQuestions as $evaluationQuestion)
                                        @if($evaluationQuestion->type == config('constants.question_type.optional'))
                                            @php
                                                $optionalIndex = array_search($evaluationQuestion->id, array_map(function($data) {return $data['id'];}, $optionalTable));
                                                $optionalData = $optionalTable[$optionalIndex];
                                            @endphp
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">{{ $evaluationQuestion->position }}| {{ $evaluationQuestion->question }}</label>
                                                    <div class="row skin skin-square">
                                                        <div class="col-md-12 col-sm-12">
                                                            <fieldset>
                                                                <input type="radio" name="applicable_rating[{{$evaluationQuestion->id}}]" {{ $optionalData['applicableRating'] == 1 ? "checked" : "" }} value="1">
                                                                <label>{{ $evaluationQuestion->optional_answer_1 }}</label>
                                                            </fieldset>
                                                            <fieldset>
                                                                <input type="radio" name="applicable_rating[{{$evaluationQuestion->id}}]" {{ $optionalData['applicableRating'] == 2 ? "checked" : "" }} value="2">
                                                                <label>{{ $evaluationQuestion->optional_answer_2 }}</label>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> @lang('labels.next_step')
                                </button>
                                <a class="btn btn-warning mr-1" role="button" href="{{ route('appraisal-request.create') }}">
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
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

    <script>
        $(document).ready(() => {
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");

            $('.skin-square input').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            $('input:radio').on('ifClicked',function (e) {
                if($(this).is(':checked')) {
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
            rules: {},
            submitHandler: function (form, event) {
                form.submit();
            }
        });
    </script>
@endpush

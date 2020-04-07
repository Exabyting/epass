@extends('hrm::layouts.master')
@section('title', 'Appraisal Request 1st Evaluation')

@section('content')
    <!-- Striped row layout section start -->
    <section id="striped-row-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">
                            (@lang('hrm::appraisal.gazetted-cadre') @lang('labels.officer'))</h4>
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
                                @include('hrm::gazetted-cadre-officer.request.partials.request-form-details')
                            </div>
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
                        <h4 class="card-title" id="striped-row-layout-basic">৩য় ও ৪র্থ (অংশ অনুবেদনকারী অনুস্বাক্ষর দ্বারা পূরণ করিবেন)</h4>
                        <h4 class="card-title" id="striped-row-layout-basic">৩য় অংশ (ব্যক্তিগত বৈশিষ্ট্য)</h4>
                        @if ($errors->has('rating')) <h6 class="text-danger"> * চিহ্নিত অপশন গুলো বাছাই
                            করুন </h6> @endif
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                {{--  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['route' =>  ['gco-appraisal-request.first-evaluation-store', $gcoAppraisalRequest->id],'class' => 'form appraisal-evaluation-form']) !!}
                            <div class="form-body">
                                {{--   <h4 class="form-section"><i class="ft-tag"></i> 1st Evaluation : Rating</h4>--}}

                                <div class="row">
                                    @foreach($evaluationQuestions as $evaluationQuestion)
                                        @if($evaluationQuestion->type == config('constants.question_type.primary'))
                                            <div class="col-md-6 ">
                                                <div
                                                    class="form-group {{ $errors->has('rating['. $evaluationQuestion->id .']') ? ' error' : '' }}">
                                                    <label
                                                        for="rating[{{$evaluationQuestion->id}}]"
                                                        class="form-label required">{{ $evaluationQuestion->position }}
                                                        | {{ $evaluationQuestion->question }}</label>
                                                    <label class="radio-error" style="display:none;">Please choose
                                                        one.</label>
                                                    @if (!$errors->has('rating') && $errors->has('rating.'.$evaluationQuestion->id))
                                                        <h6 class="text-danger"> যে কোনো একটি বাছাই করুন </h6>
                                                    @endif
                                                    <div class="row skin skin-square radio ">
                                                        <div class="col-md-12 col-sm-12">
                                                            @foreach(trans('hrm::cadre_officer_info.gco-rating-options') as $key => $value)
                                                                <input
                                                                    class="form-control radio required"
                                                                    type="radio"
                                                                    data-msg-required="{{trans('labels.This field is required')}}"
                                                                    name="rating[{{$evaluationQuestion->id}}]"
                                                                    value="{{ $key }}">  <label>{{ $value }}</label>
                                                            @endforeach
                                                            {{--<br>
                                                            <label> @lang('labels.comment')</label>
                                                            <input type="text"
                                                                   name="comment[{{$evaluationQuestion->id}}]">--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <br>
                                <div class="form-actions text-center"></div>
                                <h4 class="card-title" id="striped-row-layout-basic"> ৪র্থ অংশ (কার্যসম্পাদন) </h4>
                                {{--    <h4 class="form-section"><i class="ft-tag"></i> 1st Evaluation : Special Rating</h4>--}}
                                <div class="row">
                                    @foreach($evaluationQuestions as $evaluationQuestion)
                                        @if($evaluationQuestion->type == config('constants.question_type.special'))
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @if($evaluationQuestion->question)
                                                        <label class="form-label required">{{ $evaluationQuestion->position }}
                                                            | {{ $evaluationQuestion->question }}</label>
                                                        <label class="radio-error" style="display:none;">Please choose
                                                            one.</label>
                                                        @if (!$errors->has('rating') && $errors->has('rating.'.$evaluationQuestion->id))
                                                            <h6 class="text-danger"> যে কোনো একটি বাছাই করুন </h6>
                                                        @endif
                                                    @else
                                                        <fieldset>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text">{{ $evaluationQuestion->position }}</span>
                                                                </div>
                                                                <input type="text"
                                                                       name="special[{{$evaluationQuestion->id}}]"
                                                                       class="form-control radio required" placeholder="Special">
                                                            </div>
                                                        </fieldset>
                                                    @endif

                                                    <div class="row skin skin-square">
                                                        <div class="col-md-12 col-sm-12">
                                                            @foreach(trans('hrm::cadre_officer_info.gco-rating-options') as $key => $value)
                                                                <input
                                                                        class="form-control radio required"
                                                                        type="radio"
                                                                        data-msg-required="{{trans('labels.This field is required')}}"
                                                                        name="rating[{{$evaluationQuestion->id}}]"
                                                                        value="{{ $key }}">  <label>{{ $value }}</label>


                             {{--                                   <input type="radio"
                                                                       name="rating[{{$evaluationQuestion->id}}]"
                                                                       value="{{ $key }}">  <label>{{ $value }}</label>--}}
                                                            @endforeach
                                                            {{--<br>
                                                            <label>@lang('labels.comment')</label>
                                                            <input type="text"
                                                                   name="comment[{{$evaluationQuestion->id}}]">--}}
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
                                <a class="btn btn-warning mr-1" role="button"
                                   href="{{ route('gco-appraisal-request.index') }}">
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
                    error.insertBefore(element.parents().parents().parents().siblings('.radio-error'));
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

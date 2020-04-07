@extends('hrm::layouts.master')
@section('title', 'Appraisal Request Action')

@section('content')

    <!-- Striped row layout section start -->
    <section id="striped-row-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">আবেদনকারীর ব্যক্তিগত তত্থ্য
                            (@lang('labels.gazetted-cadre-officer'))</h4>
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
                               {{-- @include('hrm::non-gazetted.request.partials.request-form-details')--}}
                                @include('hrm::gazetted-cadre-officer.request.partials.request-form-details')

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">২য় খন্ড (প্রতিবেদনকারী অফিসার)</h4>
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
                                {{--@include('hrm::gazetted-cadre-officer.request.partials.request-personal-form-details')--}}
                                @include('hrm::gazetted-cadre-officer.request.partials.iro-request-personal-form-details')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           {{-- @if(optional($gcoAppraisalRequest->receiver)->id == auth()->user()->id or optional(optional($gcoAppraisalRequest->action)->actor)->id == auth()->user()->id or auth()->user()->hasRole('ROLE_SUPER_ADMIN'))--}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="striped-row-layout-basic">
                                ৩য় অংশ (ব্যক্তিগত বৈশিষ্ট্য)</h4>
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
                                    @include('hrm::gazetted-cadre-officer.request.partials.first-evaluation-details')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="striped-row-layout-basic"> @lang('hrm::cadre_officer_info.five_part')</h4>
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
                                                <td><b>অনুবেদনকারী মন্তব্য ঃ-</b></td>
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
                            <h4 class="card-title" id="striped-row-layout-basic"> @lang('hrm::cadre_officer_info.six_part')</h4>
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
                                        <h4 class="form-section"><i class="ft-tag"></i> @lang('hrm::cadre_officer_info.short_comment')</h4>
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
                                        <h4 class="form-section"><i class="ft-tag"></i> ২)  পদোন্নতির যোগ্যতা </h4>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>পদোন্নতির যোগ্যতা</td>
                                                <td>@lang('hrm::cadre_officer_info.final_decision.' . $gcoAppraisalRequest->summarizedEvaluation->final_decision)</td>
                                            </tr>

                                        </table>
                                        <h4 class="form-section"><i class="ft-tag"></i> অন্যান্য সুপারিশ (যদি থাকে) -- </h4>

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
           {{-- @endif--}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">৭ম অংশ (প্রতিস্বাক্ষরকারী কর্মকর্তার মন্তব্য)</h4>
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
                            {!! Form::open(['route' =>  ['gco-appraisal-request.action-store', $gcoAppraisalRequest->id],'class' => 'form appraisal-evaluation-form']) !!}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row skin skin-square">
                                                <div class="col-md-12 col-sm-12">
                                                    <label class="form-label required"> আমি মনে করি যে, প্রতিবেদনকারী অফিসারের
                                                          মূল্যায়নঃ </label>
                                                    <label class="radio-error" style="display:none;">Please choose
                                                        one.</label>
                                                    @if ($errors->has('rating'))
                                                        <h6 class="text-danger"> যে কোনো একটি বাছাই করুন </h6>
                                                    @endif
                                                    @foreach(trans('hrm::appraisal.action-rating-options') as $key => $value)
                                                        @if(optional($gcoAppraisalRequest->action)->rating == $key)
                                                            <input class="form-control radio required"
                                                                   checked
                                                                   data-msg-required="{{trans('labels.This field is required')}}"
                                                                   type="radio" name="rating" value="{{ $key }}">
                                                            <label>{{ $value }}</label>
                                                        @else
                                                            <input class="form-control radio required"
                                                                   data-msg-required="{{trans('labels.This field is required')}}"
                                                                   type="radio" name="rating" value="{{ $key }}">
                                                            <label>{{ $value }}</label>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label required">অধিকিন্তু নিন্মে আমার মন্তব্য যোগ
                                                করিতেছিঃ</label> <br>
                                            <label class="radio-error" style="display:none;">Please choose
                                                one.</label>
                                            <label class="required">(ক) সাধারণ মন্তব্যঃ </label>
                                            @if ($errors->has('comment'))
                                                <h6 class="text-danger"> যে কোনো একটি কমেন্ট করুন </h6>
                                            @endif
                                            <textarea name="comment" class="form-control required" rows="5"
                                                      data-msg-required="{{ trans('labels.This field is required')}}">{{optional($gcoAppraisalRequest->action)->comment}}</textarea>


                                            <div class="form-group {{ $errors->has('total_marks') ? ' error' : '' }}">
                                                {!! Form::label('total_marks', trans('hrm::cadre_officer_info.total_marks'), ['class' => 'form-label required']) !!}
                                                {!! Form::number('total_marks', optional($gcoAppraisalRequest->action)->total_marks,
                                                    [
                                                        'min' => '0' ,
                                                        'max' => '100' ,
                                                        'id' => 'total_marks',
                                                        'class' => "form-control",
                                                        "required ",
                                                        'data-msg-required' => trans('labels.This field is required'),

                                                    ])
                                                !!}
                                                <div class="help-block"></div>
                                                @if ($errors->has('total_marks'))
                                                    <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $errors->first('total_marks') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

{{--                                            <div class="form-group {{ $errors->has('total_marks') ? ' error' : '' }}">
                                                {!! Form::label('total_marks', trans('hrm::cadre_officer_info.total_marks'), ['class' => 'form-label required']) !!}
                                                {{ Form::text('total_marks',optional($gcoAppraisalRequest->action)->total_marks,

                                                                [
                                                                    'class' => 'form-control',
                                                                    'data-msg-required' => trans('labels.This field is required'),

                                                                ]
                                                            )
                                                        }}
                                                <div class="help-block"></div>
                                                @if ($errors->has('total_marks'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('total_marks') }}</strong>
                                                     </span>
                                                @endif
                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions text-center">
{{--                                <a target="_blank"--}}
{{--                                   href="{{ route('ng-evaluated-acr.print.preview', $ngAppraisalRequest->id) }}"--}}
{{--                                   class="btn btn-teal">--}}
{{--                                    <i class="la la-eye"></i> @lang('labels.print_preview')--}}
{{--                                </a>--}}
{{--                                <a target="_blank" href="{{ route('ng-evaluated-acr.print', $ngAppraisalRequest->id) }}"--}}
{{--                                   class="btn btn-primary">--}}
{{--                                    <i class="la la-print"></i> @lang('labels.print')--}}
{{--                                </a>--}}

                                <button type="submit" name="action" value="Save" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> @lang('labels.save')
                                </button>
                                <a class="btn btn-warning mr-1" role="button"
                                   href="{{ route('ng-appraisal-request.index') }}">
                                    <i class="la la-chevron-left"></i> @lang('labels.go_back')
                                </a>
                            </div>
`
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
            rules: {},
            submitHandler: function (form, event) {
                form.submit();
            }
        });
    </script>
@endpush


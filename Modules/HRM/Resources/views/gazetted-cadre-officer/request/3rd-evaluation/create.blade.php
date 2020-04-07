@extends('hrm::layouts.master')
@section('title', 'Appraisal Request 1st Evaluation')

@section('content')
    <!-- Striped row layout section start -->
    <section id="striped-row-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">আবেদনকারীর তত্থ্য
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
                        <h4 class="card-title" id="striped-row-layout-basic">৩য় খন্ড (ব্যক্তিগত বৈশিষ্ট্য)</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                {{--                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                                {{--                                @if($ngAppraisalRequest->receiver->user->id === auth()->user()->id && $ngAppraisalRequest->is_evaluated)--}}
                                {{--                                    <a href="{{ route('ng-appraisal-request.first-evaluation-edit', $ngAppraisalRequest->id) }}" class="btn btn-primary btn-lg">--}}
                                {{--                                        <i class="la la-edit white"></i> @lang('labels.edit')--}}
                                {{--                                    </a>--}}
                                {{--                                @endif--}}
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
                            {!! Form::open(['route' =>  ['gco-appraisal-request.third-evaluation-store', $gcoAppraisalRequest->id],'class' => 'form appraisal-evaluation-form']) !!}
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-tag"></i>(অনুবেদনকারী পূরণ করিবেন) </h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label required">কমেন্ট করুন</label>
                                                <label class="radio-error" style="display:none;">Please choose
                                                    one.</label>
                                                @if ($errors->has('comment'))
                                                    <h6 class="text-danger"> যে কোনো একটি কমেন্ট করুন </h6>
                                                @endif
                                                <textarea name="comment" class="form-control required" rows="5"
                                                          data-msg-required="{{ trans('labels.This field is required')}}"></textarea>
                                            </div>
                                        </div>
                                        <h4 class="card-title" id="striped-row-layout-basic"> @lang('hrm::cadre_officer_info.six_part')</h4>
                                        <h4 class="form-section"><i class="ft-tag"></i> (অনুবেদনকারী পূরণ করিবেন) </h4>



                                        <div class="form-group">
                                            <label>@lang('hrm::cadre_officer_info.short_comment')</label><br>
                                            <label class="form-label required">@lang('hrm::cadre_officer_info.special_trends_qualifications')</label>
                                            <label class="radio-error" style="display:none;">Please choose one.</label>
                                            <div class="row skin skin-square">
                                                <div class="col-md-12 col-sm-12">
                                                    @foreach(trans('hrm::cadre_officer_info.special_qualifications_options') as $key => $value)
                                                        <input type="radio" name="special_qualifications_options"
                                                               class="form-control radio required" value="{{ $key }}"
                                                               data-msg-required="{{ trans('labels.This field is required')}}">
                                                        <label>{{ $value }}</label>
                                                    @endforeach
                                                    @if ($errors->has('special_qualifications_options'))
                                                        <h6 class="text-danger"> {{ trans('labels.This field is required')}} </h6>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('hrm::cadre_officer_info.honesty_reputation')</label><br>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">

                                                <label class="form-label required">@lang('hrm::cadre_officer_info.moral')</label>

                                                <input type="text" name="moral"  class="required" data-msg-required="{{ trans('labels.This field is required')}}">
                                                @if ($errors->has('moral'))
                                                    <h6 class="text-danger"> যে কোনো একটি বাছাই করুন </h6>
                                                @endif
                                            </div>
                                            <div class="col-md-3">

                                                <label class="form-label required">@lang('hrm::cadre_officer_info.intellectual')</label>
                                                <input type="text" name="intellectual" class="required" data-msg-required="{{ trans('labels.This field is required')}}">
                                                @if ($errors->has('intellectual'))
                                                    <h6 class="text-danger"> যে কোনো একটি বাছাই করুন </h6>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label required">@lang('hrm::cadre_officer_info.medical')</label>
                                                <input type="text" name="medical" class="required" data-msg-required="{{ trans('labels.This field is required')}}">
                                                @if ($errors->has('medical'))
                                                    <h6 class="text-danger"> যে কোনো একটি বাছাই করুন </h6>
                                                @endif
                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <br>
                                            <label class="form-label required">@lang('hrm::cadre_officer_info.further_recommendation')</label><br>
                                            <input type="text" name="further_recommendation"  class="required" data-msg-required="{{ trans('labels.This field is required')}}">
                                            @if ($errors->has('further_recommendation'))
                                                <h6 class="text-danger"> যে কোনো একটি বাছাই করুন </h6>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label required"> ২)  পদোন্নতির যোগ্যতা ( নিম্নের সঠিক সিদ্ধান্ত নির্বাচন করুন) ---- </label>
                                            <label class="radio-error" style="display:none;">Please choose one.</label>
                                            <div class="row skin skin-square radio">
                                                <div class="col-md-12 col-sm-12">
                                                    @foreach(trans('hrm::cadre_officer_info.final_decision') as $value => $decision)
                                                        <fieldset>
                                                            <input type="radio" name="final_decision"
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
                                        <div class="form-group">
                                            <label class="form-label">৩)   অন্যান্য সুপারিশ (যদি থাকে) ---</label>
                                            <label class="radio-error" style="display:none;">Please choose
                                                one.</label>
                                            @if ($errors->has('other_recommendation'))
                                                <h6 class="text-danger"> যে কোনো একটি কমেন্ট করুন </h6>
                                            @endif
                                            <textarea name="other_recommendation" class="form-control" rows="5"></textarea>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"></div>
                                        <div class="form-group {{ $errors->has('name') ? ' error' : '' }}">
                                            {!! Form::label('receiver_id',  trans('hrm::appraisal.signing_officer'), ['class' => 'form-label required']) !!}

                                            {!! Form::select('receiver_id', $reportingOfficers, null,
                                                [
                                                    'style'=> 'max-width: 100%',
                                                    'class'=>'form-control select required' . ($errors->has('receiver_id') ? ' is-invalid' : ''),
                                                    'data-msg-required' => trans('validation.required',
                                                    [
                                                        'attribute' => trans('ims::inventory.recipients.title')
                                                    ]),
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
                                @if($gcoAppraisalRequest->receiver->user->id === auth()->user()->id && $gcoAppraisalRequest->is_evaluated)
                                    <a href="{{ route('ng-appraisal-request.first-evaluation-edit', $gcoAppraisalRequest->id) }}"
                                       class="btn btn-primary">
                                        <i class="la la-edit white"></i> @lang('labels.edit')
                                    </a>
                                @endif
                                <button type="submit" class="btn btn-teal">
                                    <i class="la la-check-square-o"></i> @lang('labels.send')
                                </button>
                                <a class="btn btn-warning mr-1" role="button"
                                   href="{{ route('ng-appraisal-request.index') }}">
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

@extends('hrm::layouts.master')
@section('title', 'Appraisal Request 1st Evaluation')

@section('content')
    <!-- Striped row layout section start -->
    <section id="striped-row-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">আবেদনকারীর ব্যক্তিগত তত্থ্য
                            (@lang('labels.non-gazetted') @lang('labels.officer'))</h4>
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
                                @include('hrm::non-gazetted.request.partials.request-form-details')
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
                                @include('hrm::non-gazetted.request.partials.first-evaluation-details')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">৩য় খণ্ড ( প্রতিবেদনকারী অফিসার )</h4>
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
                            {!! Form::open(['route' =>  ['ng-appraisal-request.second-evaluation-store', $ngAppraisalRequest->id],'class' => 'form appraisal-evaluation-form']) !!}
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-tag"></i> সামগ্রিক মূল্যায়ন ও পদোন্নতির যোগ্যতা </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required"> সমশ্রেণীর অন্যান্য অফিসারের সঙ্গে
                                                তুলনাক্রমে নিন্মের সঠিক কলামে অনুস্বাক্ষর করিয়া এই অফিসার সম্পর্কে আপনার
                                                সাধারণ মূল্যায়ন লিপিবদ্ধ করুণঃ- </label>
                                            <label class="radio-error" style="display:none;">Please choose one.</label>
                                            <div class="row skin skin-square">
                                                <div class="col-md-12 col-sm-12">
                                                    @foreach(trans('hrm::appraisal.ng-rating-options') as $key => $value)
                                                        <input type="radio" name="summarized_rating"
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
                                            <label class="form-label required"> - নিম্নের সঠিক সিদ্ধান্ত নির্বাচন
                                                করুন </label>
                                            <label class="radio-error" style="display:none;">Please choose one.</label>
                                            <div class="row skin skin-square radio">
                                                <div class="col-md-12 col-sm-12">
                                                    @foreach(trans('hrm::appraisal.ng-final_decision') as $value => $decision)
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
                                @if($ngAppraisalRequest->receiver->user->id === auth()->user()->id && $ngAppraisalRequest->is_evaluated)
                                    <a href="{{ route('ng-appraisal-request.first-evaluation-edit', $ngAppraisalRequest->id) }}"
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

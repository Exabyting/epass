<div class="page-margin">
    <div class="row">
        <div class="col-12">
            <h4 class="text-center mt-2 m-0 p-0 pt-1"><b>গোপনীয়</b></h4>
            <p class="pb-0 ">বাংলাদেশ ফরম নং ২৯০-খ (সংশোধিত)</p>
            <p class="ml-5 lh-22">নন-গেজেটেড অফিসার/কর্মচারীদের জন্য বার্ষিক</p>
            <span class="lh-22">গোপন রিপোর্ট ফরম। </span>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="f-37 mb-0 mt-0">
                <b>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</b>
            </h1>
            <h5>
                অফিসের নাম : <span class="pl-1 pr-1">{{ get_address() }}</span>
            </h5>
            <h5 class="text-center mt-1">
                <span
                    class="border-bottom-dash w-140 d-inline-block">
                    {{ en2bn(date('d/m/Y',strtotime($ngAppraisalRequest->reporting_date_start))) }}
                </span>
                <span class="pl-1 pr-1">হইতে</span>
                <span class="border-bottom-dash w-140 d-inline-block">
                    {{ en2bn(date('d/m/Y',strtotime($ngAppraisalRequest->reporting_date_end))) }}
                </span>

                <span class="pl-1 pr-1">পর্যন্ত সময়ের বার্ষিক/বিশেষ প্রতিবেদন ।</span>
            </h5>
        </div>
        <div class="col-12 mt-2">
            <span class="position-absolute">অ</span>
            <ol class="list-group ml-4">
                <li>
                    <span class="serial"> ১।</span> <span class="label">  নাম (মোটা অক্ষরে)ঃ </span>
                    <span class="dots">
                        {{ $ngAppraisalRequest->requester->first_name }} {{ $ngAppraisalRequest->requester->last_name }}
                    </span>
                </li>
                <li>
                    <span class="serial">২।</span> <span class="label">পদবীঃ</span>
                    <span class="dots">{{ $ngAppraisalRequest->requester->designation->name }}</span></li>
                <li>
                    <span class="serial">৩।</span> <span class="label">জন্ম তারিখঃ </span>
                    <span class="dots">{{  en2bn($ngAppraisalRequest->birth_date) }}</span>
                </li>
                <li>
                    <span class="serial">৪।</span> <span class="label">বর্তমান বেতন ও বেতনক্রমঃ  </span>
                    <span class="dots">{{ $ngAppraisalRequest->salary_scale }}</span>
                </li>
                <li>
                    <span class="serial">৫।</span> <span class="label">(ক) সরকারী চাকুরীতে যোগাদানের তারিখঃ</span>
                    <span class="dots">{{  en2bn($ngAppraisalRequest->joining_date_govt_job) }}</span>
                </li>
                <li>
                    <span class="serial "></span> <span class="label">(খ) বিভাগীয় পরীক্ষায় উত্তীর্ণ হইয়াছেন কি না, হইয়া থাকিলে তারিখঃ</span>
                    <span class="dots">
                        {{ $ngAppraisalRequest->is_divisional_exam_passed ?
                                config('constants.boolean.'.$ngAppraisalRequest->is_divisional_exam_passed).",  " :
                                config('constants.boolean.'.$ngAppraisalRequest->is_divisional_exam_passed) }}
                        {{ $ngAppraisalRequest->is_divisional_exam_passed ? "".
                        en2bn($ngAppraisalRequest->divisional_exam_passed_date) : "" }}
                    </span>
                </li>
                <li>
                    <span class="serial "></span>
                    <span class="label">(গ) চাকুরীতে প্রবেশক, অস্থায়ী  অথবা স্থায়ী কি নাঃ</span>
                    <span class="dots">{{ config('constants.job_state.'.$ngAppraisalRequest->job_state) }}</span>
                </li>
                <li>
                    <span class="serial">৬।</span> <span class="label">বর্তমান পদে যোগদানের তারিখঃ</span>
                    <span class="dots">{{  en2bn($ngAppraisalRequest->current_post_joining_date) }}</span>
                </li>
                <li>
                    <span class="serial">৬।</span> <span class="label">শিক্ষাগত যােগ্যতাঃ</span>
                    <span class="dots">{{ $ngAppraisalRequest->educational_qualifications }}</span>
                </li>
                <li>
                    <span class="serial">৮।</span> <span class="label">ভাষাজ্ঞানঃ</span>
                    <span class="dots">{{ $ngAppraisalRequest->languages }}</span>
                </li>
                <li>
                    <span class="serial">৯।</span> <span class="label">প্রশিক্ষণ/বিশেষ প্রশিক্ষণ (যদি থাকে)ঃ</span>
                    <span class="dots">{{ $ngAppraisalRequest->special_training  ?? '--' }}</span>
                </li>
                <li>
                    <span class="serial">১০।</span>
                    <span class="label">প্রতিবেদনকারী অফিসারের অধীনে চাকুরীর সঠিক মেয়াদঃ </span>
                    <span class="dots">
                        {{ en2bn($ngAppraisalRequest->reporting_job_period) }}
                    </span>
                    {{--                    <span class="border-bottom-dash w-140 d-inline-block">--}}
                    {{--                        {{ en2bn($ngAppraisalRequest->reporting_job_period) }}--}}
                    {{--                    </span>--}}
                </li>
            </ol>
            <hr class="mb-0 pb-1 mt-1">
            <p class="text-left pl-5">সঠিক ঘরে অনুস্বাক্ষর দ্বারা মূল্যায়ন লিপিবদ্ধ করিতে হইবে। অক্ষর দ্বারা যে
                মূল্যায়ন প্রকাশ করা হইল তাহা এইরূপঃ</p>
            <p class="special-font pl-2">ক ১ <span>=</span>অতি উত্তম, ‘ক’<span>=</span>উত্তম, ‘খ’<span>=</span>চলতিমান,
                ‘গ’<span>=</span>চলতিমানের নিম্নে এবং ‘ঘ’<span>=</span>সন্তোষজনক নহে।</p>
            <hr class="mb-0 mt-0">
        </div>
        <div class="col-12 mt-1">
            <table class="table table-bordered mullayon-table">
                <thead>
                <tr class="text-center">
                    <th scope="col" colspan="6"></th>
                    <th scope="col">ক১</th>
                    <th scope="col">ক</th>
                    <th scope="col">খ</th>
                    <th scope="col">গ</th>
                    <th scope="col">ঘ</th>
                    <th scope="col">মন্তব্য</th>
                </tr>
                </thead>
                <tbody>
                @foreach($primaryTable as $primaryData)
                    <tr>
                        @php
                            $ko = strpos($primaryData['position'], '(ক)');
                            $kho = strpos($primaryData['position'], '(খ)');
                        @endphp

                        @if($ko !== false)
                            <td colspan="6" class="sub-group"><span
                                    class="pl-5 d-inline-block">(ক)</span> {{ $primaryData['question'] }}</td>
                        @elseif($kho !== false)
                            <td colspan="6" class="sub-group"><span
                                    class="pl-5 d-inline-block">(খ)</span> {{ $primaryData['question'] }}</td>
                        @else
                            <td colspan="6">
                                @if ($loop->iteration == 1)
                                    আ <span class='pl-1'> {{ $primaryData['position'] }}।</span>
                                @else
                                    <span class="pl-4"> {{ $primaryData['position'] }}।</span>
                                @endif
                                {{ $primaryData['question'] }}
                            </td>
                        @endif
                        @foreach(trans('hrm::appraisal.rating-options') as $ratingOp => $value)
                            @if($ratingOp == $primaryData['answer'])
                                <td>
                                    <img
                                        src="{{ url('file/get?filePath=' . $ngAppraisalRequest->receiver->signature) }}"
                                        alt="signature"
                                        class="signature"/>

                                </td>
                            @else
                                <td></td>
                            @endif
                        @endforeach
                        <td><small>{{ $primaryData['comment'] }}</small></td>
                    </tr>
                @endforeach
                @foreach($specialTable as $specialData)
                    <tr>
                        <td colspan="6"><span class="pl-4">
                            {!! $specialData['position'] !!}|
                        {{ $specialData['question'] }}</span></td>
                        @foreach(trans('hrm::appraisal.rating-options') as $ratingOp => $value)
                            @if($ratingOp == $specialData['answer'])
                                <td>
                                    <img
                                        src="{{ url('file/get?filePath=' . $ngAppraisalRequest->receiver->signature) }}"
                                        class="signature" alt="signature"/>
                                </td>
                            @else
                                <td></td>
                            @endif
                        @endforeach
                        <td><small>{{ $specialData['comment'] }}</small></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Page number one End -->

    <div class="pagebreak"></div>

    <div class="page-margin mt-5 pt-0">
        <div class="row">
            <div class="col-12">
                <p class="pl-2"><span class="pr-4"> ই </span> <b>সামগ্রিক মূল্যায়ন ও পদোন্নতির যােগ্যতাঃ</b>
                    <span><!-- Text --></span>
                </p>
                <p class="pl-5 lh-10 pt-0">(একটি বাদে অন্যগুলি কাটিয়া দিন)</p>
                <p class="pl-5 lh-10 pt-2"><span class="mr-3">১। </span>
                    @foreach(trans('hrm::appraisal.ng-rating-options') as $ratingOp => $value)
                        @if($ratingOp == $ngAppraisalRequest->summarizedEvaluation->summarized_rating)
                            {{$value}}
                        @else
                            <strike> {{ $value }} </strike>
                        @endif
                        {{  $loop->iteration < $loop->count ? " / ":" । "}}
                    @endforeach
                </p>
                <p class="pl-5 lh-10 pt-1"><span class="mr-3">২। </span>
                    @foreach(trans('hrm::appraisal.ng-final_decision') as $ratingOp => $value)
                        @if($ratingOp == $ngAppraisalRequest->summarizedEvaluation->summarized_rating)
                            {{$value}}
                        @else
                            <strike> {{ $value }} </strike>
                        @endif
                        {{  $loop->iteration < $loop->count ? " / ":" । "}}
                    @endforeach
                </p>

                <p class="text-right mt-0">
                    <span class="signature-img-big">
                     <img src="{{ url('file/get?filePath=' . $ngAppraisalRequest->receiver->signature) }}"
                          alt="signature" class="">
                    </span>
                    <b>প্রতিবেদনকারী অফিসারের স্বাক্ষর।</b>
                </p>
                <p class="text-left mt-0 pt-1">
                    তারিখঃ {{ en2bn(date('d-m-Y', strtotime($ngAppraisalRequest->summarizedEvaluation->created_at))) }}</p>
                <p class="pl-2  mt-3"><span class="pr-4"> ঈ </span> <b>প্রতিস্বাক্ষরকারী অফিসারের মতব্যঃ</b>
                </p>
                <p class="pl-5 pt-1 min-h-160">(ক) আমি মনে করি যে, প্রতিবেদনকারী অফিসারের মূল্যায়নঃ
                    @if($ngAppraisalRequest->action)
                        @foreach(trans('hrm::appraisal.action-rating-options') as $key => $value)
                            @if($key === $ngAppraisalRequest->action->rating)
                                {{ $value }}
                            @else
                                <strike> {{ $value }} </strike>
                            @endif
                            {{  $loop->iteration < $loop->count ? " / ":" । "}}
                        @endforeach
                    @endif
                    অধিকন্তু নিম্নে আমার মন্তব্য যােগ করিতেছিঃ <br>
                    @if($ngAppraisalRequest->action)
                        {{ $ngAppraisalRequest->action->comment }}
                    @endif

                </p>
                <p class="text-right mt-0">
                     <span class="signature-img-big">
                     <img src="{{ url('file/get?filePath=' . $ngAppraisalRequest->action->actor->signature) }}"
                          alt="signature" class="">
                    </span>
                    <b>প্রতিস্বাক্ষরকারী অফিসারের স্বাক্ষর।</b>
                </p>
                <p class="text-left mt-0 pt-1">
                    তারিখঃ {{ en2bn(date('d-m-Y', strtotime($ngAppraisalRequest->action->created_at))) }}</p>
            </div>
        </div>

    </div>

</div>
@include('hrm::non-gazetted.print.final-print-page')
<div class="pagebreak"></div>

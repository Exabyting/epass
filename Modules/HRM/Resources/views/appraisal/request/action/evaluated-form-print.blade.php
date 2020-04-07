<!Doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $appraisalRequest->requester->first_name }} {{ $appraisalRequest->requester->last_name }}
        - {{ date('d M, Y', strtotime($appraisalRequest->reporting_date_start)) }}
        - {{ date('d M, Y', strtotime($appraisalRequest->reporting_date_end)) }} - ACR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <script async src="{{ asset('print/plugins/fontawesome-free-5.7.2/js/all.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('print/plugins/bootstrap-4.3.1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('print/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('print/css/style.css') }}">
</head>
<body onload="window.print()" onafterprint="closeWindow()">
<script type="text/javascript">
    function closeWindow() {
        window.close();
    }
</script>

<div class="container print-as-pages p-0">
    <div class="page-margin">
        <div class="row">
            <div class="col-12">
                <p class="pb-0">বাংলাদেশ ফরম নং ২৯০-ক </p>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <p class="border-bottom">গেজেটেড কর্মচারীদের জন্য</p><br>
                <span>গোপন রিপোর্ট ফরম। </span>
            </div>
            <div class="col-6 text-right">
                <div class="top-right-page-1 float-right">
                    <p class="pb-3 pt-1">চাকুরীর নাম (বর্তমান/ভূতপূর্ব)</p>
                    <p class="dots pb-0 mb-1"><span class="">{{ $appraisalRequest->job_name }}</span></p>
                    <p class="d-flex pl-1"><span>মান-ক্রম </span><span
                            class="dots">{{ en2bn($appraisalRequest->id) }}</span></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <br>
                <h1><b>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</b></h1>
                <h1>
                    {{ get_address() }}
                    <br>
                    <b>{{ copyright_link() }}</b>
                </h1>
                <br>
                <h1><b>{{ en2bn(date('d/m/Y',strtotime($appraisalRequest->reporting_date_start))) }}
                        হইতে {{ en2bn(date('d/m/Y',strtotime($appraisalRequest->reporting_date_end))) }} পর্যন্ত সময়ের
                        জন্য বার্ধিক/বিশেষ রিপোর্ট ।</b></h1>
                <h1 class="mb-2"><b>১ম খন্ড</b></h1>
            </div>
            <div class="col-12">
                <hr>
                <ol class="list-group">
                    <li>
                        <span class="serial">১</span><span class="label"> নাম (স্পষ্টাক্ষরে)</span> <span
                            class="dots">{{ $appraisalRequest->requester->first_name }} {{ $appraisalRequest->requester->last_name }}</span>
                    </li>
                    <li><span class="serial">২</span> <span class="label">পদবী</span>
                        <span class="dots">{{ $appraisalRequest->requester->designation->name }}</span></li>
                    <li><span class="serial">৩</span> <span class="label">শিক্ষাগত যোগ্যতা</span> <span
                            class="dots">{{ $appraisalRequest->educational_qualifications }}</span>
                    </li>
                    <li><span class="serial">৪</span> <span class="label">জন্ম তারিখ</span> <span
                            class="dots">{{ $appraisalRequest->birth_date }}</span>
                    </li>
                    <li><span class="serial">৫</span> <span class="label">মোট চাকুরীর মেয়াদ</span> <span
                            class="dots">{{ $appraisalRequest->total_job_period }}</span>
                    </li>
                    <li><span class="serial">৬</span> <span class="label">কোন কোন ভাষা জানেন</span> <span
                            class="dots">{{ $appraisalRequest->languages }}</span>
                    </li>
                    <li><span class="serial">৭</span> <span class="label">বিশেষ প্রশিক্ষণ</span>
                        <span class="dots">{{ $appraisalRequest->special_training }}</span>
                    </li>
                    <li><span class="serial">৮</span>
                        <span class="label">রিপোর্ট প্রদানকারী অফিসারের অধীনে চাকুরীর সঠিক মেয়াদ</span>
                        <span class="dots">{{ $appraisalRequest->reporting_job_period }}</span>
                    </li>
                </ol>
                <hr>
            </div>
            <div class="col-12">
                <h2 class="text-center pt-3 pb-3"><b>আলোচ্য সময় যে পদে বহাল ছিলেন</b></h2>
                <table class="table table-bordered table-one">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">পদ</th>
                        <th scope="col">সময়</th>
                        <th scope="col">বেতন ও বেতন স্কেল</th>
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
                    @for($i = 5; $i >= $appraisalRequest->jobHistories->count(); $i--)
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="text-center">অনুগ্রহপূর্বক এই ফরমের চতুর্থ পৃষ্ঠায় নির্দেশাবলী দেখুন</p>
            </div>
        </div>
        <!-- Page number one End -->

        <div class="pagebreak"></div>
    </div>

    <!-- Page number two start  -->
    <div class="page-margin">

        <div class="row">
            <div class="col-12 text-center">
                <h1 class="m-0">২</h1>
                <h1><b>২য় খন্ড</b></h1>
                <h2 class="page-title-1">
                    সঠিক কলাম বা বাক্সে অনুস্বাক্ষরের দ্বারা মূল্যায়ন লিপিবদ্ধ করিতে হইবে। <br>
                    অক্ষর দ্বারা যে মূল্যায়ন প্রকাশ করা হইল তাহা নিন্মরূপঃ-<br>
                    'ক-১ অত্যুত্তম, 'ক' উত্তম, 'খ' চলতি মান, 'গ' চলতি মানের নিচে 'ঘ' নিকৃষ্ট ।
                </h2>
            </div>
            <div class="col-12">
                <table class="table table-bordered table-two">
                    <thead>
                    <tr class="text-center">
                        <th scope="col"></th>
                        <th scope="col" colspan="3"></th>
                        <th scope="col" colspan="1">ক-১</th>
                        <th scope="col">ক</th>
                        <th scope="col">খ</th>
                        <th scope="col">গ</th>
                        <th scope="col">ঘ</th>
                        <th scope="col" colspan="3">মন্তব্য</th>
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
                                <th scope="row"></th>
                                <td colspan="3">(ক) {{ $primaryData['question'] }}</td>
                            @elseif($kho !== false)
                                <th scope="row"></th>
                                <td colspan="3">(খ) {{ $primaryData['question'] }}</td>
                            @else
                                <th scope="row">{{ $primaryData['position'] }}।</th>
                                <td colspan="3">{{ $primaryData['question'] }}</td>
                            @endif
                            @foreach(trans('hrm::appraisal.rating-options') as $ratingOp => $value)
                                @if($ratingOp == $primaryData['answer'])
                                    <td><img
                                            src="{{ url('file/get?filePath=' . $appraisalRequest->receiver->signature) }}"
                                            class="signature-img" alt=""></td>
                                @else
                                    <td></td>
                                @endif
                            @endforeach
                            <td colspan="3"><small>{{ $primaryData['comment'] }}</small></td>
                        </tr>
                    @endforeach
                    @foreach($specialTable as $specialData)
                        <tr>
                            <th scope="row">{!! str_replace('*','<sup>*</sup>', $specialData['position']) !!}|</th>
                            <td colspan="3">{{ $specialData['question'] }}</td>
                            @foreach(trans('hrm::appraisal.rating-options') as $ratingOp => $value)
                                @if($ratingOp == $specialData['answer'])
                                    <td><img
                                            src="{{ url('file/get?filePath=' . $appraisalRequest->receiver->signature) }}"
                                            class="signature-img" alt=""></td>
                                @else
                                    <td></td>
                                @endif
                            @endforeach
                            <td colspan="3"><small>{{ $specialData['comment'] }}</small></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                <table class="table table-bordered table-three">
                    <tbody>
                    @foreach($optionalTable as $optionalData)
                        <tr>
                            <th scope="row">{!! str_replace('*','<sup>*</sup>',$optionalData['position']) !!}|</th>
                            <td>{{ $optionalData['question'] }}</td>

                            <td><span>{{ $optionalData['optional_answer_1'] }}</span>
                                <div class="img">
                                    @if($optionalData['optional_answer_1'] == $optionalData['answer'])
                                        <img
                                            src="{{ url('file/get?filePath=' . $appraisalRequest->receiver->signature) }}"
                                            class="signature-img" alt="">
                                    @endif
                                </div>
                            </td>
                            <td><span>{{ $optionalData['optional_answer_2'] }}</span>
                                <div class="img">
                                    @if($optionalData['optional_answer_2'] == $optionalData['answer'])
                                        <img
                                            src="{{ url('file/get?filePath=' . $appraisalRequest->receiver->signature) }}"
                                            class="signature-img" alt="">
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 text-center cmt10">
                <p class="text-left footer-text d-inline-block m-auto">
                    * কেবলমাত্র প্রযোজ্য ক্ষেত্রেই অনুস্বাক্ষর করিতে হইবে। <br>
                    ** চতুর্থ পৃষ্ঠার ক-১ নির্দেশ হুষ্ব্য ।
                </p>
            </div>
        </div>
    </div>
    <!-- Page number two End -->
    <div class="pagebreak"></div>

    <!-- Page number Three start  -->
    <div class="page-margin">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="m-0">৩</h1>
                <h1><b>৩য় খন্ড</b></h1>
                <h3 class="text-left p-lineheight"><span class="d-inline-block pl-4 "></span>সমশ্রেণীর অন্যান্য অফিসারের
                    সঙ্গে তুলনাক্রমে নিন্মের সঠিক কলামে অনুসাক্ষর
                    করিয়া এই অফিসার সম্পর্কে আপনার সাধারণ মূল্যায়ন লিপিবদ্ধ করুণঃ- </h3>
            </div>
            <div class="col-12">
                <table class="table table-bordered table-four">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">অত্যুত্তম</th>
                        <th scope="col">উত্তম</th>
                        <th scope="col">চলতিমান</th>
                        <th scope="col">চলতিমানের নিম্নে</th>
                        <th scope="col">নিকৃষ্ট</th>
                        <th scope="col">বিশেষ প্রবণতা থাকিলে উহার উপর মন্তব্য যেমন :- সচিবালয়, প্রশাসন, বিচার বিভাগ,
                            উন্নয়ন বা কূটনীতি সম্পর্কিত কার্য।
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach(trans('hrm::appraisal.rating-options') as $ratingOp => $value)
                            @if($ratingOp == $appraisalRequest->summarizedEvaluation->summarized_rating)
                                <td><img src="{{ url('file/get?filePath=' . $appraisalRequest->receiver->signature) }}"
                                         class="signature-img" alt=""></td>
                            @else
                                <td></td>
                            @endif
                        @endforeach
                        <td><small>{{ $appraisalRequest->summarizedEvaluation->comment }}</small></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                <h2 class="text-center mb-3">
                    <b>পদোন্নতির যোগ্যতা</b>
                    <br> <small>(নিম্নের সঠিক বাক্সে অনুস্বাক্ষর করুন)</small>
                </h2>
                @foreach(trans('hrm::appraisal.final_decision') as $decision => $value)
                    <div class="row">
                        <div class="col-9">
                            <p> {{ $value }}</p>
                        </div>
                        <div class="col-3">
                            @if($decision == $appraisalRequest->summarizedEvaluation->final_decision)
                                <div class="img1">
                                    <img src="{{ url('file/get?filePath=' . $appraisalRequest->receiver->signature) }}"
                                         class="signature-img" alt="">
                                </div>
                            @else
                                <div class="img1 blank">
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-12">
                <hr>
                <p class="mt-1 text-center"><b>লেখচিত্র</b></p>
                <p class="mb-1 mt-0 p-lineheight mh-100">
                    {{--                        সম্প্রতি পদোন্নতির হইয়াছে, আরো পদোন্নতি সম্পর্কে মূল্যায়নের সময় হয় নাই এখনো পদোন্নতির যোগ্য নেহেন,--}}
                    {{--                        সম্প্রতি পদোন্নতির হইয়াছে, আরো পদোন্নতি সম্পর্কে--}}
                    {{--                        সম্প্রতি পদোন্নতির হইয়াছে, আরো পদোন্নতি সম্পর্কে মূল্যায়নের সময় হয় নাই এখনো পদোন্নতির যোগ্য নেহেন,--}}
                    {{--                        আরো পদোন্নতির অযোগ্য, সর্বোচ্চ সীমায় পৌঁছিয়েছেন--}}
                </p>
            </div>

        </div>
        <div class="row align-items-end">
            <div class="col-7">
                <p>তারিখ {{ en2bn(date('d-m-Y', strtotime($appraisalRequest->summarizedEvaluation->created_at))) }}</p>
            </div>
            <div class="col-5 text-right">
                <p class="text-center d-inline-block">
                    <img src="{{ url('file/get?filePath=' . $appraisalRequest->receiver->signature) }}"
                         class="signature-img m-auto" alt="">
                    <br>
                    * রিপোর্ট প্রদানকারী অফিসারের স্বাক্ষর
                </p>

            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <h1><b>৪র্থ খন্ড</b></h1>
                <h2><b>প্রতিস্বাক্ষরকারী অফিসার মন্তব্য</b></h2>

                <p class="text-left p-lineheight">
                    <span class="d-inline-block pl-4 "></span>আমি মনে করি যে, রিপোর্ট প্রদানকারী অফিসারের মূল্যায়ন
                    অত্যুত্তম/যুক্তি সংগতভাবে উত্তম/কঠোর/নমনীয়/পক্ষপাতদুষ্ট অধিক নঙ্সম আমার মন্তব্য যোগ করিতেছিঃ
                </p>
                <p class=" mt-2 p-lineheight text-left mh-100">
                </p>
            </div>
        </div>
        <div class="row  align-items-end">
            <div class="col-7">
                <p>তারিখ </p>
            </div>
            <div class="col-5 text-right">
                <p class="text-center d-inline-block">
                    <br>
                    <span class="border-top lineheight-098">*স্বাক্ষর</span>
                </p>

            </div>
            <div class="col-12">
                <hr>
                <p class="p-lineheight">*স্বাক্ষরের নীচে রিপোর্ট প্রদানকারী/প্রতিস্বাক্ষরকারী অফিসারের নাম ও পদবী টাইপ
                    করিতে বা
                    স্পষ্টাক্ষরে লিখিতে হইবে কিংবা রাবার স্ট্যাম্পের ছাপ রাখিতে হইবে৷
                </p>
                <p class="mt-1">+অপ্রযোজ্য মূল্যায়ন অংশগুলি কাটিয়া দিন।</p>
            </div>
        </div>
    </div>
    <!-- Page number Three End -->

    <div class="pagebreak"></div>
    <!-- Page number Four start  -->
    <div class="img-four" style="margin-top: 5px;">
        <img src="{{ asset('files/acr-pdf-four-page.jpg') }}" class="img-fluid" alt="acr-pdf-four-page">
    </div>

    <!-- Page number Four End -->

</div>
</body>
</html>

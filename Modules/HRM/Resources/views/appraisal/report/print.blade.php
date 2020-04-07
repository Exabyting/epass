<!Doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $appraisalReport->requester->first_name }} {{ $appraisalReport->requester->last_name }}
        - {{ date('d M, Y', strtotime($appraisalReport->reporting_date_start)) }}
        - {{ date('d M, Y', strtotime($appraisalReport->reporting_date_end)) }} - ACR</title>
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
                    <p class="dots pb-0 mb-1"><span class="">{{ $appraisalReport->job_name }}</span></p>
                    <p class="d-flex pl-1"><span>মান-ক্রম </span><span
                            class="dots">{{ en2bn($appraisalReport->id) }}</span></p>
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
                <h1><b>{{ en2bn(date('d/m/Y',strtotime($appraisalReport->reporting_date_start))) }}
                        হইতে {{ en2bn(date('d/m/Y',strtotime($appraisalReport->reporting_date_end))) }} পর্যন্ত সময়ের
                        জন্য বার্ধিক/বিশেষ রিপোর্ট ।</b></h1>
                <h1 class="mb-2"><b>১ম খন্ড</b></h1>
            </div>
            <div class="col-12">
                <hr>
                <ol class="list-group">
                    <li>
                        <span class="serial">১</span><span class="label"> নাম (স্পষ্টাক্ষরে)</span> <span
                            class="dots">{{ $appraisalReport->requester->first_name }} {{ $appraisalReport->requester->last_name }}</span>
                    </li>
                    <li><span class="serial">২</span> <span class="label">পদবী</span>
                        <span class="dots">{{ $appraisalReport->requester->designation->name }}</span></li>
                    <li><span class="serial">৩</span> <span class="label">শিক্ষাগত যোগ্যতা</span> <span
                            class="dots">{{ $appraisalReport->educational_qualifications }}</span>
                    </li>
                    <li><span class="serial">৪</span> <span class="label">জন্ম তারিখ</span> <span
                            class="dots">{{ $appraisalReport->birth_date }}</span>
                    </li>
                    <li><span class="serial">৫</span> <span class="label">মোট চাকুরীর মেয়াদ</span> <span
                            class="dots">{{ $appraisalReport->total_job_period }}</span>
                    </li>
                    <li><span class="serial">৬</span> <span class="label">কোন কোন ভাষা জানেন</span> <span
                            class="dots">{{ $appraisalReport->languages }}</span>
                    </li>
                    <li><span class="serial">৭</span> <span class="label">বিশেষ প্রশিক্ষণ</span>
                        <span class="dots">{{ $appraisalReport->special_training }}</span>
                    </li>
                    <li><span class="serial">৮</span>
                        <span class="label">রিপোর্ট প্রদানকারী অফিসারের অধীনে চাকুরীর সঠিক মেয়াদ</span>
                        <span class="dots">{{ $appraisalReport->reporting_job_period }}</span>
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
                    <tr>
                        <td>{{ $appraisalReport->job_history_designation }}</td>
                        <td>{{ $appraisalReport->job_history_duration }}</td>
                        <td>{{ $appraisalReport->job_history_salary_scale }}</td>
                    </tr>
                    @for($i = 0; $i <= 5 ; $i++)
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
                <p class="text-left">মন্তব্য - {{ $appraisalReport->job_history_comment }}</p>
            </div>
        </div>

    </div>


</div>
</body>
</html>

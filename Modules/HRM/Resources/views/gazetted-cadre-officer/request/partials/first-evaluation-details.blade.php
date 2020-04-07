<div class="col-md-12">
    {{--                                    <h4 class="form-section"><i class="ft-tag"></i> 1st Evaluation : Rating</h4>--}}
    <table class="table table-bordered">
        @foreach($primaryTable as $primaryData)
            <tr>
                <th width="50%">{{ $primaryData['position'] }}
                    | {{ $primaryData['question'] }}</th>
                <td>@lang('hrm::cadre_officer_info.gco-rating-options.' . $primaryData['answer'] )</td>
                <td><img
                        src="{{ url('file/get?filePath=' . $gcoAppraisalRequest->receiver->signature) }}"
                        width="50px" height="20px"></td>
            </tr>
        @endforeach
    </table>
</div>
<div class="col-md-12">
    <br>
    <div class="form-actions text-center"></div>
    <h4 class="card-title" id="striped-row-layout-basic"><i class="ft-tag"></i> ৪র্থ অংশ (কার্যসম্পাদন) </h4>
    <h4 class="card-title" id="striped-row-layout-basic">(অনুবেদনকারী পূরণ করিবেন)</h4>
    <table class="table table-bordered">
        @foreach($specialTable as $specialData)
            <tr>
                <th width="50%">{{ $specialData['position'] }}
                    | {{ $specialData['question'] }}</th>
                @if($specialData['answer'])
                    <td>@lang('hrm::cadre_officer_info.gco-rating-options.' . $specialData['answer'] )</td>
                    <td><img
                            src="{{ url('file/get?filePath=' . $gcoAppraisalRequest->receiver->signature) }}"
                            width="50px" height="20px"></td>
                @else
                    <td colspan="2"></td>
                @endif
            </tr>
        @endforeach
    </table>
</div>
<div class="col-md-12">
    <br>
    <div class="form-actions text-center"></div>
    <h4 class="card-title" id="striped-row-layout-basic"> <b>মোট প্রাপ্ত নম্বর --- </b></h4>
    <table class="table table-bordered">
            <tr>
                <td>অসাধারণ</td>
                <td>অত্যুত্তম</td>
                <td>উত্তম</td>
                <td>চলতি মান</td>
                <td>চলতি মানের চিত্র</td>
            </tr>
            <tr>
                <td>৯৫-১০০</td>
                <td>৮৫-৯৪</td>
                <td>৬১-৮৪</td>
                <td>৪১-৬০</td>
                <td>৪০ ও তদনিম্ন</td>
            </tr>
            <tr>
                <td>
                    @php

                    if((95 <= $totalRating) && ($totalRating <= 100)){
                    echo en2bn($totalRating);
                    }
                    @endphp
                </td>
                <td>
                    @php

                        if((85 <= $totalRating) && ($totalRating <= 94)){
                         echo en2bn($totalRating);
                        }
                    @endphp
                </td>
                <td>
                    @php

                        if((61 <= $totalRating) && ($totalRating <= 84)){
                         echo en2bn($totalRating);
                        }
                    @endphp
                </td>
                <td>
                    @php
                        if((41 <= $totalRating) && ($totalRating <= 60)){
                         echo en2bn($totalRating);
                        }
                    @endphp
                </td>
                <td>
                    @php
                        if(($totalRating <= 40)){
                         echo en2bn($totalRating);
                        }
                    @endphp
                </td>
            </tr>
    </table>
</div>
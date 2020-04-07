<div class="page-margin page_extra_fellUp_by_ministry">
    <br>
    <br>
    <div class="row">
        <div class="col-12 text-center">
            <h3 class="f-37 mb-0 mt-0">
                <b>মন্ত্রণালয়/বিভাগ কর্তৃক পূরণের জন্য</b>
            </h3>

        </div>
        <div class="col-12 mt-2">
            <br>
            <br>
            <ol class="list-group">
                <li>
                    <span class="serial">১</span> <span class="label">পূরণ করা ফরম প্রাপ্তির তারিখঃ </span>
                    <span class="value">{{ en2bn(optional(optional($appraisalRequest)->approval)->filled_up_date) }}</span>
                </li>
                <li>
                    <span class="serial">২</span> <span class="label">অস্বাভাবিক বিলম্বের কারণঃ</span>
                    <span class="value">{{ optional(optional($appraisalRequest)->approval)->cause_of_late }}</span>
                </li>
                <li class="min-h-550">
                    <span class="serial">৩</span> <span class="label">দরখাস্তের উপর কার্যক্রম (যদি থাকে): </span>
                    <span class="value">{{ optional(optional($appraisalRequest)->approval)->work_on_application }}</span>
                </li>
            </ol>
            <br>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="float-right mt-0 min-width-260">
                <div class="text-center mb-2">
                    <img src="{{ url('file/get?filePath=' . optional(optional($appraisalRequest->approval)->actor)->signature) }}"
                         alt="signature" class="signature">
                </div>
                <ul>
                    <li><span>দায়িত্বপ্রাপ্ত কর্মকর্তার স্বাক্ষর ও সীল</span></li>
                    <li class="border-bottom-dash">
                        <span class="t_label">নাম (স্পষ্টাক্ষরে)</span><span class="text">
                            {{ optional(optional($appraisalRequest->approval)->actor)->first_name}}
                            {{optional(optional($appraisalRequest->approval)->actor)->last_name }}
                        </span>
                    </li>
                    <li class="border-bottom-dash">
                        <span class="t_label">পদবী</span><span class="text">{{ optional(optional(optional($appraisalRequest->approval)->actor)->designation)->name}}</span>
                    </li>
                    <li class="border-bottom-dash">
                        <span class="t_label">পরিচিতি নং</span> <span class="text">{{ en2bn(optional(optional($appraisalRequest->approval)->actor)->employee_id)}}</span>
                    </li>
                    <li class="border-bottom-dash">
                        <span class="t_label">তারিখ</span><span class="text">{{ en2bn(date('d-m-Y', strtotime(optional(optional($appraisalRequest)->approval)->updated_at ))) }}</span>
                    </li>
                </ul>
            </div>

        </div>

    </div>
</div>

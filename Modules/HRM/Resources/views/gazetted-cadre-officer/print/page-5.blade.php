<svg width="595" height="842" viewBox="0 0 595 842" fill="none" xmlns="http://www.w3.org/2000/svg"
     xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Page 5">
        <rect id="Rectangle 1" width="595" height="842" fill="white"/>
        <g id="Header">
            <text id="PageNumber" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto"
                  font-size="12" letter-spacing="0em"><tspan x="293" y="32.1016">&#x9eb;</tspan></text>
            <path id="Vector 1" d="M595 40H0" stroke="black"/>
            <path id="Vector 2" d="M595 219H0" stroke="black"/>
        </g>
        <g id="poddonotirJoggota-ul">
            @php
                $incValue = 20;

            @endphp
            @foreach(trans('hrm::cadre_officer_info.final_decision_print') as $ratingOp => $value)

                @php
                    $addValue = $loop->index * $incValue
                @endphp

                @if($ratingOp == $gcoAppraisalRequest->summarizedEvaluation->final_decision)
                    <g id="li-{{ $loop->iteration }}">
                        <text id="text-{{ $loop->iteration }}" fill="black" xml:space="preserve"
                              style="white-space: pre" font-family="Roboto" font-size="12" letter-spacing="0em">
                            <tspan x="59" y="{{ 457 + $addValue}}">{{$value}}</tspan>
                        </text>
                    </g>
                @else
                    @php
                        $totalChar = strlen($value);
                    @endphp
                    <g id="li-{{ $loop->iteration }}">
                        <text id="text-{{ $loop->iteration }}" fill="black" xml:space="preserve"
                              style="white-space: pre" font-family="Roboto" font-size="12" letter-spacing="0em">
                            <tspan x="59" y="{{ 457 + $addValue}}">{{$value}}</tspan>
                        </text>
                        <line id="Line-{{ $loop->iteration }}" x1="78" y1="{{ 452.5 + $addValue}}" x2="{{ 78 + ($totalChar * 1.55) }}"
                              y2="{{ 452.5 + $addValue}}" stroke="black"/>
                    </g>
                @endif
                {{--                {{  $loop->iteration < $loop->count ? "  ":" । "}}--}}
            @endforeach

        </g>

        <g id="SectionTitle">
            <text fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="12"
                  letter-spacing="0em"><tspan x="227.057" y="262.785">(&#x985;&#x9a8;&#x9c1;&#x9ac;&#x9c7;&#x9a6;&#x9a8;&#x995;&#x9be;&#x9b0;&#x9c0; &#x9aa;&#x9c2;&#x9b0;&#x9a3; &#x995;&#x9b0;&#x9bf;&#x9ac;&#x9c7;&#x9a8;)
                </tspan></text>
            <text fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="14"
                  letter-spacing="0em"><tspan x="244.749" y="243.785">&#x9ec;&#x9b7;&#x9cd;&#x9a0; &#x985;&#x982;&#x9b6; (&#x9b8;&#x9c1;&#x9aa;&#x9be;&#x9b0;&#x9bf;&#x9b6;)&#10;
                </tspan></text>
        </g>
        <g id="SectionTitle_2">
            <text fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="12"
                  letter-spacing="0em"><tspan x="227.057" y="81.7852">(&#x985;&#x9a8;&#x9c1;&#x9ac;&#x9c7;&#x9a6;&#x9a8;&#x995;&#x9be;&#x9b0;&#x9c0; &#x9aa;&#x9c2;&#x9b0;&#x9a3; &#x995;&#x9b0;&#x9bf;&#x9ac;&#x9c7;&#x9a8;)
                </tspan></text>
            <text fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="14"
                  letter-spacing="0em"><tspan x="244.482" y="62.7852">&#x9eb;&#x9ae; &#x985;&#x982;&#x9b6; (&#x9b2;&#x9c7;&#x996;&#x99a;&#x9bf;&#x9a4;&#x9cd;&#x9b0;)&#10;</tspan></text>
        </g>
        <text id="BasicInfo" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto"
              font-size="12" letter-spacing="0em">
            @php
                $totalWords = count(explode(" ", $gcoAppraisalRequest->summarizedEvaluation->comment));
                $comments = explode(" ", $gcoAppraisalRequest->summarizedEvaluation->comment);
                $index = 0;
                $wordPerLine = 12;
                $lineCount = 0;
                $addValue = 15;

                $chunkComments = [];

                while ($totalWords >= 0) {

                    $start = $index;
                    if($totalWords >= $wordPerLine) {

                        $end = $start + $wordPerLine;
                    }else {
                        $end = $start + $totalWords;
                    }

                    $comment = array_slice($comments, $start, $wordPerLine);

                    $lineCount++;

                    $chunkComments[] = implode(" ", $comment);

                    $index += $wordPerLine;

                    $totalWords = $totalWords - $wordPerLine;
            }

            @endphp
            @for($i = 0; $i < count($chunkComments); $i++)
                <tspan x="38" y="{{  110.102 + ($addValue * $i) }}">{{ $chunkComments[$i] }} </tspan>
            @endfor
        </text>
        <text id="DetailsForm" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto"
              font-size="12" letter-spacing="0em">
            <tspan x="38" y="297.102">&#x9e7;) &#x9b8;&#x982;&#x995;&#x9cd;&#x9b7;&#x9bf;&#x9aa;&#x9cd;&#x9a4; &#x9ae;&#x9a8;&#x9cd;&#x9a4;&#x9ac;&#x9cd;&#x9af;&#x983;&#10;</tspan>
            <!-- Todo: sure it will be daynamic value -->
            <tspan x="38" y="317.102"> (&#x995;) &#x9ac;&#x9bf;&#x9b6;&#x9c7;&#x9b7; &#x9aa;&#x9cd;&#x9b0;&#x9ac;&#x9a3;&#x9a4;&#x9be;/&#x9af;&#x9cb;&#x997;&#x9cd;&#x9af;&#x9a4;&#x9be; (&#x9af;&#x9a5;&#x9be;&#x983; &#x9aa;&#x9cd;&#x9b0;&#x9b6;&#x9be;&#x9b8;&#x9a8;&#x9bf;&#x995;/&#x9a6;&#x9be;&#x9aa;&#x9cd;&#x9a4;&#x9b0;&#x9bf;&#x995;/&#x9ac;&#x9b9;&#x9bf;&#x9b0;&#x9be;&#x982;&#x997;&#x9a8;/&#x985;&#x9a8;&#x9cd;&#x9af;&#x9be;&#x9a8;&#x9cd;&#x9af;)&#10; @lang('hrm::cadre_officer_info.special_qualifications_options.' . $gcoAppraisalRequest->summarizedEvaluation->special_qualifications_options )</tspan>
            <tspan x="38" y="337.102"> (&#x996;) &#x9b8;&#x9a4;&#x9a4;&#x9be; &#x993; &#x9b8;&#x9c1;&#x9a8;&#x9be;&#x9ae;&#x983;                 (&#x9e7;) &#x9a8;&#x9c8;&#x9a4;&#x9bf;&#x995; ---&#10;
            </tspan>
            <tspan x="38" y="357.102">                                                (&#x9e8;) &#x9ac;&#x9c1;&#x9a6;&#x9cd;&#x9a7;&#x9bf;&#x9ac;&#x9c3;&#x9a4;&#x9cd;&#x9a4;&#x9bf;&#x995; ---&#10;
            </tspan>
            <tspan x="38" y="377.102">                                                (&#x9e9;) &#x9ac;&#x9c8;&#x9b7;&#x9df;&#x9bf;&#x995; ---&#10;</tspan>
            <tspan x="38" y="397.102"> (&#x997;) &#x99a;&#x9be;&#x995;&#x9c1;&#x9b0;&#x9c0;&#x995;&#x9be;&#x9b2;&#x9c0;&#x9a8; &#x9aa;&#x9cd;&#x9b0;&#x9b6;&#x9bf;&#x995;&#x9cd;&#x9b7;&#x9a3;&#x9c7;&#x9b0; &#x99c;&#x9a8;&#x9cd;&#x9af; &#x986;&#x9b0;&#x993; &#x9b8;&#x9c1;&#x9aa;&#x9be;&#x9b0;&#x9bf;&#x9b6; ---&#10;
            </tspan>
            <tspan x="38" y="417.102">&#10;</tspan>
            <tspan x="38" y="437.102">&#x9e8;) &#x9aa;&#x9a6;&#x9cb;&#x9a8;&#x9cd;&#x9a8;&#x9a4;&#x9bf;&#x9b0; &#x9af;&#x9cb;&#x997;&#x9cd;&#x9af;&#x9a4;&#x9be; (&#x9aa;&#x9cd;&#x9b0;&#x9af;&#x9cb;&#x99c;&#x9cd;&#x9af;&#x99f;&#x9bf; &#x9b0;&#x9be;&#x996;&#x9bf;&#x9df;&#x9be; &#x9ac;&#x9be;&#x995;&#x9c0;&#x997;&#x9c1;&#x9b2;&#x9bf; &#x995;&#x9be;&#x99f;&#x9bf;&#x9df;&#x9be; &#x9a6;&#x9bf;&#x9ac;&#x9c7;&#x9a8;) ---
            </tspan></text>
        <text id="suparis" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto"
              font-size="12" letter-spacing="0em"><tspan x="39" y="558.102">&#x9e9;) &#x985;&#x9a8;&#x9cd;&#x9af;&#x9be;&#x9a8;&#x9cd;&#x9af; &#x9b8;&#x9c1;&#x9aa;&#x9be;&#x9b0;&#x9bf;&#x9b6; (&#x9af;&#x9a6;&#x9bf; &#x9a5;&#x9be;&#x995;&#x9c7;) ---
            </tspan></text>
        <text id="Name and signature" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto"
              font-size="12" letter-spacing="0em"><tspan x="321" y="724.102">&#x985;&#x9a8;&#x9c1;&#x9ac;&#x9c7;&#x9a6;&#x9a8;&#x995;&#x9be;&#x9b0;&#x9c0;&#x9b0; &#x9b8;&#x9cd;&#x9ac;&#x9be;&#x995;&#x9cd;&#x9b7;&#x9b0; &#x993; &#x9b8;&#x9c0;&#x9b2;&#10;
            </tspan>
            <tspan x="321" y="744.102">&#x9a8;&#x9be;&#x9ae; (&#x9b8;&#x9cd;&#x9aa;&#x9b7;&#x9cd;&#x99f;&#x9df;&#x9be;&#x995;&#x9cd;&#x9b7;&#x9b0;&#x9c7;)  ..............................................&#10;
            </tspan>
            <tspan x="321" y="764.102">&#x9aa;&#x9a6;&#x9ac;&#x9c0; ................................................................&#10;
            </tspan>
            <tspan x="321" y="784.102">&#x9aa;&#x9b0;&#x9bf;&#x99a;&#x9bf;&#x9a4;&#x9bf; &#x9a8;&#x982; .......................................................&#10;
            </tspan>
            <tspan x="321" y="804.102">&#x9a4;&#x9be;&#x9b0;&#x9bf;&#x996; ...............................................................
            </tspan></text>
        <g id="partSix">
            <text id="UpgradeRankRequestDeatils" fill="black" xml:space="preserve" style="white-space: pre"
                  font-family="Roboto" font-size="12" letter-spacing="0em">
                {{--<tspan x="55"y="557.102">                                                    </tspan>--}}
                @php
                    $totalWords = count(explode(" ", $gcoAppraisalRequest->summarizedEvaluation->further_recommendation));
                    $comments = explode(" ", $gcoAppraisalRequest->summarizedEvaluation->further_recommendation);
                    $index = 0;
                    $wordPerLine = 12;
                    $lineCount = 0;
                    $addValue = 20;

                    $chunkComments = [];

                    while ($totalWords >= 0) {

                        $start = $index;
                        if($totalWords >= $wordPerLine) {

                            $end = $start + $wordPerLine;
                        }else {
                            $end = $start + $totalWords;
                        }

                        $comment = array_slice($comments, $start, $wordPerLine);

                        $lineCount++;

                        $chunkComments[] = implode(" ", $comment);

                        $index += $wordPerLine;

                        $totalWords = $totalWords - $wordPerLine;
                }

                @endphp
                @for($i = 0; $i < count($chunkComments); $i++)
                    <tspan x="59.1484" y="{{  577.102 + ($addValue * $i) }}">{{ $chunkComments[$i] }} </tspan>
                @endfor
               {{-- <tspan x="59.1484" y="577.102"> {{$gcoAppraisalRequest->summarizedEvaluation->further_recommendation }}</tspan>
                <tspan x="55" y="597.102"></tspan>--}}
            </text>
            <text id="RankUpgradeRequest" fill="black" xml:space="preserve" style="white-space: pre"
                  font-family="Roboto" font-size="12" letter-spacing="0em">
                <tspan x="300" y="397.102">{{ 'পদোন্নতি দেওয়ার  যোগ্য' }}</tspan></text>
            <text id="boishik" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto"
                  font-size="12" letter-spacing="0em">
                <tspan x="276" y="377.102">{{ 'Good' }}</tspan></text>
            <text id="buddiBithi" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto"
                  font-size="12" letter-spacing="0em">
                <tspan x="276" y="357.102">{{ $gcoAppraisalRequest->summarizedEvaluation->intellectual }}</tspan></text>
            <text id="notik" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto"
                  font-size="12" letter-spacing="0em">
                <tspan x="276" y="337.102">{{$gcoAppraisalRequest->summarizedEvaluation->moral }}</tspan></text>
        </g>
        <g id="signature">
            <text id="Name" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto"
                  font-size="12" letter-spacing="0em">
                <tspan x="418.148"
                       y="739.102">{{ $gcoAppraisalRequest->receiver->first_name }} {{ $gcoAppraisalRequest->receiver->last_name }}</tspan></text>
            <text id="podobi" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto"
                  font-size="12" letter-spacing="0em">
                <tspan x="414" y="759.102">{{ $gcoAppraisalRequest->receiver->designation->name }}</tspan></text>
            <text id="Date" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto"
                  font-size="12" letter-spacing="0em">
                <tspan x="414"
                       y="800.102">{{ en2bn( date(' d-m-Y ', strtotime($gcoAppraisalRequest->summarizedEvaluation->updated_at ))) }}</tspan></text>
            <text id="KnowNumber" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto"
                  font-size="12" letter-spacing="0em">
                <tspan x="414" y="780.102">{{ $gcoAppraisalRequest->receiver->employee_id  }}</tspan></text>
        </g>
        <image id="signature_2" x="367" y="661" width="79" height="41"
               xlink:href="{{ url('file/get?filePath=' . $gcoAppraisalRequest->receiver->signature) }}"/>
    </g>
</svg>


<svg width="595" height="842" viewBox="0 0 595 842" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Page-4">
        <rect id="Rectangle 1" width="595" height="842" fill="white"/>
        <g id="threePart">
            @php
                $incValue = 21;
            @endphp
            @foreach($primaryTable as $primaryData)

                @php
                    $addValue = $loop->index * $incValue
                @endphp

                <g id="2-{{ $loop->iteration }}">
                    <rect id="2{{ $loop->iteration }}" x="0.5" y="-0.5" width="516" height="21" transform="matrix(1 0 0 -1 38 {{ 154 + $addValue}})" fill="white" stroke="black"/>
                    <text id="title_text_{{ $loop->iteration }}" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em">
                        <tspan x="64" y="{{ 147 + $addValue }}">{{ $primaryData['position'] }} {{ $primaryData['question'] }}</tspan>
                    </text>
                    @if($primaryData['answer'] != null &&  $primaryData['answer'] > 0 && $primaryData['answer'] < 5 )
                        <image id="signature-2-0{{ $loop->iteration }}-{{$primaryData['answer']}}" x="{{560 - ($primaryData['answer']*50)}}" y="{{ 135 + $addValue }}" width="40" height="18"  xlink:href="{{ url('file/get?filePath=' . $gcoAppraisalRequest->receiver->signature) }}" />
                    @endif
                </g>
            @endforeach

            <g id="Header">
                <rect id="1" x="38.5" y="90.5" width="516" height="43" fill="white" stroke="black"/>
                <text id="mullayon-subject" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="64" y="114.418">&#x9ae;&#x9c2;&#x9b2;&#x9cd;&#x9af;&#x9be;&#x9df;&#x9a8;&#x9c7;&#x9b0; &#x9ac;&#x9bf;&#x9b7;&#x9df;</tspan></text>
                <path id="Vector 4" d="M355 90V407" stroke="black"/>
                <path id="Vector 5" d="M405 111V407" stroke="black"/>
                <path id="Vector 6" d="M455 111V407" stroke="black"/>
                <path id="Vector 7" d="M505 111V407" stroke="black"/>
                <g id="number">
                    <path id="Vector 3" d="M355 111H554.5" stroke="black"/>
                    <text id="get-number" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="437" y="104.418">&#x9aa;&#x9cd;&#x9b0;&#x9be;&#x9aa;&#x9cd;&#x9a4; &#x9ae;&#x9be;&#x9a8;</tspan></text>
                    <text id="get-number2" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="377" y="125.418">&#x9ea;</tspan></text>
                    <text id="get-number3" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="427" y="125.418">&#x9e9;</tspan></text>
                    <text id="get-number4" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="477" y="125.418">&#x9e8;</tspan></text>
                    <text id="get-number5" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="527" y="125.418">&#x9e7;</tspan></text>
                </g>
            </g>
        </g>
        <g id="fourthPart">
            @php
                $incValue2 = 21;
            @endphp
            @foreach($specialTable as $specialData)

                @php
                    $addValue2 = $loop->index * $incValue2
                @endphp

                <g id="3-{{ $loop->iteration }}">
                    <rect id="2_{{ $loop->iteration }}" x="0.5" y="-0.5" width="516" height="21" transform="matrix(1 0 0 -1 38 {{ 450 + $addValue2}})" fill="white" stroke="black"/>
                    <text id="title_text_4" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em">
                        <tspan x="64" y="{{ 443 + $addValue2 }}">{{ $specialData['position'] }} {{ $specialData['question'] }}</tspan>
                    </text>

                    @if($specialData['answer'] != null &&  $specialData['answer'] > 0 && $specialData['answer'] < 5 )
                        <image id="signature-3-0{{ $loop->iteration }}-{{$specialData['answer']}}" x="{{559 - ($specialData['answer']*50)}}" y="{{ 431 + $addValue2 }}" width="40" height="18"  xlink:href="{{ url('file/get?filePath=' . $gcoAppraisalRequest->receiver->signature) }}" />
                    @endif
                </g>
            @endforeach
            <g>
                <path id="Vector 4_2" d="M355 429V682" stroke="black"/>
                <path id="Vector 5_2" d="M405 429V682" stroke="black"/>
                <path id="Vector 6_2" d="M455 429V682" stroke="black"/>
                <path id="Vector 7_2" d="M505 429V681" stroke="black"/>
            </g>
        </g>
        <g id="numberShow">
            <g id="DaynamicValueNumber">
                <rect id="2_5" x="0.5" y="-0.5" width="276" height="21" transform="matrix(1 0 0 -1 278 755)" fill="white" stroke="black"/>
                @if((95 <= $totalRating) && ($totalRating <= 100))
                    <text id="100" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="12" letter-spacing="0em">
                        <tspan x="295" y="749">{{ en2bn($totalRating) }}</tspan>
                    </text>
                @endif
                @if((85 <= $totalRating) && ($totalRating <= 94))
                    <text id="85" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="12" letter-spacing="0em">
                        <tspan x="345" y="749">{{ en2bn($totalRating) }}</tspan>
                    </text>
                @endif
                @if((61 <= $totalRating) && ($totalRating <= 84))
                    <text id="65" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="12" letter-spacing="0em">
                        <tspan x="395" y="749">{{ en2bn($totalRating) }}</tspan>
                    </text>
                @endif
                @if((41 <= $totalRating) && ($totalRating <= 60))
                    <text id="45" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="12" letter-spacing="0em">
                        <tspan x="445" y="749">{{ en2bn($totalRating) }}</tspan>
                    </text>
                @endif
                @if($totalRating <= 40)
                    <text id="35" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="12" letter-spacing="0em">
                        <tspan x="510" y="749">{{ en2bn($totalRating) }}</tspan>
                    </text>
                @endif
            </g>
            <g id="fixedValueNumber">
                <rect id="line-0" x="0.5" y="-0.5" width="276" height="21" transform="matrix(1 0 0 -1 278 734)" fill="white" stroke="black"/>
                <text id="95+" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="286.323" y="726.418">&#x9ef;&#x9eb;-&#x9e7;&#x9e6;&#x9e6;</tspan></text>
                <text id="85+" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="338.282" y="726.418">&#x9ee;&#x9eb;-&#x9ef;&#x9ea;</tspan></text>
                <text id="60+" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="389.282" y="726.418">&#x9ec;&#x9e7;-&#x9ee;&#x9ea;</tspan></text>
                <text id="40+" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="439.282" y="726.418">&#x9ea;&#x9e7;-&#x9ec;&#x9e6;</tspan></text>
                <text id="40--" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="489.47" y="726.418">&#x9ea;&#x9e6; &#x993; &#x9a4;&#x9a6;&#x9a8;&#x9bf;&#x9ae;&#x9cd;&#x9a8;</tspan></text>
            </g>
            <g id="fixedValueText">
                <rect id="2_6" x="0.5" y="-0.5" width="276" height="21" transform="matrix(1 0 0 -1 278 713)" fill="white" stroke="black"/>
                <text id="vt-0" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="283.415" y="707.418">&#x985;&#x9b8;&#x9be;&#x9a7;&#x9be;&#x9b0;&#x9a3;</tspan></text>
                <text id="vt-1" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="336.004" y="707.418">&#x985;&#x9a4;&#x9cd;&#x9af;&#x9c1;&#x9a4;&#x9cd;&#x9a4;&#x9ae;</tspan></text>
                <text id="vt-2" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="392.217" y="707.418">&#x989;&#x9a4;&#x9cd;&#x9a4;&#x9ae;</tspan></text>
                <text id="vt-3" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="432.446" y="707.418">&#x99a;&#x9b2;&#x9a4;&#x9bf; &#x9ae;&#x9be;&#x9a8;</tspan></text>
                <text id="vt-4" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="482.26" y="707.418">&#x99a;&#x9b2;&#x9a4;&#x9bf; &#x9ae;&#x9be;&#x9a8;&#x9c7;&#x9b0; &#x99a;&#x9bf;&#x9a4;&#x9cd;&#x9b0;</tspan></text>
            </g>
            <path id="Vector 4_3" d="M327 692V756" stroke="black"/>
            <path id="Vector 5_3" d="M377 692V756" stroke="black"/>
            <path id="Vector 6_3" d="M427 692V756" stroke="black"/>
            <path id="Vector 7_3" d="M477 692V756" stroke="black"/>
            <text id="Total number" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="10" letter-spacing="0em"><tspan x="192.794" y="727.418">&#x9ae;&#x9cb;&#x99f; &#x9aa;&#x9cd;&#x9b0;&#x9be;&#x9aa;&#x9cd;&#x9a4; &#x9a8;&#x9ae;&#x9cd;&#x9ac;&#x9b0; ---</tspan></text>
        </g>
        <g id="userSignature">
            <text id="name" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="12" letter-spacing="0em">
                <tspan x="402.148" y="770.102">{{ $gcoAppraisalRequest->receiver->first_name }} {{ $gcoAppraisalRequest->receiver->last_name }}</tspan>
            </text>
            <image id="signature-final"  x="422" y="775" width="60" height="30"  xlink:href="{{ url('file/get?filePath=' . $gcoAppraisalRequest->receiver->signature) }}" />
        </g>
        <text id="4thPart__" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="14" letter-spacing="0em"><tspan x="231" y="421.785">&#x9ea;&#x9b0;&#x9cd;&#x9a5; &#x985;&#x982;&#x9b6; (&#x995;&#x9be;&#x9b0;&#x9cd;&#x9af;&#x9b8;&#x9ae;&#x9cd;&#x9aa;&#x9be;&#x9a6;&#x9a8;)</tspan></text>
        <g id="Footer">
            <text id="Signature" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="12" letter-spacing="0em"><tspan x="369.072" y="824.102">&#x985;&#x9a8;&#x9c1;&#x9ac;&#x9c7;&#x9a6;&#x9a8;&#x995;&#x9be;&#x9b0;&#x9c0; &#x995;&#x9b0;&#x9cd;&#x9ae;&#x995;&#x9b0;&#x9cd;&#x9a4;&#x9be;&#x9b0; &#x9b8;&#x9cd;&#x9ac;&#x9be;&#x995;&#x9cd;&#x9b7;&#x9b0; &#x993; &#x9b8;&#x9c0;&#x9b2;</tspan></text>
            <text id="dots" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="12" letter-spacing="0em"><tspan x="368.16" y="804.102">...........................................................</tspan></text>
        </g>
        <g id="Header_2">
            <text id="PageNumber" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="12" letter-spacing="0em"><tspan x="293" y="32.1016">&#x9ea;</tspan></text>
            <text id="SectionTitle" fill="black" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="14" letter-spacing="0em"><tspan x="127.012" y="52.7852">&#x9e9;&#x9df; &#x993; &#x9ea;&#x9b0;&#x9cd;&#x9a5; (&#x985;&#x982;&#x9b6; &#x985;&#x9a8;&#x9c1;&#x9ac;&#x9c7;&#x9a6;&#x9a8;&#x995;&#x9be;&#x9b0;&#x9c0; &#x985;&#x9a8;&#x9c1;&#x9b8;&#x9cd;&#x9ac;&#x9be;&#x995;&#x9cd;&#x9b7;&#x9b0; &#x9a6;&#x9cd;&#x9ac;&#x9be;&#x9b0;&#x9be; &#x9aa;&#x9c2;&#x9b0;&#x9a3; &#x995;&#x9b0;&#x9bf;&#x9ac;&#x9c7;&#x9a8;)&#10;</tspan><tspan x="222.175" y="74.7852">&#x9e9;&#x9df; &#x985;&#x982;&#x9b6; (&#x9ac;&#x9cd;&#x9af;&#x995;&#x9cd;&#x9a4;&#x9bf;&#x997;&#x9a4; &#x9ac;&#x9c8;&#x9b6;&#x9bf;&#x9b7;&#x9cd;&#x99f;&#x9cd;&#x9af;)</tspan></text>
        </g>
    </g>
</svg>

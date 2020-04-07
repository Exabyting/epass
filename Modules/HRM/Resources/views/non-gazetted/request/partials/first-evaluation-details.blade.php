<div class="col-md-6">
    {{--                                    <h4 class="form-section"><i class="ft-tag"></i> 1st Evaluation : Rating</h4>--}}
    <table class="table table-bordered">
        @foreach($primaryTable as $primaryData)
            <tr>
                <th width="50%">{{ $primaryData['position'] }}
                    | {{ $primaryData['question'] }}</th>
                <td>@lang('hrm::appraisal.rating-options.' . $primaryData['answer'] )</td>
                <td><img
                        src="{{ url('file/get?filePath=' . $ngAppraisalRequest->receiver->signature) }}"
                        width="50px" height="20px"></td>
            </tr>
        @endforeach
    </table>
</div>
<div class="col-md-6">
    <table class="table table-bordered">
        @foreach($specialTable as $specialData)
            <tr>
                <th width="50%">{{ $specialData['position'] }}
                    | {{ $specialData['question'] }}</th>
                @if($specialData['answer'])
                    <td>@lang('hrm::appraisal.rating-options.' . $specialData['answer'] )</td>
                    <td><img
                            src="{{ url('file/get?filePath=' . $ngAppraisalRequest->receiver->signature) }}"
                            width="50px" height="20px"></td>
                @else
                    <td colspan="2"></td>
                @endif
            </tr>
        @endforeach
    </table>
</div>

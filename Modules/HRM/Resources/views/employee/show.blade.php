@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.employee_details'))


@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" id="basic-layout-form">@lang('hrm::employee.employee_details')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
{{--                <ul class="list-inline mb-0">--}}
{{--                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>--}}
{{--                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>--}}
{{--                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
                    {{--<li><a data-action="close"><i class="ft-x"></i></a></li>--}}
{{--                </ul>--}}
            </div>
        </div>
        <div class="card-content collapse show" style="">
            <div class="card-body">

                <div class="tab-content ">
                    {{--employee general information--}}
                    <div class="tab-pane active show" role="tabpanel" id="general" aria-labelledby="general-tab"
                         aria-expanded="true">
                        @include('hrm::employee.details')
                    </div>
                </div>
            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body">


            </div>
        </div>
    </div>

@endsection

@push('page-js')
<script>
    $(document).ready(function () {
        var url = document.URL;
        var hash = url.substring(url.indexOf('#'));

        $(".nav-tabs").find("li a").each(function (key, val) {
            if (hash == $(val).attr('href')) {
                $(val).click();
            }

            $(val).click(function (ky, vl) {
                location.hash = $(this).attr('href');
            });
        });

    })
</script>
@endpush

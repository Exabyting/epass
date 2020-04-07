<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="BARD ERP Solution.">
    <meta name="keywords"
    content="BARD ERP Solution">
    <meta name="author" content="Brain Station - 23 & Inflack Limited.">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- title -->
    <title>{{ trans('labels.' . config('app.name', 'Laravel')) }}</title>

    <link rel="apple-touch-icon" href="{{ asset('theme/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
          rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
          rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/app.css') }}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/cryptocoins/cryptocoins.css') }}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style.css') }}">
    <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-menu" data-col="2-columns">
<!-- fixed-top-->
@include('layouts.partials.fixed_top')
<!-- ////////////////////////////////////////////////////////////////////////////-->
{{--@include('layouts.partials.menu')--}}
{{--<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">

        </div>
    </div>
</div>--}}
<div class="container">
    <div id="crypto-stats-3" class="row" style="margin-top: 32px">
        @foreach($modules as $module)
        @can(strtolower($module).'-access')
            <div class="col-xl-4 col-12">
                <div class="card crypto-card-3 pull-up">
                    <div class="card-content">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-2">
                                    <h1><i class="ft-grid warning font-large-2" title="BTC"></i></h1>
                                </div>
                                <div class="col-8 pl-2">
                                    <h4>{{ trans('labels.' . $module) }}</h4>
                                    <h6 class="text-muted"><a href="{{url(strtolower($module)).'/'}}">{{ trans('labels.' . $module) }}</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        @endforeach
        <div class="col-xl-4 col-12" style="display: none;">
            <div class="card crypto-card-3 pull-up">
                <div class="card-content">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-2">
                                <h1><i class="ft-stop-circle warning font-large-2" title="BTC"></i></h1>
                            </div>
                            <div class="col-5 pl-2">
                                <h4>{{ trans('labels.Admin') }}</h4>
                                <h6 class="text-muted"><a href="{{url('system/user')}}">{{ trans('labels.Administration') }}</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
{{--@include('layouts.partials.footer')--}}
<!-- BEGIN VENDOR JS-->
<script src="{{ asset('theme/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
{{--<script src="{{ asset('theme/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('theme/vcendors/js/charts/echarts/echarts.js') }}" type="text/javascript"></script>--}}
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{ asset('theme/js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/moment-with-locales.min.js') }}" type="text/javascript"></script>
{{--<script src="{{ asset('theme/js/scripts/customizer.js') }}" type="text/javascript"></script>--}}
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
{{--<script src="{{ asset('theme/js/scripts/pages/dashboard-crypto.js') }}" type="text/javascript"></script>--}}
<!-- END PAGE LEVEL JS-->
@stack('page-js')
</body>
</html>

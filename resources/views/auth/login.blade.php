<!Doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{trans('labels.login')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="icon" href="{{ get_favicon_url() }}" type="image/gif">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">

    <style>
        /***** Custom fonts *****/
        @font-face {
            font-family: 'Ruposh_Bangla';
            font-weight: 400;
            src: url({{ asset('fonts/ruposh_bangla/ruposh_bangla.ttf') }}) format('truetype');
        }

        body {
            margin: 0;
            padding: 0;
        }

        #loginPage {
            margin: 0;
            padding: 0;
            font-size: 14px;
            font-family: 'Ruposh_Bangla', sans-serif;
            position: relative;
        }

        /***********css Animation*********/
        #loginPage .card {
            min-height: 450px;
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            max-width: 640px;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
            width: 100%;
            padding: 40px 120px;
        }

        #loginPage .min-vh-100 {
            min-height: 100vh;
        }

        #loginPage h2 {
            font-size: 30px;
            line-height: 36px;
            color: #000;
        }

        #loginPage {
            background-image: url("{{ url(get_site_background()) }}");
            background-size: cover;
        }

        #loginPage:after {
            content: '';
            height: 100%;
            width: 100%;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.4);
            top: 0;
            z-index: 111;
        }

        #loginPage > div {
            z-index: 999;
            position: relative;
        }

        #loginPage .form-group {
            margin: 15px 0;
            position: relative;
        }

        #loginPage .form-group .addon {
            position: absolute;
            left: 20px;
            top: 15px;
        }

        #loginPage .form-group .addon svg {
            height: 18px;
        }

        #loginPage .form-group .form-control {
            height: 50px;
            width: 100%;
            padding: 5px 10px 5px 50px;
            line-height: 50px;
            font-size: 18px;
            border: 1px solid #000000;
            outline: 0 !important;
            box-shadow: none !important;
            transition: border-color .4s;
        }

        #loginPage .form-group .form-control:focus {
            border-color: #006A4E;
        }

        #loginPage .form-group .btn-primary {
            height: 50px;
            width: 100%;
            background: #006A4E;
            box-shadow: none;
            outline: 0 !important;
            border: 1px solid #006A4E;
            text-transform: capitalize;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Open Sans', sans-serif;
            cursor: pointer;
        }

        #loginPage .text-left {
            text-align: left;
        }

        #loginPage .text-right {
            text-align: right;
        }

        #loginPage .text-center {
            text-align: center;
        }


        #loginPage .w-60 {
            width: 60%;
        }

        #loginPage .w-40 {
            width: 40%;
        }

        #loginPage .right-side {
            display: flex;
            flex-flow: row-reverse;
            align-items: center;
        }

        #loginPage .help-desk {
            font-size: 22px;
            line-height: 30px;
            margin-top: 25px;
        }

        #loginPage .help-desk span {
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
        }

        #loginPage .icon svg {
            height: 22px;
            max-width: 30px;
        }

        #loginPage .icon {
            display: inline-block;
            vertical-align: sub;
        }


        #loginPage .icon.sm svg {
            height: 20px;
        }


        #loginPage .icon.sm {
            vertical-align: text-top;
        }

        #loginPage .two-logo {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        #loginPage .two-logo .left {
            float: left;
        }

        #loginPage .two-logo .right {
            float: right;
        }

        #loginPage .two-logo .left img {
            max-height: 120px;
            max-width: 120px;
        }

        #loginPage .two-logo .right img {
            max-height: 120px;
            max-width: 120px;
        }

        #loginPage p.copy-right {
            font-size: 22px;
            margin: -15px 0 0 0;

        }

        .manual a {
            text-decoration: none;
            color: #111111;
        }

        .manual a:hover {
            color: #006A4E;
        }

        #loginPage p.copy-right a {
            text-decoration: none;
            color: #111111;
        }

        #loginPage p.copy-right a:hover {
            color: #006A4E;
        }

        #loginPage p.copy-right span {
            font-size: 18px;
            font-weight: 600;
        }


        /* Mobile: 767px. */
        @media only screen and (max-width: 767px) {
            #loginPage .card {
                max-width: 478px;
                padding: 20px 40px;
            }
        }

        /* Mobile: 767px. */
        @media only screen and (max-width: 480px) {
            #loginPage .card {
                width: calc(100% - 20px);
                padding: 20px 15px;
            }

            #loginPage h2 {
                font-size: 26px;
                line-height: 30px;
            }
        }

        /* Mobile: 767px. */
        @media only screen and (max-width: 400px) {
            #loginPage .right-side {
                display: block;
                width: 100% !important;
                text-align: center;
            }

            #loginPage .help-desk.d-flex {
                display: block !important;
            }

            #loginPage .help-desk .w-60 {
                width: 100% !important;
                text-align: center;
            }
        }

        span.invalid-feedback {
            color: red;
            padding: 4px 0 0 0;
            display: inline-block;
        }
    </style>


</head>
<body>

<section id="loginPage">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center min-vh-100 ">
            <div class="card text-center">
                <h2>E-Pass</h2>
                @include('layouts.partials.alert_message')
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input id="username" name="username" type="text"
                               class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                               aria-describedby="emailHelp" placeholder="Enter Username"
                               value="{{ old('username') }}" required autofocus>
                        <span class="addon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 8C10.21 8 12 6.21 12 4C12 1.79 10.21 0 8 0C5.79 0 4 1.79 4 4C4 6.21 5.79 8 8 8ZM8 10C5.33 10 0 11.34 0 14V16H16V14C16 11.34 10.67 10 8 10Z"
                                    fill="black"/>
                            </svg>
                        </span>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group">
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                               placeholder="Enter password" required>
                        <span class="addon">
                            <svg width="16" height="21" viewBox="0 0 16 21" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14 7H13V5C13 2.24 10.76 0 8 0C5.24 0 3 2.24 3 5V7H2C0.9 7 0 7.9 0 9V19C0 20.1 0.9 21 2 21H14C15.1 21 16 20.1 16 19V9C16 7.9 15.1 7 14 7ZM8 16C6.9 16 6 15.1 6 14C6 12.9 6.9 12 8 12C9.1 12 10 12.9 10 14C10 15.1 9.1 16 8 16ZM11.1 7H4.9V5C4.9 3.29 6.29 1.9 8 1.9C9.71 1.9 11.1 3.29 11.1 5V7Z"
                                    fill="black"/>
                            </svg>
                        </span>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">@lang('labels.login')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/forms/validation/form-validation.js') }}" type="text/javascript"></script>


</body>
</html>




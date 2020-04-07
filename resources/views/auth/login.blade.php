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
                <h2>বার্ষিক গোপনীয় অনুবেদন <br> (নন-গেজেটেড কর্মকর্তা/কর্মচারী)</h2>
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

                <div class="d-flex help-desk">
                    <div class="w-60 text-left ">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                            </svg>
                        </div>
                        হেল্প ডেস্ক: <br>
                        {{en2bn(get_contact_no() ?? "")}} <br>
                        <span>{{get_email()}}</span>
                    </div>
                    <div class="right-side text-right w-40">
                        <div class="manual">
                            <div class="icon sm">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                     x="0px" y="0px"
                                     width="475.452px" height="475.451px" viewBox="0 0 475.452 475.451"
                                     style="enable-background:new 0 0 475.452 475.451;"
                                     xml:space="preserve">
<g>
    <path d="M468.083,118.385c-3.99-5.33-9.61-9.419-16.854-12.275c0.387,6.665-0.086,12.09-1.42,16.281l-85.65,281.789
		c-1.526,4.948-4.859,8.897-9.992,11.848c-5.141,2.953-10.469,4.428-15.989,4.428H74.66c-22.84,0-36.542-6.652-41.112-19.985
		c-1.903-5.14-1.807-9.229,0.288-12.275c2.092-2.857,5.708-4.288,10.85-4.288h248.102c17.702,0,29.93-3.285,36.688-9.852
		c6.763-6.567,13.565-21.177,20.413-43.824l78.228-258.669c4.186-14.084,2.474-26.457-5.141-37.113s-18.462-15.987-32.548-15.987
		H173.163c-2.474,0-7.329,0.854-14.562,2.568l0.284-0.859c-5.33-1.14-9.851-1.662-13.562-1.571
		c-3.71,0.099-7.137,1.192-10.277,3.289c-3.14,2.094-5.664,4.328-7.566,6.706c-1.903,2.38-3.761,5.426-5.568,9.136
		c-1.805,3.715-3.33,7.142-4.567,10.282c-1.237,3.14-2.666,6.473-4.281,9.998c-1.62,3.521-3.186,6.423-4.71,8.706
		c-1.143,1.523-2.758,3.521-4.854,5.996c-2.091,2.474-3.805,4.664-5.137,6.567c-1.331,1.903-2.19,3.616-2.568,5.14
		c-0.378,1.711-0.19,4.233,0.571,7.566c0.76,3.328,1.047,5.753,0.854,7.277c-0.76,7.232-3.378,16.414-7.849,27.552
		c-4.471,11.136-8.52,19.18-12.135,24.126c-0.761,0.95-2.853,3.092-6.28,6.424c-3.427,3.33-5.52,6.23-6.279,8.704
		c-0.762,0.951-0.81,3.617-0.144,7.994c0.666,4.38,0.907,7.423,0.715,9.136c-0.765,6.473-3.14,15.037-7.139,25.697
		c-3.999,10.657-7.994,19.414-11.993,26.265c-0.569,1.141-2.185,3.328-4.853,6.567c-2.662,3.237-4.283,5.902-4.853,7.99
		c-0.38,1.523-0.33,4.188,0.144,7.994c0.473,3.806,0.426,6.66-0.144,8.562c-1.521,7.228-4.377,15.94-8.565,26.125
		c-4.187,10.178-8.47,18.896-12.851,26.121c-1.138,1.906-2.712,4.145-4.708,6.711c-1.999,2.566-3.568,4.805-4.711,6.707
		c-1.141,1.903-1.903,3.901-2.284,5.996c-0.19,1.143,0.098,2.998,0.859,5.571c0.76,2.566,1.047,4.612,0.854,6.14
		c-0.192,2.662-0.57,6.187-1.141,10.567c-0.572,4.373-0.859,6.939-0.859,7.699c-4.187,11.424-3.999,23.511,0.572,36.269
		c5.33,14.838,14.797,27.36,28.406,37.541c13.61,10.185,27.74,15.27,42.398,15.27h263.521c12.367,0,24.026-4.141,34.971-12.416
		c10.944-8.281,18.227-18.507,21.837-30.696l78.511-258.662C477.412,141.51,475.701,129.234,468.083,118.385z M164.31,118.956
		l5.997-18.274c0.76-2.474,2.329-4.615,4.709-6.423c2.38-1.805,4.808-2.712,7.282-2.712h173.589c2.663,0,4.565,0.903,5.708,2.712
		c1.14,1.809,1.335,3.949,0.575,6.423l-6.002,18.274c-0.764,2.475-2.327,4.611-4.713,6.424c-2.382,1.805-4.805,2.708-7.278,2.708
		H170.593c-2.666,0-4.568-0.9-5.711-2.708C163.74,123.567,163.55,121.431,164.31,118.956z M140.615,192.045l5.996-18.271
		c0.76-2.474,2.331-4.615,4.709-6.423c2.38-1.809,4.805-2.712,7.282-2.712h173.583c2.666,0,4.572,0.9,5.712,2.712
		c1.14,1.809,1.331,3.949,0.568,6.423l-5.996,18.271c-0.759,2.474-2.33,4.617-4.708,6.423c-2.383,1.809-4.805,2.712-7.283,2.712
		H146.895c-2.664,0-4.567-0.9-5.708-2.712C140.043,196.662,139.854,194.519,140.615,192.045z"/>
</g>

</svg>
                            </div>
                            <a target="_blank" href="{{asset('manual/user-manual.pdf')}}">ব্যবহার সহায়িকা</a>
                        </div>
                    </div>
                </div>
                <div class="two-logo">
                    <div class="left">
                        <a target="_blank" href="https://{{copyright_link()}}">
                            <img src="{{ url(get_site_logo()) }}" alt="">
                        </a>
                    </div>
                    <div class="right">
                        <img src="{{ url(get_site_banner()) }}" alt="">
                    </div>
                </div>
                <p class="copy-right">কারিগরি সহায়তায় <span><a href="http://inflack.com/" target="_blank">Inflack Limited</a></span>
                </p>
            </div>
        </div>
    </div>

</section>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/forms/validation/form-validation.js') }}" type="text/javascript"></script>


</body>
</html>




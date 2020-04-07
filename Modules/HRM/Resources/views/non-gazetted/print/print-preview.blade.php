<!Doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ICT - ACR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" href="{{ asset('print/plugins/bootstrap-4.3.1/css/bootstrap.min.css') }}">
    @include('hrm::non-gazetted.print.print-style-css')
</head>
<body>
{{--    onload="window.print()" onafterprint="closeWindow()">--}}
{{--<script type="text/javascript">--}}
{{--    function closeWindow() {--}}
{{--        window.close();--}}
{{--    }--}}
{{--</script>--}}

<div class="container print-as-pages p-0">
@include('hrm::non-gazetted.print.page-1')
@include('hrm::non-gazetted.print.page-2')

<!-- Page number Four End -->

</div>
</body>
</html>

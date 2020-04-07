<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{--    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ICT-ACR || PDF</title>
    <style type="text/css">
        @media print {
            @page {
                size: A4;
                margin: 0;
            }
            .pagebreak {
                clear: both;
                page-break-after: always;
            }

        }

        body {
            padding: 0;
            margin: 0;
        }

        .svg-pdf svg {
            width: 100% !important;
            height: 100% !important;
            margin: -5px 0 0 0;
        }
        .svg-pdf img {
            width: 100% !important;
            height: 100% !important;
            max-height: 1110px;
            margin: 0;
        }

    </style>
</head>
<body onload="window.print()" onafterprint="closeWindow()">

<script type="text/javascript">

    function closeWindow() {
        window.close();
    }
</script>

<div class="svg-pdf">
<!-- Page 1 -->
    @include('hrm::gazetted-cadre-officer/print/page-1')
<!-- Page 2 -->
    @include('hrm::gazetted-cadre-officer/print/page-2')
<!-- Page 3 -->
    @include('hrm::gazetted-cadre-officer/print/page-3')
<!-- Page4 -->
    @include('hrm::gazetted-cadre-officer/print/page-4')
<!-- Page 5 -->
    @include('hrm::gazetted-cadre-officer/print/page-5')
<!-- Page 6 -->
    @include('hrm::gazetted-cadre-officer/print/page-6')
<!-- Page 7 -->
    @include('hrm::gazetted-cadre-officer/print/page-7')
<!-- Page 8 -->
    @include('hrm::gazetted-cadre-officer/print/page-8')
</div>
</body>
</html>

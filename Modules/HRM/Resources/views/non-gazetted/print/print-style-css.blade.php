<style>
    /***** Google fonts *****/
    @font-face {
        font-family: 'Kalpurush-Regular';
        font-weight: 400;
        src: url('/print/fonts/Kalpurush/Kalpurush-Regular.ttf') format('truetype');
    }


    body {
        margin: 0;
        padding: 0;
        font-size: 17px;
        font-family: 'Kalpurush-Regular', sans-serif;
        background-color: #ffffff !important;
        line-height: 1.7;
    }

    ul, ol {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    p {
        padding: 0;
        margin: 0;

    }

    /***********css Animation*********/
    @media print {
        .pagebreak {
            clear: both;
            page-break-after: always;
        }

    }

    @page {
        margin: 0;
    }
    .min-h-160 {
        height: 160px;
        min-height: 170px;
        overflow: hidden;
    }
    p.special-font span,
    .font-serif {
        font-family: serif !important;
    }
    .signature-img-big{
        display: block;
        width: 160px;
        text-align: center;
        margin-left: auto !important;
        margin-right: 22px !important;
        position: relative;
    }
    .signature-img-big img{
     max-width: 100%;
        max-height: 90px;
    }
    .page-margin {
        /*margin: 25px 25px;*/
        /*padding: 50px 0 0 0;*/
    }

    .border-bottom-dash {
        border-bottom: 1px dashed #000000 !important;
        line-height: 18px;
        font-size: 80%;
    }

    .border-bottom {
        border-color: #000000 !important;
        display: inline-block;
        line-height: 16px;
    }

    .border-top {
        display: inline-block;
        border-color: #000000 !important;
    }

    .lh-22 {
        line-height: 22px;
    }
    .lh-10 {
        line-height: 20px;
    }
        .mt--5 {
            margin-top: -5px;
        }
    h1.f-37 {
        font-size: 40px;
    }

    .w-300 {
        width: 300px;
    }

    .w-140 {
        width: 140px;
    }

    .w-26 {
        width: 26px;
        min-width: 26px;
        text-align: right;
    }

    hr {
        border-color: #000000 !important;
    }

    li span.serial {
        position: relative;
        padding-right: 5px;
        width: 29px;
        display: inline-block;
        text-align: right;
    }

    li span.serial.blank:after {
        display: none;
    }

    img.signature {
        max-width: 70px;
        max-height: 36px;
    }

    table.table.table-bordered {
        border: none;
        border-color: #000000 !important;
    }

    table.table td.sub-group {
        line-height: 18px !important;
        padding-top: 5px !important;
        padding-bottom: 5px !important;
    }

    table.table td.sub-group span {
        vertical-align: text-top;
    }

    table.table tr th {
        border-bottom-width: 1px !important;
        border-color: #000000 !important;
        padding: 0;
    }

    table.table.table-bordered tbody tr td {
        /*border-top-color: transparent !important;*/
        /*border-bottom-color: transparent !important;*/

    }


    table.table.mullayon-table tbody tr td {
        min-width: 80px;
        text-align: center;

    }

    table.table.mullayon-table tbody tr td:first-child {
        width: 100%;
        text-align: left;
    }

    table.table.mullayon-table tbody tr td:last-child {
        max-width: 264px;
        padding: 2px 5px;
        min-width: 135px;
        width: 130px;
        font-size: 14px;
        line-height: 16px;
        vertical-align: middle;
    }

    table.table.table-bordered tbody tr th,
    table.table.table-bordered tr td {
        padding: 0 10px;
        line-height: 36px;
        border-color: #000000 !important;
    }


    .signature-img,
    table.table tbody td .signature-img {
        margin: auto;
        max-height: 33px;
        max-width: 90px;
    }


</style>

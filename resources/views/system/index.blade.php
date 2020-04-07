@extends('layouts.master')
@section('title', trans('labels.User create'))
@push('page-css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush
@section('content')
    <section id="user-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">{{trans('settings.title')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered zero-configuration text-center">
                                    <thead>
                                    <tr>
                                        <th>Key</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results as $result)
                                        @if(strtoupper($result->key) !== 'SPECIAL')
                                        <tr>
                                            <td>{{strtoupper($result->key)}}</td>
                                            <td>
                                                <input data-id="{{$result->id}}" class="toggle-class" type="checkbox"
                                                       data-onstyle="success" data-offstyle="danger"
                                                       data-toggle="toggle" data-on="Yes"
                                                       data-off="No" {{ $result->value ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page-js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function () {
            $('.toggle-class').change(function () {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                var formMessages = $('#form-messages');

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{route('system-settings.changeValue')}}",
                    data: {'status': status, 'id': id, '_token': "{{ csrf_token() }}"},
                    success: function (data) {
                        formMessages.removeClass('alert-danger');
                        formMessages.addClass('alert-success');
                        $(formMessages).text(data.success);
                        formMessages.show();
                    },
                    error: function (data) {
                        formMessages.removeClass('alert-success');
                        formMessages.addClass('alert-danger');
                        if (data.responseText !== '') {
                            $(formMessages).text(data.responseText);
                            formMessages.show();
                        }
                    }
                });
                setInterval(function () {
                    formMessages.hide();
                }, 5000);
            });
        });
    </script>
@endpush

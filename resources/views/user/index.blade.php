@extends('layouts.master')
@section('title', trans('labels.User list'))
@push('page-css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush
@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('user-management.user_list_page_title')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
{{--                        <div class="heading-elements">--}}
{{--                            <a href="{{url('/system/user/create')}}" class="btn btn-primary btn-sm"><i--}}
{{--                                    class="ft-plus white"></i> {{trans('user-management.create_user_button')}}</a>--}}
{{--                            <a href="{{url('/system/user')}}" class="btn btn-warning btn-sm"> <i class="ft-download white"></i></a>--}}
{{--                        </div>--}}
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>{{trans('labels.serial')}}</th>
                                    <th>{{trans('labels.name')}}</th>
                                    <th>{{trans('labels.username')}}</th>
                                    <th>{{trans('labels.mobile')}}</th>
                                    <th>{{trans('labels.email_address')}}</th>
                                    <th>{{trans('user-management.user_type')}}</th>
                                    <th>{{trans('user-management.special')}}</th>
{{--                                    <th>{{trans('labels.status')}}</th>--}}
                                    <th>{{trans('labels.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->mobile}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->user_type}}</td>
                                        <td class="{{ $user->hasRole('ROLE_SPECIAL_ACCESS') ? 'text text-success' : 'text text-danger' }}">
                                            {{ $user->hasRole('ROLE_SPECIAL_ACCESS') ? 'Yes' : 'No' }}
                                        </td>
{{--                                        <td>{{$user->status}}</td>--}}
                                        <td>
                                            <span class="dropdown">
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info dropdown-toggle"><i class="la la-cog"></i></button>
                                              <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                                <a href="{{URL::to( '/system/user/'.$user->id)}}" class="dropdown-item"><i class="ft-eye"></i> {{trans('labels.details')}}</a>
                                                 <div class="dropdown-divider"></div>
                                                  <a href="{{URL::to( '/system/user/'.$user->id.'/edit')}}" class="dropdown-item"><i class="ft-edit-2"></i>Role Add/Edit</a>
                                                  {!! Form::close() !!}
                                              </span>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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

            $('.table').dataTable({});

            $('.toggle-class').change(function () {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                var formMessages = $('#form-messages');

                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "{{route('user.special')}}",
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

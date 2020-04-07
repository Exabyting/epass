@extends('layouts.master')
@section('title', trans('labels.User create'))
@push('page-css')
@endpush
@section('content')
    <section id="user-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">{{trans('settings.system-config')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['url' =>  route('system-config.store'), 'class' => 'form', 'novalidate', 'files'=> true]) !!}
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>Key</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results as $result)
                                        @if(
                                            strtoupper($result->key) == 'SITE-ICON' ||
                                            strtoupper($result->key) == 'SITE-LOGO' ||
                                            strtoupper($result->key) == 'SITE-BACKGROUND' ||
                                            strtoupper($result->key) == 'SITE-BANNER'
                                            )
                                            <tr>
                                                <td>{{ Form::label('key['.$result->id.']', strtoupper($result->key) ) }}</td>
                                                <td>
                                                    @if($result->value)
                                                        <img style="max-width:200px; max-height: 200px;"
                                                             id="{{$result->key . "Show"}}"
                                                             src="{{ url('file/get?filePath=' . $result->value) }}"
                                                             alt=""/>
                                                    @else
                                                        <img style="max-width:200px; max-height: 200px;"
                                                             id="{{$result->key . "Show"}}"
                                                             src="https://via.placeholder.com/200x200?text=No+Image+Found"
                                                             alt=""/>
                                                    @endif
                                                    <br>
                                                    <br>
                                                    <input type='file' name="{{$result->key}}"
                                                           data-id="{{$result->id}}"
                                                           id="{{$result->key . "Input"}}"
                                                           accept=".png, .jpg, .jpeg"
                                                           src="{{ url('file/get?filePath=' . $result->value) }}"
                                                           data-validation-required-message="{{ trans('labels.Picture field is required') }}"/>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ Form::label('key['.$result->id.']', strtoupper($result->key) ) }}</td>
                                                <td>
                                                    {{ Form::text($result->key, $result->value,
                                                    [
                                                        'class' => 'form-control',
                                                        'required' => 'required',
                                                        'data-validation-required-message'=>trans('labels.This field is required')
                                                    ]
                                                 )}}
                                                </td>
                                            </tr>

                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> {{trans('labels.save')}}
                                </button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page-js')
    <script>
        $(function () {
            function readURL(input, $imageShowID) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $('#' + $imageShowID).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#site-iconInput").change(function () {
                let $imageShowID = $(this).siblings('img')[0].id;
                console.log($imageShowID);
                readURL(this, $imageShowID);
            });

            $("#site-logoInput").change(function () {
                let $imageShowID = $(this).siblings('img')[0].id;
                console.log($imageShowID);
                readURL(this, $imageShowID);
            });

            $("#site-bannerInput").change(function () {
                let $imageShowID = $(this).siblings('img')[0].id;
                readURL(this, $imageShowID);
            });

            $("#site-backgroundInput").change(function () {
                let $imageShowID = $(this).siblings('img')[0].id;
                readURL(this, $imageShowID);
            });
        });
    </script>
@endpush

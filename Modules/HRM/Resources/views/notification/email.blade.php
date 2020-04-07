@extends('hrm::notification.partials.email-main')
@section('title', "Email Notification")
@section('content')
    <b>{{$name}}</b> ,<br>
    {{$message}}
@endsection

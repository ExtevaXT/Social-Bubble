@extends('master')


@section('content')
{{--    выводит информацию о пользователе--}}
{{--            ЕСЛИ В СЕССИИ ЕСТЬ 'success'--}}
@if(session()->has('success'))
    <div class="alert alert-dark">User saved</div>
@endif
@if(session()->has('auth'))
    <div class="alert alert-dark">You are authorized</div>
@endif
<div class="fs-1 mb-3">My account</div>
    <div>
        <ul class="list-unstyled text-decoration-none">
            <li class="my-2"><img src="{{ 'storage/app/public/' . Auth::user()->image }}" style="width: 128px;height: 128px; {{Auth::user()->image=='user.png' ? 'filter: invert(1);' : null}}" alt=""></li>
            <li class="my-2">Login: {{ Auth::user()->login }}</li>
            <li class="my-2">Full name: {{ Auth::user()->full_name }}</li>
            <li class="my-2">Birthday: {{ Auth::user()->birthday ?? 'Not assigned' }}</li>
            <li class="my-2">Age: {{ \Carbon\Carbon::parse(Auth::user()->birthday)->age}} years</li>
            <li class="my-2"><a class="btn btn-outline-light" href="{{route('edit')}}">Edit user information</a></li>
        </ul>
    </div>
@endsection

@extends('master')


@section('content')
    @auth
        <div class="alert alert-dark">You are authorized</div>
    @endauth
    @guest
        @error('auth')
        <div class="alert alert-danger">Login or password is incorrect</div>
        @enderror
        @if(session()->has('register'))
            <div class="alert alert-dark">Registered successfully</div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            {{--    авторизация и поля ввода--}}
            @csrf
            @include('components.input', ['input' => ['name' => 'login', 'label' => 'Login']])
            @include('components.input', ['input' => ['name' => 'password', 'label' => 'Password', 'type' => 'password' ]])
            <button type="submit" class="btn btn-outline-light w-100">Login</button>
        </form>
    @endguest
@endsection

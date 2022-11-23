@extends('master')


@section('content')
    @guest()
        <div>
            <div class="lead" style="width: 512px">
                But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.
            </div>
            <a class="btn btn-outline-light px-5 my-3" href="{{route('register')}}">Register</a>
            <a class="btn btn-outline-light px-5 my-3" href="{{route('login')}}">Login</a>
        </div>


    @endguest
    @auth
    <form action="{{route('search')}}" method="GET">
        <div class="fs-1">Find user</div>
        @include('components.input', ['input' => ['name' => 'full_name', 'label' => 'Full name']])
        @include('components.input', ['input' => ['name' => 'birthday', 'label' => 'Birthday', 'type' => 'date']])
        <button class="btn btn-outline-light w-100" type="submit">Find</button>
    </form>
    @isset($result)
        <div>Found:</div>
    @forelse($result as $user)
        <div class="border border-light">
            <form method="POST" action="{{route('friendAdd', ['friend' => $user->login])}}" class="d-flex gap-3 m-1 justify-content-between">
                @csrf
                <div class="d-flex">
                    <div class="p-1" onclick="window.location.href = '/user/{{$user->id}}'"><img src="{{ 'storage/app/public/' . $user->image }}" style="width: 32px;height: 32px; {{$user->image=='user.png' ? 'filter: invert(1);' : null}}" alt=""></div>
                    <div class="p-2">Full name: {{$user->full_name}}</div>
                    <div class="p-2">Birthday: {{$user->birthday}}</div>
                    <div class="p-2">{{$user->country ? "Country: $user->country" : null}}</div>
                    <div class="p-2">{{$user->city ? "City: $user->city" : null}}</div>
                    <div class="p-2">{{$user->hobby ? "Hobby: $user->hobby" : null}}</div>
                </div>
                @if($user == Auth::user())
                <a href="{{route('cabinet')}}" class="btn btn-outline-light px-3 py-2 me-3">My account</a>
                @elseif(Auth::user()->friend($user->login))
                <button onclick="window.location.href = '/chat/{{$user->id}}'" class="btn btn-outline-light px-4 py-2 me-3">Message</button>
                @else
                <button type="submit" class="btn btn-outline-light p-2 me-3">Add to friend</button>
                @endif
            </form>
        </div>
    @empty
        <div class="fs-5">No users were found</div>
    @endforelse
    @endisset
    @endauth
@endsection

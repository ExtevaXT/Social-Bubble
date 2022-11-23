@extends('master')


@section('content')
    @auth
        <div class="fs-1 mb-3">Chats</div>
{{--        @foreach($chats as $chat)--}}
{{--            <div class="border border-light d-flex" onclick="window.location.href = '/chat/{{$chat->recipient_id}}'">--}}
{{--                <div class="p-1"><img src="{{ asset('storage/app/public/'.$chat->user()->image) }}" style="width: 64px;height: 64px; {{$chat->user()->image=='user.png' ? 'filter: invert(1);' : null}}" alt=""></div>--}}
{{--                <div>--}}
{{--                    <div class="p-2">{{$chat->recipient()->full_name}}</div>--}}
{{--                    <div class="p-2">{{$chat->message}}</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
    @foreach($users as $user)
        <div class="border border-light d-flex" onclick="window.location.href = '/chat/{{$user->id}}'">
            <div class="p-1"><img src="{{ asset('storage/app/public/'.$user->image) }}" style="width: 64px;height: 64px; {{$user->image=='user.png' ? 'filter: invert(1);' : null}}" alt=""></div>
            <div>
                <div class="p-1">{{$user->full_name}}</div>
                <div class="p-1 text-secondary">{{$lastMessages[$loop->index]}}</div>
            </div>
        </div>
    @endforeach
    @endauth
@endsection

@extends('master')


@section('content')
    @if(Auth::check() and Auth::user() != $recipient)
        <div class="fs-1 mb-3">Chat with <a href="/user/{{$recipient->id}}" class="fw-bold text-decoration-none text-light">{{$recipient->full_name}}</a></div>
        @forelse($messages as $message)
            <div class="border border-light d-flex">
                <div class="p-1" onclick="window.location.href = '/user/{{$message->user_id}}'" >
                    <img src="{{ asset('storage/app/public/'.$message->user()->image) }}"
                         style="width: 48px;height: 48px; {{$message->user()->image=='user.png' ? 'filter: invert(1);' : null}}"
                         alt="">
                </div>
                <div>
                    <div class="px-2">
                        {{$message->user()->full_name}} {!! $message->user_id == Auth::user()->id ? '<span class="fw-bold">(you)</span>' : null!!}
                    </div>
                    <div class="p-2">{{$message->message}}</div>
                </div>
                <div class="px-2">{{$message->created_at}}</div>
            </div>
        @empty
            <div class="mt-3 fs-5">No messages</div>
            <div class="mb-3 fs-5">Start messaging with this user</div>
        @endforelse
        <form action="{{route('sendMessage')}}" method="POST">
            @csrf
            <input type="hidden" value="{{$recipient->id}}" name="recipient">
            @include('components.input', ['input' => ['name' => 'message', 'label' => '', 'type' => 'text']])
            <button class="btn btn-outline-light w-100" type="submit">Send</button>
        </form>
    @endif
@endsection

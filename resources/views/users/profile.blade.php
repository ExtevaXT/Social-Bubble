@extends('master')


@section('content')
    {{--    выводит информацию о пользователе--}}
    <div class="container">
        <ul class="list-unstyled text-decoration-none">
            <li class="my-2"><img src="{{ asset('storage/app/public/'.$user->image) }}" style="width: 128px;height: 128px; {{$user->image=='user.png' ? 'filter: invert(1);' : null}}" alt=""></li>
            <li class="my-2">Full name: {{ $user->full_name }}</li>
            <li class="my-2">Birthday: {{ $user->birthday}}</li>
            <li class="my-2">Age: {{ \Carbon\Carbon::parse($user->birthday)->age}} years</li>
            <li class="my-2">Country: {{ $user->country ?? 'Not assigned' }}</li>
            <li class="my-2">City: {{ $user->city ?? 'Not assigned' }}</li>
            <li class="my-2">Hobby: {{ $user->hobby ?? 'Not assigned' }}</li>
            <div class="my-2 d-inline">
                @if(Auth::user() != $user)
                    <button onclick="window.location.href = '/chat/{{$user->id}}'" class="btn btn-outline-light">Message</button>
                @else
                    <button onclick="window.location.href = '{{route('cabinet')}}'" class="btn btn-outline-light">My account</button>
                @endif
                @if(Auth::user()->friend($user->login))
                    <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        {{collect(Auth::user()->friends)->firstWhere('login', $user->login)['accepted'] ? 'Remove from friends' : 'Cancel request'}}
                    </button>
                @endif
                @if($friend = collect(Auth::user()->friends)->firstWhere('login', $user->login) and $friend['canAccept'] and !$friend['accepted'])
                    <form method="POST" action="{{route('friendAdd', ['friend' => $user->login])}}" class="d-inline">
                        <button type="submit" class="btn btn-outline-success me-3">Accept</button>
                    </form>
                @endif
            </div>
        </ul>
    </div>
    @if(Auth::user()->friend($user->login))
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Remove friend</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to disappoint {{ $user->full_name }}?

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <form class="d-inline" action="{{ route('friendDelete', ['friend' => $user->login]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

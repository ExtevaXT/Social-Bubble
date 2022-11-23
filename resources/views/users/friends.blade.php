@extends('master')


@section('content')
    @if(session()->has('success'))
        <div class="alert alert-dark">Added friend</div>
    @endif
    @if(session()->has('deleted'))
        <div class="alert alert-dark">Removed friend</div>
    @endif
    @if(session()->has('accepted'))
        <div class="alert alert-dark">Accepted friend</div>
    @endif
    <div class="fs-1">Friends</div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Full Name</th>
            <th scope="col">Birthday</th>
            <th scope="col">Age</th>
            <th scope="col">Country</th>
            <th scope="col">City</th>
            <th scope="col">Hobby</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($friends as $friend)
            <tr>
                <th onclick="window.location.href = '/user/{{$friend['user']->id}}'">
                    <img src="{{ 'storage/app/public/' . $friend['user']->image }}"
                         style="width: 32px;height: 32px; {{$friend['user']->image=='user.png' ? 'filter: invert(1);' : null}}"
                         alt="">
                </th>
                <td>{{$friend['user']->full_name}}</td>
                <td>{{$friend['user']->birthday}}</td>
                <td>Age: {{ \Carbon\Carbon::parse($friend['user']->birthday)->age}} years</td>
                <td>{{$friend['user']->country}}</td>
                <td>{{$friend['user']->city}}</td>
                <td>{{$friend['user']->hobby}}</td>
                <td>
                    <button onclick="window.location.href = '/chat/{{$friend['user']->id}}'" class="btn btn-outline-light">Message</button>
                    @if($friend['accepted'])
                    <a href=""
                       type="button"
                       class="btn btn-outline-danger destroy"
                       data-bs-toggle="modal"
                       data-bs-target="#getOpenDestroyModalWindow"
                       {{--               ПЕРЕДАЧА ID В АТРИБУТ--}}
                       data-id="{{$friend['user']->login}}">Delete</a>
                    @elseif($friend['canAccept'])
                        <form action="{{route('friendAccept', ['friend' => $friend['user']->login])}}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-success">Accept</button>
                        </form>
                    @else
                        <a>Requested</a>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    @include('components.destroyModal',['routeName' => 'friends'])
    <script>
        // ДЛЯ ВСЕХ ЭЛЕМЕНТОВ КНОПКИ УДАЛЕНИЯ
        document.querySelectorAll('.destroy').forEach((element) => {
            // ПРИ КЛИКЕ
            element.addEventListener('click', (el)=>{
                // ОБНОВЛЯЕТ ТЕКСТ В МОДАЛЬНОМ ОКНЕ С ВЫБРАННЫМ ID
                document.querySelector('#getOpenDestroyModalWindow_context').innerHTML = 'Remove '+ element.dataset.id+ ' from friends';
                // ОБНОВЛЯЕТ ССЫЛКУ ДЛЯ УДАЛЕНИЯ С ВЫБРАННЫМ ID
                document.querySelector('.friendLogin').value = element.dataset.id
                document.querySelector('#getOpenDestroyModalWindow_operation').setAttribute('action', '{{route('friendDelete')}}')
            })
        })
    </script>
@endsection

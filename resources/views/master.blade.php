<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Social Bubble</title>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.css')}}">
    <style>
        body{
            background: #292929;
        }
        *{
            color: var(--bs-light);
        }
        option{
            color: var(--bs-dark);
        }
    </style>
</head>
<body class="container">
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand text-light fw-bold" href="/"><img src="{{asset('public/bubble.png')}}" width="24" height="24" alt=""> Social Bubble</a>
        <ul class="navbar-nav">
            @guest()
                {{--                авторизация регистрация для guest--}}
                <li class="nav-item"><a class="nav-link text-light" href="{{route('login')}}">Login</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="{{route('register')}}">Register</a></li>
            @endguest
            @auth()
                {{--   кабинет добавление и вывод постов--}}
                <li class="nav-item"><a class="nav-link text-light" href="{{route('cabinet')}}">My account</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="{{route('friends')}}">My friends</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="{{route('chats')}}">Chats</a></li>
                <li class="nav-item"><a class="nav-link text-danger ms-3" href="{{ route('logout') }}">Logout</a></li>
            @endauth
        </ul>
</nav>
<div class="container my-3">
    @section('content')


    @show
</div>

<script src="{{asset('public/js/bootstrap.bundle.js')}}"></script>
</body>
</html>

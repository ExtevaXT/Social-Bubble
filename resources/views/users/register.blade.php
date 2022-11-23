@extends('master')


@section('content')
    @auth
        <div class="alert alert-dark">You are authorized</div>
    @endauth
    @guest
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            {{--    регистарция и компоненты полей ввожа--}}
            @include('components.input', ['input' => ['name' => 'login', 'label' => 'Login']])
            @include('components.input', ['input' => ['name' => 'full_name', 'label' => 'Full name']])

            @include('components.input', ['input' => ['name' => 'password', 'label' => 'Password', 'type' => 'password' ]])
            @include('components.input', ['input' => ['name' => 'password_confirmation', 'label' => 'Password Confirmation', 'type' => 'password' ]])

            <div class="mb-3">
                <label for="inputCountry" class="form-label">Country</label>
                <select name="country" class="form-control" id="inputCountry">
                    <option selected>None</option>
                    <option value="Russia">Russia</option>
                    <option value="USA">USA</option>
                    <option value="Arstotzka">Arstotzka</option>
                    <option value="Canada">Canada</option>
                    <option value="Mordor">Mordor</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="inputCity" class="form-label">City</label>
                <select name="city" class="form-control" id="inputCity">
                    <option selected>None</option>
                    <option value="Moscow">Moscow</option>
                    <option value="Chelyabinsk">Chelyabinsk</option>
                    <option value="London">London</option>
                    <option value="Los-Santos">Los-Santos</option>
                    <option value="Novigrad">Novigrad</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="inputHobby" class="form-label">Hobby</label>
                <select name="hobby" class="form-control" id="inputHobby">
                    <option selected>None</option>
                    <option value="Music">Music</option>
                    <option value="Gaming">Gaming</option>
                    <option value="Math">Math</option>
                    <option value="Bullying">Bullying</option>
                    <option value="Literature">Literature</option>
                </select>
            </div>
            @include('components.input', ['input' => ['name' => 'birthday', 'label' => 'Birthday', 'type'=>'date']])
            <div class="mb-3">
                <input type="checkbox" name="check1" class="form-check-input" id="inputCheck1">
                <label for="inputCheck1" class="form-check-label ms-3">Subscribe to email spam</label>
            </div>
            <div class="mb-3">
                <input type="checkbox" name="check2" class="form-check-input" id="inputCheck2">
                <label for="inputCheck2" class="form-check-label ms-3">Allow us to install malware to your PC</label>
            </div>
            <button type="submit" class="btn btn-outline-light w-100">Register</button>
        </form>
    @endguest
@endsection

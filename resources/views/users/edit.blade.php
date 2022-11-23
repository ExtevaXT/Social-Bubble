@extends('master')

@section('title','Cabinet Edit')
@section('content')
    {{--    ИЗМЕНЕНИЕ пользователя--}}
    <h2>Cabinet edit</h2>
    <form action="{{route('edit')}}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('components.input', ['input' => ['name' => 'login', 'label' => 'Login', 'default'=>Auth::user()->login]])
        @include('components.input', ['input' => ['name' => 'full_name', 'label' => 'Full name', 'default'=>Auth::user()->full_name]])

        @include('components.input', ['input' => ['name' => 'current_password', 'label' => 'Password', 'type' => 'password' ]])
        @include('components.input', ['input' => ['name' => 'password', 'label' => 'New Password', 'type' => 'password' ]])
        @include('components.input', ['input' => ['name' => 'password_confirmation', 'label' => 'Password Confirmation', 'type' => 'password' ]])

        @include('components.input', ['input' => ['name' => 'image', 'label' => 'Image', 'type'=>'file']])
        <div class="mb-3">
            <label for="inputCountry" class="form-label">Country</label>
            <select name="country" class="form-control" id="inputCountry">
                @if(Auth::user()->country)
                    <option selected disabled>{{Auth::user()->country}}</option>
                @endif
                <option>None</option>
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
                @if(Auth::user()->city)
                    <option selected disabled>{{Auth::user()->city}}</option>
                @endif
                <option>None</option>
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
                @if(Auth::user()->hobby)
                <option selected disabled>{{Auth::user()->hobby}}</option>
                @endif
                <option>None</option>
                <option value="Music">Music</option>
                <option value="Gaming">Gaming</option>
                <option value="Math">Math</option>
                <option value="Bullying">Bullying</option>
                <option value="Literature">Literature</option>
            </select>
        </div>
        @include('components.input', ['input' => ['name' => 'birthday', 'label' => 'Birthday', 'type'=>'date', 'default'=>Auth::user()->birthday]])

        <button type="submit" class="my-2 btn btn-outline-light w-100">Save</button>
    </form>
@endsection

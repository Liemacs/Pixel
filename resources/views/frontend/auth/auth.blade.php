@extends('frontend.layouts.master')

@section('content')
    <div class="login">
        <h1>Login</h1>
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div>
                <input type="email" name="email" id="email" placeholder="Email"  >
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="password" name="password" id="password" placeholder="Password">
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>

    <div class="register">
        <h1>Register</h1>
        <form action="{{ route('register.submit') }}" method="POST" autocomplete="off">
           {{  csrf_field() }}
            <div>
                <input type="text" name="full_name" id="full_name" placeholder="Full name" value="{{ old('full_name') }}">
                @error('full_name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="text" name="username" id="username" placeholder="Username"  value="{{ old('username') }}" >
                @error('username')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="email" name="email" id="email" placeholder="Email"  >
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="password" name="password" id="password" placeholder="Password" >
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="password" name="password_confirmation" id="password" placeholder="Confirm password">
                
            </div>
            
            <button type="submit">Register</button>
        </form>
    </div>
@endsection

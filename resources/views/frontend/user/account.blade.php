@extends('frontend.layouts.master')

@section('content')
    @include('frontend.user.sidebar')
    <h1>Acount detail</h1>

    <form action="{{ route('update.account', $user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="full_name">Full name</label>
            <input type="text" name="full_name" class="form-control" value="{{ $user->full_name }}" placeholder="Full name">
            @error('full_name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" value="{{ $user->username }}">
            @error('username')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" >
            @error('phone')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="oldPassword">Old password</label>
            <input type="password" name="oldPassword" class="form-control" placeholder="Old password">
            @error('oldPassword')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="newPassword">New password</label>
            <input type="password" name="newPassword" class="form-control" placeholder="New password">
            @error('newPassword')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">SAVE CHANGES</button>
    </form>
@endsection

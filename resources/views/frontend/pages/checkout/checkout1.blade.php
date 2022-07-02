@extends('frontend.layouts.master')

@section('content')
    <form action="#" method="post" autocomplete="off">
        <h5>Billing Details</h5>
        <div>
            @php
                $name = explode(' ', $user->full_name);
            @endphp
            <div>
                <label for="first_name"></label>
                <input type="text" name="first_name" id="first_name" value="{{ $name[0] }}" placeholder="First name" required>
            </div>
            <div>
                <label for="last_name"></label>
                <input type="text" name="last_name" id="last_name" value="{{ $name[1] }}" placeholder="Last name" required>
            </div>
            <div>
                <label for="email"></label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" placeholder="Email" readonly>
            </div>
            <div>
                <label for="phone"></label>
                <input type="number" name="phone" id="phone" value="{{ $user->phone }}" placeholder="Phone" >
            </div>
        </div>
        <a href="#" class="btn btn-primary">Go back</a>
        <a href="#" class="btn btn-success">Continue</a>
    </form>
@endsection

@section('scripts')
    <script>
        
    </script>
@endsection

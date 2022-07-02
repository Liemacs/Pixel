@extends('frontend.layouts.master')

@section('content')
    @include('frontend.user.sidebar')
    <h1>User dashboard</h1>
    <p>Hello <strong>{{ auth()->user()->full_name }}!</strong></p>

    <div class="pixel-corners test">Button</div>
@endsection

@section('styles')
    <style>
        .test {
            background: rgb(161, 211, 25);
            padding: 45px;
        }

        .pixel-corners {
            clip-path: polygon(0px 21px,
                    3px 21px,
                    3px 15px,
                    6px 15px,
                    6px 9px,
                    9px 9px,
                    9px 6px,
                    12px 6px,
                    15px 6px,
                    15px 3px,
                    18px 3px,
                    21px 3px,
                    21px 0px,
                    calc(100% - 21px) 0px,
                    calc(100% - 21px) 3px,
                    calc(100% - 15px) 3px,
                    calc(100% - 15px) 6px,
                    calc(100% - 9px) 6px,
                    calc(100% - 9px) 9px,
                    calc(100% - 6px) 9px,
                    calc(100% - 6px) 12px,
                    calc(100% - 6px) 15px,
                    calc(100% - 3px) 15px,
                    calc(100% - 3px) 18px,
                    calc(100% - 3px) 21px,
                    100% 21px,
                    100% calc(100% - 21px),
                    calc(100% - 3px) calc(100% - 21px),
                    calc(100% - 3px) calc(100% - 15px),
                    calc(100% - 6px) calc(100% - 15px),
                    calc(100% - 6px) calc(100% - 9px),
                    calc(100% - 9px) calc(100% - 9px),
                    calc(100% - 9px) calc(100% - 6px),
                    calc(100% - 12px) calc(100% - 6px),
                    calc(100% - 15px) calc(100% - 6px),
                    calc(100% - 15px) calc(100% - 3px),
                    calc(100% - 18px) calc(100% - 3px),
                    calc(100% - 21px) calc(100% - 3px),
                    calc(100% - 21px) 100%,
                    21px 100%,
                    21px calc(100% - 3px),
                    15px calc(100% - 3px),
                    15px calc(100% - 6px),
                    9px calc(100% - 6px),
                    9px calc(100% - 9px),
                    6px calc(100% - 9px),
                    6px calc(100% - 12px),
                    6px calc(100% - 15px),
                    3px calc(100% - 15px),
                    3px calc(100% - 18px),
                    3px calc(100% - 21px),
                    0px calc(100% - 21px));
        }
    </style>
@endsection

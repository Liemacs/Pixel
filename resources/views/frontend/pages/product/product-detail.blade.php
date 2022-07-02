@extends('frontend.layouts.master')

@section('content')
    <h2><a href="{{ route('home') }}">Home</a>/ <span>{{ \App\Models\Category::where ('id', $product->cat_id )->value('title')}}</span> /{{ $product->title }}</h2>
    <div class="photo-product">
        @php
            $photos = explode(',', $product->photo);
        @endphp
        @foreach ($photos as $photo)
            <div>
                <img src="{{ $photo }}" alt="{{ $product->title }}">
                <p>{{ $product->title }}</p>
                <p>$ {{ number_format($product->offer_price, 2) }}
                    <small><del>{{ number_format($product->price, 2) }}</del></small></p>
                <h5>Overview</h5>
                <p>{{ $product->summary }}</p>
                <h5>Descriptiom</h5>
                <p>{{ $product->description }}</p>
            </div>
        @endforeach
    </div>
    <h1>Relate Products</h1>
    @if (count($product->rel_prods) > 0)
        @foreach ($product->rel_prods as $item)
            @php
                $photo = explode(',', $item->photo);
            @endphp
            <a href="{{ route('product.detail', $item->slug) }}">
                <img src="{{ $photo[0] }}" alt="{{ $item->title }}">
                <p>{{ $item->title }}</p>
                <h4>{{ $item->title }}</h4>
                <p>$ {{ number_format($item->offer_price, 2) }}
                    <small><del>{{ number_format($item->price, 2) }}</del></small>
                </p>
            </a>
        @endforeach
    @endif
@endsection

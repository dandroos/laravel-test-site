@extends('layouts.product')
@section('subtitle', $product->name .' | ')
@section('product_content')
    <div>
        <h3>{{ $product->name }}</h3>
        @if (session('message'))
            <div>
                <span>{{ session('message') }}</span>
            </div>
        @endif
        @if(Auth::check())
        @endif
        <div>
            @if($product)
                <h4>{{ $collection->name }}</h4>
                <img src="{{ asset($main_product_image->url)}}" alt="product image" style="max-width: 65%;">
                @if($additional_product_images)
                    @foreach($additional_product_images as $additional_product_image)
                        <img src="{{ asset($additional_product_image->url)}}" alt="product image" style="max-width: 65%;">
                    @endforeach
                @endif
                <div>{!! nl2br($product->description) !!}</div>
                <div>
                    @if($product->availability == 0)
                        <span>Currently unavailable</span>
                    @elseif($product->availability == 1)
                        <span>Available to order</span>
                    @else
                        <span>In stock</span>
                    @endif
                </div>
                <div>{{ $product->price }}</div>
                @if (Auth::check())
                    <a href="edit/{{ $product->id }}">Edit/Delete</a>
                @endif
            @else
                <p>There is no content to display for this product.</p>
            @endif
        </div>
    </div>
@endsection
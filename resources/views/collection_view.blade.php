@extends('layouts.collection')
@section('subtitle', 'View | ')
@section('collection_content')
    <div>
        <h3>{{ $collection->name }}</h3>
        @if (session('message'))
            <div>
                <span>{{ session('message') }}</span>
            </div>
        @endif
        @if(Auth::check())
            <div>
                <span>Admin : </span>
                <a href="{{route('product_create', [
                    'id' => $collection->id   
                ])}}">Add new product</a>
            </div>
        @endif
        <div>
            @if(!empty($products))
                @foreach ($products as $product)
                    <a href="{{ route('product_view', [ 'id' => $product->id])}}">
                        <h4>{{ $product->name }}</h4>
                    </a>
                    <a href="{{ route('product_view', [ 'id' => $product->id])}}">
                        @foreach($product_images as $product_image)
                            @if($product_image->product_id == $product->id)
                                <img src="{{ asset($product_image->url)}}" alt="product image" style="max-width: 65%;">
                                
                                @break
                            @endif
                        @endforeach
                    </a>
                    <div>{{ $product->price }}</div>
                   
                @endforeach
            @else
                <p>There are no products for this collection.</p>
            @endif
        </div>
    </div>
@endsection
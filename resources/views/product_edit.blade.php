@extends('layouts.product')
@section('subtitle', 'Edit Product | ')
@section('product_content')
    
    <h3>Edit product</h3>
    <form action="../edit/{{ $product->id }}" method="post" enctype="multipart/form-data">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
        <label for="name">Product name</label>
        <input type="text" id="name" name="name" value="{{ $product->name }}"">
        <label for="collection">Collection name</label>
        <select name="collection" id="collection">
            @foreach($collections as $collection)
                @if($product->collection_id == $collection->id)
                    <option value="{{ $collection->id }}" selected>
                @else
                    <option value="{{ $collection->id }}">
                @endif
                        {{ $collection->name }}
                    </option>
            @endforeach
        </select>
        <label for="description">Product description</label>
        <textarea id="description" name="description" rows="10">{{ $product->description }}</textarea>
        <label for="price">Price</label>
        <input type="text" name="price" id="price" value="{{ $product->price }}">
        <img src="{{ asset($main_product_image->file_path) }}" alt="Main product image">
        <label for="product_image">Replace product image</label>
        <input type="file" name="product_image" id="product_image">
        <label for="add_product_images">Upload additional product images</label>
        <input type="file" name="add_product_images[]" id="add_product_images" multiple>
        <select name="availability" id="availability">
            <option value="2">In stock</option>
            <option value="1">Available to order</option>
            <option value="0">Currently unavailable</option>
        </select>
        <input type="submit" value="Update product">
    </form>
    @if($additional_product_images)
            @foreach($additional_product_images as $additional_product_image)
                <img src="{{ asset($additional_product_image->file_path) }}" alt="Additional product image">
                <form action="{{ route('image_delete')  }}" method="post">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                    <input type = "hidden" name = "image_id" value = "{{ $additional_product_image->id }}">
                    <input type = "submit" value = "Delete image">
                </form>
            @endforeach
        @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

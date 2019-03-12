@extends('layouts.product')
@section('subtitle', 'Add Product | ')
@section('product_content')
    
    <h3>Add new product</h3>
    <form action="../create" method="post" enctype="multipart/form-data">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
        <label for="name">Product name</label>
        <input type="text" id="name" name="name">
        <label for="collection">Collection name</label>
        <select name="collection" id="collection">
            @foreach($collections as $collection)
                @if($autofill_id == $collection->id)
                    <option value="{{ $collection->id }}" selected>
                @else
                    <option value="{{ $collection->id }}">
                @endif
                        {{ $collection->name }}
                    </option>
            @endforeach
        </select>
        <label for="description">Product description</label>
        <textarea id="description" name="description" rows="10"></textarea>
        <label for="price">Price</label>
        <input type="text" name="price" id="price">
        <label for="product_image">Main product image</label>
        <input type="file" name="product_image" id="product_image">
        <label for="add_product_images">Additional product images</label>
        <input type="file" name="add_product_images[]" id="add_product_images" multiple>
        <select name="availability" id="availability">
            <option value="2">In stock</option>
            <option value="1">Available to order</option>
            <option value="0">Currently unavailable</option>
        </select>
        <input type="submit" value="Add product">
    </form>
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

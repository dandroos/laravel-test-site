@extends('layouts.collection')
@section('collection_content')
    <h3>Edit Collection</h3>
    @if (session('message'))
        <div>
            <span>{{ session('message') }}</span>
        </div>
    @endif
    <form action="../edit" method="post" enctype="multipart/form-data">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
        <input type="hidden" name="id" value="{{ $collection->id }}">
        
        <label for="name">Collection name</label>
        <input type="text" id="name" name="name" value="{{ $collection->name }}">
        
        <img src="{{ asset($main_collection_image->url) }}" alt="Collection image" style="max-width: 80%;">
        <label for="collection_image">Replace collection image?</label>
        <input type="file" name="collection_image" id="collection_image">
        
        <label for="description">Collection description</label>
        <textarea id="description" name="description" rows="10">{{ $collection->description }}</textarea>
        <input type="submit" value="Update collection">
    </form>
    <form action="../delete" method="post">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
        <input type="hidden" name="id" value="{{ $collection->id }}">
        <input type="submit" value="Delete collection">
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
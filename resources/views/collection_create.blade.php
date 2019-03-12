@extends('layouts.collection')
@section('subtitle', 'Add Collection | ')
@section('collection_content')
    
    <h3>Create new collection</h3>
    <form action="create" method="post" enctype="multipart/form-data">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
        <label for="name">Collection name</label>
        <input type="text" id="name" name="name">
        <label for="collection_image">Collection image</label>
        <input type="file" name="collection_image" id="collection_image">
        <label for="description">Collection description</label>
        <textarea id="description" name="description" rows="10"></textarea>
        <input type="submit" value="Add collection">
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

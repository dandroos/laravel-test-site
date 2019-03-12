@extends('layouts.article')
@section('subtitle', 'Add news story | ')
@section('article_content')
    <h3>Create new story</h3>


    <form action="create" method="post" enctype="multipart/form-data">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
        <input type="text" name="title" placeholder="Headline">
        <label for="file">Add featured image</label>
        <input type="file" name="featured_image" id="feature_image">
        <textarea id="body" name="body" rows="10" placeholder="Type your story here..."></textarea>
        <input type="submit" value="Add Story">
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

@extends('layouts.article')
@section('article_content')
    <h3>Edit story</h3>
    <form action="../edit" method="post" enctype="multipart/form-data">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
        <input type="hidden" name="id" value="{{ $article->id }}">
        
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Title" value="{{ $article->title }}">
        
        @if($article->image)
            <img src="{{ asset($article->image->url) }}" alt="Post image" style="max-width: 80%;">
        @endif
        <label for="file">Replace featured image?</label>
        <input type="file" name="featured_image">
        
        <label for="body">Main body</label>
        <textarea id="body" name="body" rows="10" placeholder="Type your story here...">{{ $article->body }}</textarea>
        <input type="submit" value="Update Story">
    </form>
    <form action="../delete" method="post">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
        <input type="hidden" name="id" value="{{ $article->id }}">
        <input type="submit" value="Delete Story">
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
@if (session('message'))
    <div>
        <span>{{ session('message') }}</span>
    </div>
@endif
@endsection
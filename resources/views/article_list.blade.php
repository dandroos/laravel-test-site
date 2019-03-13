@extends('layouts.article')

@section('article_content')
    <div>
        @if (session('message'))
            <div>
                <span>{{ session('message') }}</span>
            </div>
        @endif
        @if(Auth::check())
            <a href="{{route('news_create')}}">Add news story</a>
        @endif
        <div>
            @if(count($articles) > 0)
                @foreach ($articles as $article)
                    @if($article->image)
                        <img src="{{ asset($article->image->url)}}" alt="article featured image" style="max-width: 65%;">
                    @endif
                    <h3>{{ $article->title }}</h3>
                    <div>{{ $article->created_at->format('jS F Y') }}</div>
                    <div>{!! nl2br($article->body) !!}</div>
                    @if (Auth::check())
                        <a href="{{route('news_edit', [ 'id' => $article->id ]) }}">Edit/Delete</a>
                    @endif
                @endforeach
            @else
                <p>There is no news!  They say that is the best kind!</p>
            @endif
        </div>
    </div>
@endsection
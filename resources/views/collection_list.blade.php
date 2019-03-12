@extends('layouts.collection')
@section('collection_content')
    <div>
        @if (session('message'))
            <div>
                <span>{{ session('message') }}</span>
            </div>
        @endif
        @if(Auth::check())
            <div>
                <span>Admin : </span>
                <a href="{{route('collection_create')}}">Add new collection</a>
            </div>
        @endif
        <div>
            @if(count($collections) > 0)
                @foreach ($collections as $collection)
                    <h3>{{ $collection->name }}</h3>
                    <a href="{{ route('collection_view', [
                        'id' => $collection->id    
                    ])}}">
                        @foreach($main_collection_images as $main_collection_image)
                            @if($main_collection_image->collection_id === $collection->id)
                                <img src="{{ asset($main_collection_image->file_path )}}" alt="collection featured image" style="max-width: 65%;">
                                @break
                            @endif
                        @endforeach
                    </a>
                    <div>{!! nl2br($collection->description) !!}</div>
                    <a href="{{ route('collection_view', [
                        'id' => $collection->id    
                    ])}}">Browse</a>
                    @if (Auth::check())
                        <a href="{{ route('collection_edit', [ 'id' => $collection->id])}}">Edit/Delete</a>
                    @endif
                @endforeach
            @else
                <p>There are no collections!</p>
            @endif
        </div>
    </div>
@endsection
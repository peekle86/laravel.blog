@extends('layouts.main')

@section('title', $post->title . ' | LARAVEL.BLOG')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-between">
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-arrow-left pe-1"></i>Back</a>
            <span>Category: <a href="{{ route('category.articles', ['slug' => $post->category->slug]) }}" class="btn btn-secondary badge m-1">{{ $post->category->title }}</a></span>
        </div>

        <hr class="my-4">
        <h1>{{ $post->title }}</h1>
        <p class="text-muted">{{ $post->getPostDate() }}</p>

        <hr class="my-4">

        <div>
            {!! $post->body !!}
        </div>

        <hr class="my-4">

        @if($post->tags->count())
            <p>Tags:
                @foreach($post->tags as $tag)
                    <a href="{{ route('tag.articles', ['slug' => $tag->slug]) }}" class="btn btn-secondary badge m-1">{{ $tag->title }}</a>
                @endforeach
            </p>
        @endif


    </div>

@endsection

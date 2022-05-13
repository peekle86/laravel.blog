@extends('layouts.main')

@section('title', 'Home page | LARAVEL.BLOG')

@section('header')

    @if($firstPost)
    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
        <a href="{{ route('site.article', ['slug' => $firstPost->slug]) }}" class="h1 display-4 fst-italic link-light">{{ $firstPost->title }}</a>
        <p class="lead my-3">{{ Illuminate\Support\Str::limit(strip_tags($firstPost->body)) }}</p>
        <div class="d-flex justify-content-between mt-4">
            <p class="lead mb-0"><a href="{{ route('site.article', ['slug' => $firstPost->slug]) }}" class="link-light fw-bold">Continue reading</a></p>
            <a href="{{ route('category.articles', ['slug' => $firstPost->category->slug]) }}" class="btn btn-light text-dark badge">{{ $firstPost->category->title }}</a>
        </div>
    </div>
    @endif

    <div class="row mb-2">
        @if($secondPost)
        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <a href="{{ route('site.article', ['slug' => $secondPost->slug]) }}" class="h3 link-dark mb-0">{{ $secondPost->title }}</a>
                    <div class="mb-1 text-muted">{{ $secondPost->getPostDate() }}</div>
                    <p class="card-text mb-auto">{{ Illuminate\Support\Str::limit(strip_tags($secondPost->body)) }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('site.article', ['slug' => $secondPost->slug]) }}">Continue reading</a>
                        <a href="{{ route('category.articles', ['slug' => $secondPost->category->slug]) }}" class="btn btn-secondary badge">{{ $secondPost->category->title }}</a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($thirdPost)
        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <a href="{{ route('site.article', ['slug' => $thirdPost->slug]) }}" class="h3 link-dark mb-0">{{ $thirdPost->title }}</a>
                    <div class="mb-1 text-muted">{{ $thirdPost->getPostDate() }}</div>
                    <p class="mb-auto">{{ Illuminate\Support\Str::limit(strip_tags($thirdPost->body)) }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('site.article', ['slug' => $thirdPost->slug]) }}">Continue reading</a>
                        <a href="{{ route('category.articles', ['slug' => $thirdPost->category->slug]) }}" class="btn btn-secondary badge">{{ $thirdPost->category->title }}</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

@endsection

@section('content')

    <h3 class="pb-4 mb-4 fst-italic border-bottom">
        From the depth of the rocks
    </h3>

    @foreach($posts as $post)
        <article class="blog-post">
            <a href="{{ route('site.article', ['slug' => $post->slug]) }}" class="h2 blog-post-title link-dark">{{ $post->title }}</a>
            <p class="blog-post-meta text-muted">{{ $post->getPostDate() }}</p>
            <a href="{{ route('category.articles', ['slug' => $post->category->slug]) }}" class="btn btn-secondary badge m-1">{{ $post->category->title }}</a>
            <p>{{ Illuminate\Support\Str::limit(strip_tags($thirdPost->body), 300) }}</p>
            <a href="{{ route('site.article', ['slug' => $post->slug]) }}">Continue reading</a>
        </article>
        <hr class="my-4">
    @endforeach


    <div class="d-flex justify-content-center">
        <a href="{{ route('site.articles') }}" class="btn btn-link">Show more articles</a>
    </div>

@endsection

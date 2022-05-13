@extends('layouts.main')

@section('title', $tag->title . ' tag | LARAVEL.BLOG')


@section('content')

    <h3 class="pb-4 mb-4 fst-italic border-bottom">
        Articles with {{ $tag->title }} tag
    </h3>

    @foreach($posts as $post)
        <article class="blog-post">
            <a href="{{ route('site.article', ['slug' => $post->slug]) }}" class="h2 blog-post-title link-dark">{{ $post->title }}</a>
            <p class="blog-post-meta text-muted">{{ $post->getPostDate() }}</p>
            <a href="{{ route('category.articles', ['slug' => $post->category->slug]) }}" class="btn btn-secondary badge m-1">{{ $post->category->title }}</a>
            <p>{{ Illuminate\Support\Str::limit(strip_tags($post->body), 300) }}</p>
            <a href="{{ route('site.article', ['slug' => $post->slug]) }}">Continue reading</a>
        </article>
        <hr class="my-4">
    @endforeach


    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>

@endsection

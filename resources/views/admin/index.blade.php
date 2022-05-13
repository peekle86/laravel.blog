@extends('admin.layouts.main')


@section('title', 'Admin main page | LARAVEL.BLOG')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-center mb-2">
                <h1>Home Page</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row mb-5">
            <div class="col mx-4">
                <div class="info-box bg-primary position-relative">
                    <span class="info-box-icon"><i class="fas fa-edit"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Articles</span>
                        <span class="info-box-number">{{ $posts->count() }}</span>
                    </div>
                    <a href="{{ route('posts.index') }}" class="stretched-link"></a>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('posts.create') }}" class="btn btn-outline-primary"><i class="fas fa-plus-circle pr-2"></i>New article</a>
                </div>
            </div>
            <div class="col mx-4">
                <div class="info-box bg-dark position-relative">
                    <span class="info-box-icon"><i class="fas fa-archive"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Categories</span>
                        <span class="info-box-number">{{ $categories->count() }}</span>
                    </div>
                    <a href="{{ route('categories.index') }}" class="stretched-link"></a>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('categories.create') }}" class="btn btn-outline-dark"><i class="fas fa-plus-circle pr-2"></i>New category</a>
                </div>
            </div>
            <div class="col mx-4">
                <div class="info-box bg-secondary position-relative">
                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tags</span>
                        <span class="info-box-number">{{ $tags->count() }}</span>
                    </div>
                    <a href="{{ route('tags.index') }}" class="stretched-link"></a>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('tags.create') }}" class="btn btn-outline-secondary"><i class="fas fa-plus-circle pr-2"></i>New tag</a>
                </div>
            </div>
        </div>

        @if($lastPost)
        <h3 class="mx-4">Last published article</h3>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <span class="h4">{{ $lastPost->title }}</span>

                    <div class="d-flex ml-auto">
                        <div>
                            <a href="{{ route('posts.edit', ['post' => $lastPost->id]) }}"
                               class="btn btn-info btn-sm mx-3">
                                <i class="fas fa-pencil-alt pr-2"></i>Edit
                            </a>
                        </div>
                        <form action="{{ route('posts.destroy', ['post' => $lastPost->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm float-right"
                                    onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt pr-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <span class="small">Category: <span class="badge badge-dark">{{ $lastPost->category->title }}</span></span>
                @if($lastPost->tags)
                    <hr class="my-1">
                    <span class="small">Tags:
                        @foreach($lastPost->tags as $tag)
                            <span class="badge badge-secondary m-1">{{ $tag->title }}</span>
                        @endforeach
                    </span>
                @endif
                <hr class="mt-2 mb-3">
                {{ Illuminate\Support\Str::limit(strip_tags($lastPost->body), 300) }}
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-muted small">
                {{ $lastPost->getPostDate() }}
            </div>
            <!-- /.card-footer-->
        </div>
        @endif

    </section>
    <!-- /.content -->
@endsection

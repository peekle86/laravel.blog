@extends('admin.layouts.main')


@section('title', 'Create post | LARAVEL.BLOG')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="container">
                    <h1 class="text-center">Create post</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create post</h3>
                        </div>
                        <!-- /.card-header -->

                        <form id="post-form" role="form" method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror" id="title"
                                           placeholder="Title">
                                </div>

                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-primary" onclick="search_image(this)" data-url="{{ route('admin.image.search') }}" data-token="{{ csrf_token() }}">
                                        Search image
                                    </button>
                                    <div id="founded-img" class="m-3"></div>
                                </div>

                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea name="body" id="body" rows="7" hidden></textarea>
                                    <div id="body-edit" contenteditable="true" class="body-input @error('body') is-invalid @enderror"></div>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        @foreach($categories as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <select name="tags[]" id="tags" class="select2" multiple="multiple"
                                            data-placeholder="Select tags" style="width: 100%;">
                                        @foreach($tags as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/imageHandle.js') }}"></script>
@endsection

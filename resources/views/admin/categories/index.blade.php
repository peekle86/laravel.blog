@extends('admin.layouts.main')


@section('title', 'Categories list | LARAVEL.BLOG')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="container">
                    <h1 class="text-center">Categories</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categories list</h3>
            </div>

            <div class="card-body">
                <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create category</a>
                @if(count($categories))
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                                       class="btn btn-info btn-sm float-left mr-1"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                          method="POST" class="float-left">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center my-4">There are no categories yet</p>
                @endif
            </div>

            <div class="card-footer clearfix">
                {{ $categories->links() }}
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

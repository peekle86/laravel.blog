<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="Hugo 0.88.1">
    <title>@yield('title')</title>



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/front/css/blog.css') }}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand navbar-dark bg-dark py-md-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">LARAVEL.BLOG</a>
        <form id="search-form" class="d-flex" method="get" action="{{ route('search') }}">
            <div class="input-group">
                <input id="search-input" name="q" class="form-control" type="search" placeholder="Search" aria-label="Search" aria-describedby="search-button">
                <button id="search-button" class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>
</nav>

<div class="container">



    <div class="nav-scroller py-1 mt-3 mb-5">
        <nav class="nav d-flex justify-content-between">
            @foreach($menuCategories as $mc)
                <a class="p-2 link-secondary" href="{{ route('category.articles', ['slug' => $mc->slug]) }}">{{ $mc->title }}</a>
            @endforeach
        </nav>
    </div>
</div>

<main class="container">

    @yield('header')

    <div class="row g-5">
        <div class="col-md-8 min-vh-100">

            @yield('content')

        </div>

        <div class="col-md-4">
            @include('layouts/_sidebar')
        </div>
    </div>

</main>

<footer class="footer mt-5">
    <div class="container">

        <div class="row my-4 mx-2 mb-auto ">
            <span>LARAVEL.BLOG 2022</span>

            <span>Powered by <a href="https://www.laravel.com/" rel="external">Laravel</a></span>
        </div>

    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
    document.addEventListener('submit', submitForm);
    function submitForm(e) {
        e.preventDefault();
        let form = document.getElementById('search-form'),
            input = document.getElementById('search-input');

        if(input.value.trim() !== '') {
            form.submit()
        }
    }
</script>
</body>
</html>

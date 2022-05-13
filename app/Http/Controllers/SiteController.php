<?php

namespace App\Http\Controllers;

use App\Models\Post;

class SiteController extends Controller
{

    /**
     * Home page of blog
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::with('category')
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();

        return view('site.index', [
            'firstPost' => $posts->shift(), // newest post will shown in header
            'secondPost' => $posts->shift(), // second\
            'thirdPost' => $posts->shift(), //          and third posts wil shown in header under first
            'posts' => $posts
        ]);
    }

    /**
     * Page with all articles
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function articles()
    {
        $posts = Post::with('category')->paginate(2);

        return view('site/articles', [
            'posts' => $posts
        ]);
    }

    /**
     * Page with specific article
     *
     * Finds by slug and returning 404 error if article with that slug doesnt exists
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with('tags')->firstOrFail(); // 404 error if doesnt exists

        return view('site.show', [
            'post' => $post
        ]);
    }

}

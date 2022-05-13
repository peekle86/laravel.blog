<?php

namespace App\Http\Controllers;


use App\Models\Tag;

class TagController extends Controller
{

    /**
     * Page shows all articles with {$slug} tag
     *
     * Return 404 error page if tag doesnt exist
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail(); // 404 error if doesnt exist

        $posts = $tag->posts()->with('category')->orderBy('id', 'desc')->paginate(1);

        return view('tag.show', [
            'tag' => $tag,
            'posts' => $posts
        ]);
    }

}

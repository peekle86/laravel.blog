<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{

    /**
     * Shows all posts by the {$slug} category
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail(); // 404 error if doesnt exists

        $posts = $category->posts()->orderBy('id', 'desc')->paginate(10);

        return view('category.show', [
            'category' => $category,
            'posts' => $posts
        ]);
    }

}

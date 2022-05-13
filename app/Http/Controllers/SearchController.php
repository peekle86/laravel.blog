<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    /**
     * Shows results of searching articles by title
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $request->validate([
            'q' => 'required'
        ]);

        $q = $request->q;
        $posts = Post::like($q)->with('category')->paginate(1);

        return view('search.index', compact('posts', 'q'));
    }

}

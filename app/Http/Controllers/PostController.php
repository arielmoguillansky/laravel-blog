<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        // return view('posts.index', ['posts' => Post::latest()->filter(request(['search', 'category', 'author']))->get()]);
        return view('posts.index', ['posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(20)->withQueryString()]);
    }

    public function show(Post $post)
    {
        // Name convention: views should be named from the Controller name and the method
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function getPosts()
    {
        // Filter method
        Post::latest()->filter()->get();
    //     $posts = Post::latest();
    //     if(request('search')) {
    //         $posts->where('title', 'like', '%'.request('search').'%')
    //         ->orWhere('body', 'like', '%'.request('search').'%');
    //     }
    //     return $posts->get();
      
    }
}

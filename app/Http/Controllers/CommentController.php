<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Post $post, Request $request)
    {
        $validation = request()->validate([
            'comment' => 'required'
        ]);

        if(!$validation)
        {
            throw ValidationException::withMessages(['comment' => 'Comment should not be empty']); 
        }

        $post->comments()->create([
            'body' => $request->input('comment'),
            'user_id' => $request->user()->id
        ]);
        
        return back();
    }
}

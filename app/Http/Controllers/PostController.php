<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $post = Post::make();
        $post->user_id = Auth::user()->id;
        $post->content = $request->postContent;
        $post->save();
    }
}

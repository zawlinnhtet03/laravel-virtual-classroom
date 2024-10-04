<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class Setting extends Controller
{
    // index page setting
    public function index()
    {
        $posts = Post::all();
        return view('setting.settings', compact('posts'));
    }
}

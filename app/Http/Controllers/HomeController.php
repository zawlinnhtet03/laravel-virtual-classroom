<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    /** home dashboard */
    public function index()
    {
        $posts = Post::all();
        return view('dashboard.home', compact('posts'));
        
    }

    /** profile user */
    public function userProfile()
    {
        $posts = Post::all();
        return view('dashboard.profile', compact('posts'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        $posts = Post::all();
        return view('dashboard.profile_edit', compact('user','posts'));
    }

    /** teacher dashboard */
    public function teacherDashboardIndex()
    {
        $posts = Post::all();
        return view('dashboard.teacher_dashboard',compact('posts'));
    }

    /** student dashboard */
    public function studentDashboardIndex()
    {
        $posts = Post::all();
        return view('dashboard.student_dashboard',compact('posts'));
    }
}
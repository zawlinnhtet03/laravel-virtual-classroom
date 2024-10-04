<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use App\Models\QuizAttempt;
use App\Models\Post;
use Auth;

class QuizSubmissionController extends Controller
{
    public function index()
    {
        $teacherId = auth()->user()->teacher->id;
        $posts = Post::all();
        
        // Get all quizzes created by the teacher
        $quizzes = Quiz::where('created_by', $teacherId)->pluck('id');
        
        // Fetch attempts based on quizzes created by the teacher
        $attempts = QuizAttempt::whereIn('quiz_id', $quizzes)
                            ->with(['quiz', 'student']) // Eager load quiz and student relationships
                            ->get();
        
        return view('quizzes.submissions', compact('attempts','posts'));
    }  
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Toastr;

class QuizController extends Controller
{
    public function index()
    {
        // Get all quizzes created by the authenticated teacher
        $quizzes = Quiz::all();
        $posts = Post::all();
    
        return view('quizzes.index', compact('quizzes','posts'));
    }
    
    public function create()
    {
        $subjects = Subject::all();
        $posts = Post::all();

        return view('quizzes.create', compact('subjects','posts'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'subject_id' => 'required|integer',
        ]);

        // Create a new quiz instance and fill it with validated data
        $quiz = new Quiz();
        $quiz->title = $request->title;
        $quiz->description = $request->description;
        $quiz->start_time = $request->start_time;
        $quiz->end_time = $request->end_time;
        $quiz->subject_id = $request->subject_id;
        $quiz->created_by = auth()->user()->teacher->id; // Assuming you have user authentication

        // Save the quiz to the database
        $quiz->save();

        // Display a success message and redirect to the quizzes index page
        // Toastr::success('Quiz created successfully.');
        return redirect()->route('quizzes.index')
                        ->with('success', 'Quiz updated successfully.');;
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $posts = Post::all();
        return view('quizzes.edit', compact('quiz','posts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy($id)
    {
        // Find the quiz by ID
        $quiz = Quiz::findOrFail($id);

        // Delete the quiz
        $quiz->delete();

        // Display a success message and redirect to the quizzes index page
        // Toastr::success('Quiz deleted successfully.');
        return redirect()->route('quizzes.index')
                        ->with('success', 'Quiz deleted successfully.');
    }

    public function results($attemptId)
    {
        $quizAttempt = QuizAttempt::with(['quiz.questions', 'submissions'])->find($attemptId);
        $posts = Post::all();

        if (!$quizAttempt) {
            return redirect()->route('quizzes.index')->with('error', 'Quiz attempt not found.');
        }

        return view('quizzes.results', compact('quizAttempt','posts'));
    } 
}

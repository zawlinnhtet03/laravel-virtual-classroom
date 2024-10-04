<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Subject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Toastr;


class QuestionController extends Controller
{
    public function index(Quiz $quiz)
    {
        // Eager load questions to reduce queries
        $questions = $quiz->questions;
        $posts = Post::all();
        return view('questions.index', compact('quiz', 'questions','posts'));
    }

    // Show the create question form
    public function create(Quiz $quiz)
    {
        $posts = Post::all();
        return view('questions.create', compact('quiz','posts'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question' => 'required|string',
            'options' => 'required|array|min:2', // At least two options are required
            'correct_answer' => 'required|integer|min:1|max:4', // Ensure it matches one of the options
        ]);

        $question = new Question();
        $question->quiz_id = $quiz->id;  // Use the quiz ID directly from the model
        $question->question = $request->input('question');
        $question->options = $request->input('options');
        $question->correct_answer = $request->input('correct_answer');
        $question->save();

        return redirect()->route('questions.create', $quiz->id)->with('success', 'Question added successfully.');
    }

     // Show the form for editing the specified question
     public function edit(Question $question)
     {
        $posts = Post::all();
         // Pass the question to the edit view
         return view('questions.edit', compact('question','posts'));
     }
 
     // Update the specified question in the database
     public function update(Request $request, Question $question)
    {
        // Validate the request data
        $request->validate([
            'question' => 'required|string|max:255',
            'options' => 'required|json',
            'correct_answer' => 'required|integer|min:1|max:4', // Restrict correct_answer to 1-4
        ]);

        // Update the question with the validated data
        $question->update([
            'question' => $request->question,
            'options' => json_decode($request->options, true),
            'correct_answer' => $request->correct_answer,
        ]);

        // Redirect back to the questions index page with a success message
        return redirect()->route('questions.index', $question->quiz_id)
                        ->with('success', 'Question updated successfully.');
    }

    // public function destroy($id)
    // {
    //     $question = Question::findOrFail($id);
    //     $question->delete();
    //     return redirect()->route('quizzes.show', $question->quiz_id)->with('success', 'Question deleted successfully.');
    // }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index', $question->quiz_id)->with('success', 'Question deleted successfully.');
    }

    // public function deleteAll(Request $request)
    // {
    //     $quizId = $request->input('quiz_id');
    //     Question::where('quiz_id', $quizId)->delete();

    //     // return response()->json(['success' => true]);
    //     return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
    // }

    // In QuestionController.php
    // public function deleteAll(Request $request)
    // {
    //     $quizId = $request->input('quiz_id');
    //     // Ensure you have validation and authorization logic here
    //     Question::where('quiz_id', $quizId)->delete();
    //     return response()->json(['message' => 'All questions deleted successfully.']);
    // }

}


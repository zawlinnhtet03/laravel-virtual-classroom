<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizSubmission;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class QuizAttemptController extends Controller
{
    public function start($quizId)
    {
        // Fetch the quiz with its associated questions and options
        $quiz = Quiz::with('questions')->find($quizId);
        $posts = Post::all();
    
        $existingAttempt = QuizAttempt::where('quiz_id', $quizId)
            ->where('student_id', auth()->user()->user_id)
            ->first();
    
        if ($existingAttempt) {
            return redirect()->route('quizzes.results', $existingAttempt->id)
                ->with('info', 'You have already attempted this quiz.');
        }
    
        if (!$quiz) {
            return redirect()->route('quizzes.index')->with('error', 'Quiz not found.');
        }
    
        // Check if quiz has questions
        if ($quiz->questions->isEmpty()) {
            return redirect()->route('quizzes.index')->with('error', 'No questions available for this quiz.');
        }
    
        // Create a new quiz attempt
        $attempt = QuizAttempt::create([
            'quiz_id' => $quizId,
            'student_id' => auth()->user()->user_id, // This line should capture the correct student ID
            'started_at' => now(),
        ]);
    
        // Pass the quiz and attempt to the view
        return view('quizzes.attempt', compact('quiz','posts','attempt'));
    }
    

    public function submit(Request $request, $attemptId)
    {
        // Fetch the quiz attempt with related quiz and questions
        $quizAttempt = QuizAttempt::with('quiz.questions')->find($attemptId);
        
        if (!$quizAttempt) {
            return redirect()->route('quizzes.index')->with('error', 'Quiz attempt not found.');
        }

        $answers = $request->input('answers', []); // Fetch the submitted answers or an empty array

        foreach ($quizAttempt->quiz->questions as $question) {
            $selectedOption = $answers[$question->id] ?? null; // Get the selected option for the question

            if ($selectedOption === null) {
                continue; // Skip if no answer was provided
            }

            $isCorrect = ($selectedOption == $question->correct_answer); // Check if the selected option is correct

            // Create a quiz submission record
            QuizSubmission::create([
                'quiz_attempt_id' => $quizAttempt->id,
                'question_id' => $question->id,
                'selected_option' => $selectedOption,
                'is_correct' => $isCorrect,
            ]);
        }

        // Calculate the score
        $score = QuizSubmission::where('quiz_attempt_id', $quizAttempt->id)
            ->where('is_correct', true)
            ->count();

        // Update the quiz attempt with the score
        $quizAttempt->update([
            'completed_at' => now(),
            'score' => $score,
        ]);

        return redirect()->route('quizzes.results', $quizAttempt->id)->with('success', 'Quiz submitted successfully!');
    }  
}



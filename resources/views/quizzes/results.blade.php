@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Quiz Results</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('quizzes.index') }}">Quizzes</a></li>
                        <li class="breadcrumb-item active">Quiz Results</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Results for {{ $quizAttempt->quiz->title }}</h4>
            </div>
            <div class="card-body">
                <h5>Your Score: {{ $quizAttempt->score }} / {{ $quizAttempt->quiz->questions->count() }}</h5>
                <div class="mt-4">
                    <h5>Questions and Answers:</h5>
                    @foreach($quizAttempt->quiz->questions as $question)
                        <div class="mb-3">
                            <p><strong>{{ $question->question }}</strong></p>
                            @php
                                $options = $question->options;
                                $submission = $quizAttempt->submissions->where('question_id', $question->id)->first();
                            @endphp
                            @foreach($options as $optionIndex => $option)
                                <p>{{ $optionIndex + 1 }}. {{ $option }}</p>
                            @endforeach
                            <p><strong>Your Answer:</strong> {{ $options[$submission->selected_option - 1] ?? 'Not Answered' }}</p>
                            <p><strong>Correct Answer:</strong> {{ $options[$question->correct_answer - 1] }}</p>
                            <p>
                                @if($submission && $submission->is_correct)
                                    <span class="text-success">Correct</span>
                                @else
                                    <span class="text-danger">Incorrect</span>
                                @endif
                            </p>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

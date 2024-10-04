    @extends('layouts.master')

    @section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ $quiz->title }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('quizzes.index') }}">Quizzes</a></li>
                            <li class="breadcrumb-item active">Quiz Attempt</li>
                        </ul>
                    </div>
                </div>
            </div>

            <form action="{{ route('quiz_attempts.submit', $attempt->id) }}" method="POST">
                @csrf
                @foreach($quiz->questions as $index => $question)
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>{{ $index + 1 }}. {{ $question->question }}</h5>
                        </div>
                        <div class="card-body">
                            @if(is_array($question->options) || is_object($question->options))
                                @foreach($question->options as $optionIndex => $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="{{ $optionIndex + 1 }}" id="option{{ $question->id }}_{{ $optionIndex }}">
                                        <label class="form-check-label" for="option{{ $question->id }}_{{ $optionIndex }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <p>No options available for this question.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit Quiz</button>
            </form>
        </div>
    </div>
    @endsection

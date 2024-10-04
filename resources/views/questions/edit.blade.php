@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Question</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('quizzes.index') }}">Quizzes</a></li>
                        <li class="breadcrumb-item active">Edit Question</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('questions.update', $question->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="question">Question</label>
                                <input type="text" class="form-control" id="question" name="question" value="{{ old('question', $question->question) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="options">Options (JSON format)</label>
                                <textarea class="form-control" id="options" name="options" rows="4" required>{{ old('options', json_encode($question->options)) }}</textarea>
                                <small class="form-text text-muted">Enter options as a JSON array. Example: ["Option 1", "Option 2", "Option 3", "Option 4"]</small>
                            </div>
                            <div class="form-group">
                                <label for="correct_answer">Correct Answer</label>
                                <input type="number" class="form-control" id="correct_answer" name="correct_answer" value="{{ old('correct_answer', $question->correct_answer) }}" required min="1" max="4">
                                <small class="form-text text-muted">Specify the index of the correct answer (1-4).</small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Question</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Question</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('quizzes.index') }}">Quizzes</a></li>
                        <li class="breadcrumb-item active">Edit Question</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('questions.update', $question->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="question">Question</label>
                                <input type="text" class="form-control" id="question" name="question" value="{{ old('question', $question->question) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="options">Options (JSON format)</label>
                                <textarea class="form-control" id="options" name="options" rows="4" required>{{ old('options', json_encode($question->options)) }}</textarea>
                                <small class="form-text text-muted">Enter options as a JSON array. Example: ["Option 1", "Option 2", "Option 3", "Option 4"]</small>
                            </div>
                            <div class="form-group">
                                <label for="correct_answer">Correct Answer</label>
                                <input type="number" class="form-control" id="correct_answer" name="correct_answer" value="{{ old('correct_answer', $question->correct_answer) }}" required min="1" max="4">
                                <small class="form-text text-muted">Specify the index of the correct answer (1-4).</small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Question</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

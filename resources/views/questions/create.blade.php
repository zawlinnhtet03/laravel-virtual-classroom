@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Question to Quiz: {{ $quiz->title }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('quizzes.index') }}">Quizzes</a></li>
                        <li class="breadcrumb-item active">Add Question</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('questions.store', $quiz->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                            
                            <div class="form-group">
                                <label>Question</label>
                                <textarea name="question" class="form-control" rows="3" required>{{ old('question') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Option 1</label>
                                <input type="text" name="options[]" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Option 2</label>
                                <input type="text" name="options[]" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Option 3</label>
                                <input type="text" name="options[]" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Option 4</label>
                                <input type="text" name="options[]" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Correct Answer</label>
                                <select name="correct_answer" class="form-control" required>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                    <option value="4">Option 4</option>
                                </select>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Add Question</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>          
</div>
@endsection

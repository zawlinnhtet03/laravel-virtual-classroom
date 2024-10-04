@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Quiz</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('quizzes.index') }}">Quizzes</a></li>
                        <li class="breadcrumb-item active">Edit Quiz</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Quiz Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $quiz->title) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $quiz->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="start_time">Start Time</label>
                                <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{ old('start_time', $quiz->start_time ? $quiz->start_time->format('Y-m-d\TH:i') : '') }}">
                            </div>
                            <div class="form-group">
                                <label for="end_time">End Time</label>
                                <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ old('end_time', $quiz->end_time ? $quiz->end_time->format('Y-m-d\TH:i') : '') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Quiz</button>
                                <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




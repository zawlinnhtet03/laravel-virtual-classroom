@extends('layouts.master')

@section('content')
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Create Quiz</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('quizzes.index') }}">Quizzes</a></li>
                            <li class="breadcrumb-item active">Create Quiz</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Quiz Form -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('quizzes.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                    @if($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                                    @if($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="subject_id">Subject</label>
                                    <select class="form-control" id="subject_id" name="subject_id" required>
                                        <option value="">Select Subject</option>
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label for="start_time">Start Time</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{ old('start_time') }}">
                                    @if($errors->has('start_time'))
                                        <span class="text-danger">{{ $errors->first('start_time') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="end_time">End Time</label>
                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ old('end_time') }}">
                                    @if($errors->has('end_time'))
                                        <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                    @endif
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Create Quiz</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Quiz Form -->
        </div>
    </div>
@endsection

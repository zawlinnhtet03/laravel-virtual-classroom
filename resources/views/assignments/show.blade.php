@extends('layouts.master')

@section('content')
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Assignment Details</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('assignments.index') }}">Assignments</a></li>
                            <li class="breadcrumb-item active">Assignment Details</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>{{ $assignment->title }}</h4>
                            <p><strong>Description:</strong></p>
                            <p>{{ $assignment->description }}</p>
                            <p><strong>Due Date:</strong> {{ $assignment->due_date->format('d, M, Y') }}</p>

                            @if($assignment->attachment)
                                <div class="form-group">
                                    <label for="attachment">Attachment:</label>
                                    <a href="{{ asset('storage/'  . $assignment->attachment) }}" class="btn btn-primary" download>
                                        <i class="fas fa-download"></i> Download Attachment
                                    </a>
                                </div>
                            @endif

                            @if (Session::get('role_name') === 'Student')
                            <form action="{{ route('assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="attachment">Upload Submission</label>
                                    <input type="file" class="form-control" id="attachment" name="attachment" required>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="comments">Comments (Optional)</label>
                                    <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                                </div> -->

                                <button type="submit" class="btn btn-primary">Submit Assignment</button>
                            </form>
                            @endif

                            <div class="form-group text-end">
                                <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Back to Assignments</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

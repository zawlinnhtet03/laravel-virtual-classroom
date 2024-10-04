    @extends('layouts.master')

    @section('content')
        {!! Toastr::message() !!}
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Add New Assignment</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('assignments.index') }}">Assignments</a></li>
                                <li class="breadcrumb-item active">Add Assignment</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="due_date">Due Date</label>
                                        <input type="date" class="form-control" id="due_date" name="due_date" required>
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
                                        <label for="attachment">Attachment</label>
                                        <input type="file" class="form-control" id="attachment" name="attachment">
                                        <small class="form-text text-muted">Optional: Upload any related files.</small>
                                    </div>

                                    <div class="form-group text-end">
                                        <button type="submit" class="btn btn-primary">Save Assignment</button>
                                        <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection

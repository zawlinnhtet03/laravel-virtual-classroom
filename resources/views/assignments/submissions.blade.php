@extends('layouts.master')

@section('content')
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Assignments</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Assignments</li>
                        </ul>
                    </div>
                    @if (Session::get('role_name') === 'Teachers')
                        <div class="col-auto text-end float-end ms-auto">
                            <a href="{{ route('assignments.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Assignment
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Submitted Assignments Table Card for students -->
            @if (Session::get('role_name') === 'Student')
                @php
                    $studentId = auth()->user()->student->id;
                    $submittedAssignments = $assignments->filter(function ($assignment) use ($studentId) {
                        return $assignment->submissions->where('student_id', $studentId)->isNotEmpty();
                    });
                @endphp
                @if ($submittedAssignments->isNotEmpty())
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4 class="card-title">Submitted Assignments</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border-0 table-hover table-center mb-0 datatable table-striped">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Submission Date</th>
                                        <th>Submission</th>
                                        <th>Comments</th>
                                        <th>Grade</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($submittedAssignments as $assignment)
                                        @foreach($assignment->submissions->where('student_id', $studentId) as $submission)
                                            <tr>
                                                <td>{{ $assignment->title }}</td>
                                                <td>{{ $submission->created_at->format('d, M, Y') }}</td>
                                                <td>
                                                    @if ($submission->file_path)
                                                        <a href="{{ asset('storage/'  . $submission->file_path) }}" target="_blank">View/</a>
                                                        <a href="{{ asset('storage/' . $submission->file_path) }}" download> Download</a>
                                                    @else
                                                        No Attachment
                                                    @endif
                                                </td>
                                                <td>{{ $submission->feedback }}</td>
                                                <td>{{ $submission->grade }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('assignment_submissions.edit', $submission->id) }}" class="btn btn-sm bg-warning-light">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <a href="#" class="btn btn-sm bg-danger-light delete-submission" data-bs-toggle="modal" data-bs-target="#deleteSubmissionModal" data-id="{{ $submission->id }}">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info mt-4">
                        <strong>No submissions available.</strong> Please check back later.
                    </div>
                @endif
            @endif

            <!-- Submitted Assignments Table Card for teacher -->
            @if (Session::get('role_name') === 'Teachers')
                @php
                    $teacherId = auth()->user()->teacher->id; // Get the currently logged-in teacher's ID
                @endphp

                @php
                    // Filter assignments to only include those created by the current teacher
                    $teacherAssignments = $assignments->filter(function ($assignment) use ($teacherId) {
                        return $assignment->created_by === $teacherId;
                    });
                @endphp

                @if ($teacherAssignments->pluck('submissions')->flatten()->isNotEmpty())
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4 class="card-title">Submitted Assignments</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border-0 table-hover table-center mb-0 datatable table-striped">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Student</th>
                                        <th>Submission Date</th>
                                        <th>Submission</th>
                                        <th>Comments</th>
                                        <th>Grade</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($teacherAssignments as $assignment)
                                        @foreach($assignment->submissions as $submission)
                                            <tr>
                                                <td>{{ $assignment->title }}</td>
                                                <td>{{ $submission->student->full_name }}</td>
                                                <td>{{ $submission->created_at->format('d, M, Y') }}</td>
                                                <td>
                                                    @if ($submission->file_path)
                                                        <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank">View/  </a>
                                                        <a href="{{ asset('storage/' . $submission->file_path) }}" download> Download</a>

                                                    @else
                                                        No Attachment
                                                    @endif
                                                </td>
                                                <td>
                                                    <textarea form="updateSubmissionForm{{ $submission->id }}" name="feedback" class="form-control" rows="1">{{ $submission->feedback }}</textarea>
                                                </td>
                                                <td>
                                                    <input form="updateSubmissionForm{{ $submission->id }}" type="number" name="grade" value="{{ $submission->grade }}" min="0" max="10" step="1" class="form-control">
                                                </td>
                                                <td class="text-end">
                                                    <!-- Single form for updating both feedback and grade -->
                                                    <form id="updateSubmissionForm{{ $submission->id }}" action="{{ route('assignment_submissions.update', $submission->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            <i class="fas fa-save"></i> Save
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info mt-4">
                        <strong>No submissions available.</strong> Please check back later.
                    </div>
                @endif
            @endif

            <!-- Delete Submission Modal -->
            <div class="modal fade" id="deleteSubmissionModal" tabindex="-1" role="dialog" aria-labelledby="deleteSubmissionModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteSubmissionModalLabel">Delete Submission</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="deleteSubmissionForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <p>Are you sure you want to delete this submission?</p>
                                <input type="hidden" name="id" id="submissionId">
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @section('script')
                <script>
                    $(document).on('click', '.delete-submission', function() {
                        var id = $(this).data('id');
                        var url = "{{ route('assignment_submissions.destroy', ':id') }}".replace(':id', id);
                        $('#deleteSubmissionForm').attr('action', url);
                        $('#submissionId').val(id);
                    });
                </script>
            @endsection
        </div>
    </div>
@endsection

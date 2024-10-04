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

            <!-- Assignments Table Card for student -->
            @if (Session::get('role_name') === 'Student')
                @if ($assignments->isNotEmpty())
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Assignments</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border-0 table-hover table-center mb-0 datatable table-striped">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Due Date</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($assignments as $assignment)
                                        <tr>
                                            <td>{{ $assignment->title }}</td>
                                            <td>{{ Str::limit($assignment->description, 50) }}</td>
                                            <td>{{ $assignment->due_date->format('d, M, Y') }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('assignment_submissions.show', $assignment->id) }}" class="btn btn-sm bg-info-light">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info mt-4">
                        <strong>No assignments available.</strong> Please check back later.
                    </div>
                @endif
            @endif

            <!-- Assignments Table Card for teacher -->
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

                @if ($teacherAssignments->isNotEmpty())
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Assignments</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border-0 table-hover table-center mb-0 datatable table-striped">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Due Date</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($teacherAssignments as $assignment)
                                        <tr>
                                            <td>{{ $assignment->title }}</td>
                                            <td>{{ Str::limit($assignment->description, 50) }}</td>
                                            <td>{{ $assignment->due_date->format('d, M, Y') }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-primary btn-sm me-2" >
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-warning btn-sm me-2">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="#" class="btn btn-danger btn-sm delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $assignment->id }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info mt-4">
                        <strong>No assignments available.</strong> Please check back later.
                    </div>
                @endif
            @endif


            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Assignment</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <p>Are you sure you want to delete this assignment?</p>
                                <input type="hidden" name="id" id="assignmentId">
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
                    $(document).on('click', '.delete', function() {
                        var id = $(this).data('id');
                        var url = "{{ route('assignments.destroy', ':id') }}".replace(':id', id);
                        $('#deleteForm').attr('action', url);
                        $('#assignmentId').val(id);
                    });
                </script>
            @endsection


        </div>
    </div>
@endsection

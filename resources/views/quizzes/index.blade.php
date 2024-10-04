@extends('layouts.master')

@section('content')
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Quizzes</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Quizzes</li>
                        </ul>
                    </div>
                    @if (Session::get('role_name') === 'Teachers')
                        <div class="col-auto text-end float-end ms-auto">
                            <a href="{{ route('quizzes.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Quiz
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quizzes Table Card for students -->
            @if (Session::get('role_name') === 'Student')
                @if ($quizzes->isNotEmpty())
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Available Quizzes</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border-0 table-hover table-center mb-0 datatable table-striped">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($quizzes as $quiz)
                                        <tr>
                                            <td>{{ $quiz->title }}</td>
                                            <td>{{ Str::limit($quiz->description, 50) }}</td>
                                            <td>{{ $quiz->start_time ? \Carbon\Carbon::parse($quiz->start_time)->format('d, M Y H:i') : 'N/A' }}</td>
                                            <td>{{ $quiz->end_time ? \Carbon\Carbon::parse($quiz->end_time)->format('d, M Y H:i') : 'N/A' }}</td>
                                            <td class="text-end">

                                                @php
                                                    $attempt = \App\Models\QuizAttempt::where('quiz_id', $quiz->id)->where('student_id', auth()->user()->student->id)->first();
                                                @endphp

                                                @if ($attempt)
                                                    <a href="{{ route('quizzes.results', $attempt->id) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-tachometer-alt"></i> View Score
                                                    </a>
                                                @else
                                                    <a href="{{ route('quizzes.start', $quiz->id) }}" class="btn btn-primary btn-sm me-2">
                                                        <i class="fas fa-eye"></i> Start Quiz
                                                    </a>
                                                @endif
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
                        <strong>No quizzes available.</strong> Please check back later.
                    </div>
                @endif
            @endif

            <!-- Quizzes Table Card for teacher -->
            @if (Session::get('role_name') === 'Teachers')
                @php
                    $teacherId = auth()->user()->teacher->id;
                @endphp

                @php
                    $teacherQuizzes = $quizzes->filter(function ($quiz) use ($teacherId) {
                        return $quiz->created_by === $teacherId;
                    });
                @endphp

                @if ($teacherQuizzes->isNotEmpty())
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Your Quizzes</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border-0 table-hover table-center mb-0 datatable table-striped">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($teacherQuizzes as $quiz)
                                        <tr>
                                            <td>{{ $quiz->title }}</td>
                                            <td>{{ Str::limit($quiz->description, 50) }}</td>
                                            <td>{{ $quiz->start_time ? \Carbon\Carbon::parse($quiz->start_time)->format('d, M Y H:i') : 'N/A' }}</td>
                                            <td>{{ $quiz->end_time ? \Carbon\Carbon::parse($quiz->end_time)->format('d, M Y H:i') : 'N/A' }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('questions.index', $quiz->id) }}" class="btn btn-primary btn-sm me-2" title="View Questions">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-warning btn-sm me-2" title="Edit Quiz">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ route('questions.create', $quiz->id) }}" class="btn btn-success btn-sm me-2" title="Add Question">
                                                    <i class="fas fa-plus"></i> Add Question
                                                </a>
                                                <a href="#" class="btn btn-danger btn-sm delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $quiz->id }}" title="Delete Quiz">
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
                        <strong>No quizzes available.</strong> Please check back later.
                    </div>
                @endif
            @endif

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Quiz</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <p>Are you sure you want to delete this quiz?</p>
                                <input type="hidden" name="id" id="quizId">
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
                        var url = "{{ route('quizzes.destroy', ':id') }}".replace(':id', id);
                        $('#deleteForm').attr('action', url);
                        $('#quizId').val(id);
                    });
                </script>
            @endsection

        </div>
    </div>
@endsection

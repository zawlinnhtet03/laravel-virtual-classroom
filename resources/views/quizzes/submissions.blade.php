@extends('layouts.master')

@section('content')
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Quiz Submissions</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Quiz Submissions</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Quiz Attempts Table Card for teachers -->
            @if (Session::get('role_name') === 'Teachers')
                @if ($attempts->isNotEmpty())
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4 class="card-title">Quiz Submissions</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border-0 table-hover table-center mb-0 datatable table-striped">
                                    <thead>
                                    <tr>
                                        <th>Quiz Title</th>
                                        <th>Student</th>
                                        <th>Start Time</th>
                                        <th>Completion Time</th>
                                        <th>Score</th>
                                        <!-- <th class="text-end">Action</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($attempts as $attempt)
                                        <tr>
                                            <td>{{ $attempt->quiz->title ?? 'N/A' }}</td>
                                            <td>{{ $attempt->student->name ?? 'N/A' }}</td>

                                            <td>{{ $attempt->started_at ? $attempt->started_at->format('d, M, Y H:i') : 'N/A' }}</td>
                                            <td>{{ $attempt->completed_at ? $attempt->completed_at->format('d, M, Y H:i') : 'Not Completed' }}</td>
                                            <td>{{ $attempt->score ?? 'N/A' }}</td>
                                            <!-- <td class="text-end"> -->
                                            <!-- Add actions here if needed -->
                                            <!-- </td> -->
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info mt-4">
                        <strong>No quiz submissions available.</strong> Please check back later.
                    </div>
                @endif
            @endif

        </div>
    </div>
@endsection

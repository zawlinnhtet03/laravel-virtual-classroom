@extends('layouts.master')

@section('content')
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Study Materials</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Study Materials</li>
                        </ul>
                    </div>
                    @if (Session::get('role_name') === 'Teachers')
                    <div class="col-auto text-end float-end ms-auto">
                        <a href="{{ route('study_materials.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Study Material
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Study Materials Table Card for student -->
            @if (Session::get('role_name') === 'Student')
                @if ($studyMaterials->isNotEmpty())
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Study Materials</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-0 table-hover table-center mb-0 datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Subject</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($studyMaterials as $material)
                                        <tr>
                                            <td>{{ $material->title }}</td>
                                            <td>{{ Str::limit($material->description, 50) }}</td>
                                            <td>{{ $material->subject->subject_name }}</td>
                                            <td>
                                                @if ($material->file_path)
                                                    <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-sm bg-info-light">
                                                        <i class="fas fa-download"></i> Download
                                                    </a>
                                                @else
                                                    No File
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
                    <strong>No study materials available.</strong> Please check back later.
                </div>
                @endif
            @endif

            <!-- Study Materials Table Card for teachers -->
            @if (Session::get('role_name') === 'Teachers')
                @php
                    $teacherId = auth()->user()->teacher->id; // Get the currently logged-in teacher's ID
                @endphp

                @php
                    // Filter study materials to only include those created by the current teacher
                    $teacherMaterials = $studyMaterials->filter(function ($material) use ($teacherId) {
                        return $material->created_by === $teacherId;
                    });
                @endphp

                @if ($teacherMaterials->isNotEmpty())
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Study Materials</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border-0 table-hover table-center mb-0 datatable table-striped">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Subject</th>
                                            <th>File</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teacherMaterials as $material)
                                            <tr>
                                                <td>{{ $material->title }}</td>
                                                <td>{{ Str::limit($material->description, 50) }}</td>
                                                <td>{{ $material->subject->subject_name }}</td>
                                                <td>
                                                    @if ($material->file_path)
                                                        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-sm bg-info-light">
                                                            <i class="fas fa-download"></i> Download
                                                        </a>
                                                    @else
                                                        No File
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('study_materials.edit', $material->id) }}" class="btn btn-warning btn-sm me-2">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $material->id }}">
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
                        <strong>No study materials available.</strong> Please check back later.
                    </div>
                @endif
            @endif

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Study Material</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <p>Are you sure you want to delete this study material?</p>
                                <input type="hidden" name="id" id="materialId">
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
                        var url = "{{ route('study_materials.destroy', ':id') }}".replace(':id', id);
                        $('#deleteForm').attr('action', url);
                        $('#materialId').val(id);
                    });
                </script>
            @endsection

        </div>
    </div>
@endsection

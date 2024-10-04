@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Students</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('student/list') }}">Student</a></li>
                                <li class="breadcrumb-item active">All Students</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                           

                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>Fig.</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>DOB</th>
                                            <th>Phone</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($studentList as $key => $list)
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="student-details.html" class="avatar avatar-sm me-2">
                                                            <img class="avatar-img rounded-circle" src="{{ Storage::url('student-photos/'.$list->upload) }}" alt="User Image">
                                                        </a>
                                                        <a href="student-details.html">{{ $list->first_name }} {{ $list->last_name }}</a>
                                                    </h2>
                                                </td>
                                                <td>{{ $list->id }}</td>
                                                <td>{{ $list->email }}</td>
                                                <td>{{ $list->full_name }}</td>
                                                <td>{{ $list->date_of_birth }}</td>
                                                <td>{{ $list->phone_number }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a href="{{ route('student/edit', $list->id) }}" class="btn btn-sm bg-danger-light">
                                                            <i class="far fa-edit me-2"></i>
                                                        </a>
                                                        <a class="btn btn-sm bg-danger-light student_delete" data-bs-toggle="modal" data-bs-target="#studentUser" data-id="{{ $list->id }}" data-avatar="{{ $list->upload }}">
                                                            <i class="far fa-trash-alt me-2"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for student delete --}}
    <div class="modal custom-modal fade" id="studentUser" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Student</h3>
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="{{ route('student/delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="row">
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="avatar" class="e_avatar" value="">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn submit-btn" style="border-radius: 5px !important;">Delete</button>
                                </div>
                                <div class="col-6">
                                    <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')
    <script>
        $(document).on('click', '.student_delete', function() {
            var id = $(this).data('id');
            var avatar = $(this).data('avatar');
            $('.e_id').val(id);
            $('.e_avatar').val(avatar);
        });
    </script>
    @endsection
@endsection

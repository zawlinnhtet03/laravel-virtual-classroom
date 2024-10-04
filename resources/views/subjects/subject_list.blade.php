@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Subjects</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Subjects</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>

                                            <th>ID</th>
                                            <th>Name</th>

                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subjectList as $key => $value)
                                            <tr>

                                                <td class="subject_id">{{ $value->subject_id }}</td>
                                                <td>
                                                    <h2>
                                                        <a>{{ $value->subject_name }}</a>
                                                    </h2>
                                                </td>

                                                <td class="text-end">
                                                    <div class="actions">
                                                        @if (Session::get('role_name') !== 'Student')
                                                            <a href="{{ url('subject/edit/' . $value->subject_id) }}"
                                                                class="btn btn-sm bg-danger-light">
                                                                <i class="far fa-edit me-2"></i>
                                                            </a>
                                                        @endif
                                                        <a class="btn btn-sm bg-danger-light delete" data-bs-toggle="modal"
                                                            data-bs-target="#delete">
                                                            <i class="fe fe-trash-2"></i>
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

    {{-- model elete --}}
    <div class="modal custom-modal fade" id="delete" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Subject</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <form action="{{ route('subject/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="subject_id" class="e_subject_id" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary paid-continue-btn"
                                            style="width: 100%;">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <a data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn">Cancel
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')
    {{-- delete js --}}
    <script>
        $(document).on('click', '.delete', function() {
            var _this = $(this).parents('tr');
            $('.e_subject_id').val(_this.find('.subject_id').text());
        });
    </script>
@endsection

@endsection

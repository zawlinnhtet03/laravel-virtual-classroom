@extends('layouts.master')

@section('content')
    {!! Toastr::message() !!}

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit Student</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('student/list') }}">Students</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <form action="{{ route('student/update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $student->user_id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" name="full_name"
                                                value="{{ $student->full_name }}" required>
                                        </div>
                                    </div>


                                    <!-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <input type="text" class="form-control" name="gender" value="{{ $student->gender }}" required>
                                            </div>
                                        </div> -->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" name="phone_number"
                                                value="{{ $student->phone_number }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Religion</label>
                                            <input type="text" class="form-control" name="religion"
                                                value="{{ $student->religion }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Blood Groupp</label>
                                            <input type="text" class="form-control" name="blood_group"
                                                value="{{ $student->blood_group }}" required>
                                        </div>
                                    </div>





                                    <!-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" name="phone_number" value="{{ $student->phone_number }}" required>
                                            </div>
                                        </div> -->

                                    <!-- <div class="col-12 col-sm-4">
                                            <div class="form-group students-up-files">
                                                <label>Upload Student Photo (150px X 150px)</label>
                                                <div class="uplod">
                                                    <label class="file-upload image-upbtn mb-0 @error('upload') is-invalid @enderror">
                                                        Choose File <input type="file" name="upload">
                                                    </label>
                                                    @error('upload')
        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
    @enderror
                                                </div>
                                            </div>
                                        </div> -->

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#full_name').on('change', function() {
            var selectedOption = $(this).find(':selected');
            $('#student_id').val(selectedOption.data('student_id'));
            $('#email').val(selectedOption.data('email'));
        });
    </script>
@endsection

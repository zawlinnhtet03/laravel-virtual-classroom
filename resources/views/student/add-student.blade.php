
@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Add Students</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('student/add/page') }}">Student</a></li>
                                <li class="breadcrumb-item active">Add Students</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('student/add/save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Student Information</h5>
                                        
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Full Name<span class="login-danger">*</span></label>
                                            <select class="select select2s-hidden-accessible @error('full_name') is-invalid @enderror" 
                                                    style="width: 100%;" 
                                                    tabindex="-1" 
                                                    aria-hidden="true" 
                                                    id="full_name" 
                                                    name="full_name">
                                                <option selected disabled>-- Select Name --</option>
                                                @foreach($users as $names)
                                                    <option value="{{ $names->name }}" data-student_id="{{ $names->user_id }}" data-email="{{ $names->email }}" {{ old('full_name') == $names->name ? 'selected' : '' }}>
                                                        {{ $names->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('full_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>E-Mail <span class="login-danger">*</span></label>
                                            <input class="form-control" 
                                                type="text" 
                                                name="email" 
                                                id="email" 
                                                placeholder="Email Address" 
                                                value="{{ old('email') }}" 
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>User ID <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="student_id" id="student_id" placeholder="User ID" value="{{ old('student_id') }}" readonly>
                                        </div>
                                    </div>

 

                               

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Gender <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('gender') is-invalid @enderror" name="gender">
                                                <option selected disabled>Select Gender</option>
                                                <option value="Female" {{ old('gender') == 'Female' ? "selected" :"Female"}}>Female</option>
                                                <option value="Male" {{ old('gender') == 'Male' ? "selected" :""}}>Male</option>
                                                <option value="Others" {{ old('gender') == 'Others' ? "selected" :""}}>Others</option>
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Date Of Birth <span class="login-danger">*</span></label>
                                            <input class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror" name="date_of_birth" type="text" placeholder="DD-MM-YYYY" value="{{ old('date_of_birth') }}">
                                            @error('date_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                 
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Blood Group <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('blood_group') is-invalid @enderror" name="blood_group">
                                                <option selected disabled>Please Select Group </option>
                                                <option value="A" {{ old('blood_group') == 'A' ? "selected" :""}}>A</option>
                                                <option value="B" {{ old('blood_group') == 'B' ? "selected" :""}}>B</option>
                                                <option value="O" {{ old('blood_group') == 'O' ? "selected" :""}}>O</option>
                                                <option value="AB" {{ old('blood_group') == 'AB' ? "selected" :""}}>AB</option>
                                            </select>
                                            @error('blood_group')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Religion <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('religion') is-invalid @enderror" name="religion">
                                                <option selected disabled>Please Select Religion </option>
                                                <option value="Buddha" {{ old('religion') == 'Buddha' ? "selected" :""}}>Buddha</option>
                                                <option value="Christian" {{ old('religion') == 'Christian' ? "selected" :""}}>Christian</option>
                                                <option value="Others" {{ old('religion') == 'Others' ? "selected" :""}}>Others</option>
                                            </select>
                                            @error('religion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                            
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Phone </label>
                                            <input class="form-control @error('phone_number') is-invalid @enderror" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" name="phone_number" placeholder="Enter Phone Number" value="{{ old('phone_number') }}">
                                            @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
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
                                    </div>
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
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
<script>
 // Update the student_id and email fields based on the selected student
 $(document).ready(function() {
    // Check if there's an already selected option
    var selectedOption = $('#full_name').find(':selected');
    
    if (selectedOption.length > 0) {
        var studentId = selectedOption.data('student_id');
        var email = selectedOption.data('email');

        // Set initial values based on the selected option
        if (studentId !== undefined && email !== undefined) {
            $('#student_id').val(studentId);
            $('#email').val(email);
        }
    }

    // Update the student_id and email fields based on the selected student
    $('#full_name').on('change', function() {
        var selectedOption = $(this).find(':selected');
        
        // Ensure the data attributes are accessed properly
        var studentId = selectedOption.data('student_id');
        var email = selectedOption.data('email');

        // Populate the input fields only if data is present
        if (studentId !== undefined && email !== undefined) {
            $('#student_id').val(studentId);
            $('#email').val(email);
        }
    });
});
</script>

@endsection
@endsection


@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Teachers</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="teachers.html">Teachers</a></li>
                        <li class="breadcrumb-item active">Add Teachers</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('teacher/save') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Basic Details</span></h5>
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
                                                <option value="{{ $names->name }}" 
                                                        data-teacher_id="{{ $names->user_id }}" 
                                                        data-email="{{ $names->email }}" 
                                                        {{ old('full_name') == $names->name ? 'selected' : '' }}>
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
                                        <input type="text" class="form-control" name="teacher_id" id="teacher_id" placeholder="User ID" value="{{ old('teacher_id') }}" readonly>
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
                                        <input type="text" class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror" name="date_of_birth" placeholder="DD-MM-YYYY" value="{{ old('date_of_birth') }}">
                                        @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                               
                              
                                <div class="col-12 col-sm-6">
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
                                
                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Address <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Enter address" value="{{ old('address') }}">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                               
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>City <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="Enter City" value="{{ old('city') }}">
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
 // Update the teacher_id and email fields based on the selected teacher
 $(document).ready(function() {
    // Check if there's an already selected option
    var selectedOption = $('#full_name').find(':selected');
    
    if (selectedOption.length > 0) {
        var teacherId = selectedOption.data('teacher_id');
        var email = selectedOption.data('email');

        // Set initial values based on the selected option
        if (teacherId !== undefined && email !== undefined) {
            $('#teacher_id').val(teacherId);
            $('#email').val(email);
        }
    }

    // Update the teacher_id and email fields based on the selected teacher
    $('#full_name').on('change', function() {
        var selectedOption = $(this).find(':selected');
        
        // Ensure the data attributes are accessed properly
        var teacherId = selectedOption.data('teacher_id');
        var email = selectedOption.data('email');

        // Populate the input fields only if data is present
        if (teacherId !== undefined && email !== undefined) {
            $('#teacher_id').val(teacherId);
            $('#email').val(email);
        }
    });
});
</script>

@endsection
@endsection

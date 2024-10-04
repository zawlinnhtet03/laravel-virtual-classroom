@extends('layouts.error')
@section('content')
    <div class="main-wrapper">
        <div class="error-box">
            <h2>Access Denied</h2>
            <p class="h4 font-weight-normal">Please contact the admin to gain access to the other features.</p>
            @if (Session::get('role_name') === 'Student')
                <a href="{{route('student/dashboard')}}" class="btn btn-primary">Back to Home</a>
            @endif 
            @if (Session::get('role_name') === 'Teachers')
                <a href="{{route('teacher/dashboard')}}" class="btn btn-primary">Back to Home</a>
            @endif 
        </div>
    </div>
@endsection




@extends('layouts.master')

@section('content')
    {!! Toastr::message() !!}

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit Teacher</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('teacher/list/page') }}">Teachers</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <form action="{{ route('teacher/update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $teacher->user_id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" name="full_name" value="{{ $teacher->full_name }}" required>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" name="phone_number" value="{{ $teacher->phone_number }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" value="{{ $teacher->address }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city" value="{{ $teacher->city }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
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

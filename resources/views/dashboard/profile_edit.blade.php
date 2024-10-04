<!-- resources/views/dashboard/profile_edit.blade.php -->
@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Edit Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user/profile/page') }}">Profile</a></li>
                        <li class="breadcrumb-item active">Edit Profile</li>
                    </ul>
                </div>
            </div>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Personal Details</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name', $user->name) }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_of_birth">Date of Birth</label>
                                        <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" id="phone_number" class="form-control" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" minlength="8" maxlength="15" pattern="[0-9]{8,15}" required>
                                        <small class="form-text text-muted">Phone number should be between 8 and 15 digits.</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ $user->address }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Avatar</label>
                                        <input type="file" class="form-control" name="avatar">
                                        @if($user->avatar)
                                            <img src="/images/{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail mt-2" style="width: 150px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

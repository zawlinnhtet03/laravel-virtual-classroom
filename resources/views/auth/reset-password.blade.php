@extends('layouts.app')

@section('content')
<div class="login-right">
    <div class="login-right-wrap">
        <h1>Reset Password</h1>
        <p class="account-subtitle">Enter the OTP and your new password</p>

        <form action="{{ route('reset-password') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Email <span class="login-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>OTP <span class="login-danger">*</span></label>
                <input type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" required>
                @error('otp')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>New Password <span class="login-danger">*</span></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Confirm Password <span class="login-danger">*</span></label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
            </div>
        </form>
    </div>
</div>
@endsection

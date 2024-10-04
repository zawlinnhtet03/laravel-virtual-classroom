@extends('layouts.app')

@section('content')
<div class="login-right">
    <div class="login-right-wrap">
        <h1>Forgot Password</h1>
        <p class="account-subtitle">Enter your email to receive an OTP for password reset</p>

        <form action="{{ route('forgot-password.send-otp') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email <span class="login-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Send OTP</button>
            </div>

            <div class="mt-3 text-center">
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Back to Sign In</a>
            </div>
        </form>
    </div>
</div>
@endsection

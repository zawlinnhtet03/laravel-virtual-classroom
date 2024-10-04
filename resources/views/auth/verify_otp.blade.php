@extends('layouts.app')

@section('content')
    <div class="login-right">
        <div class="login-right-wrap">
            <h1>Verify OTP</h1>
            <p class="account-subtitle">Enter the OTP sent to your Gmail to complete registration</p>

            <form action="{{ route('verify-otp.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>OTP <span class="login-danger">*</span></label>
                    <input type="text" id="otp" name="otp" class="form-control" required>
                </div>

                <div class="form-group mb-0">
                    <button class="btn btn-primary btn-block" type="submit">Verify OTP</button>
                </div>
            </form>

            <div class="mt-3">
                <button id="resendOtpBtn" class="btn btn-secondary btn-block" onclick="resendOtp()" disabled>Resend OTP</button>
                <p id="cooldownText" class="text-center mt-2">You can resend OTP in <span id="cooldown">60</span> seconds.</p>
            </div>

            <!-- Back to Sign Up Button -->
            <div class="mt-3 text-center">
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">Back to Sign Up</a>
            </div>

        </div>
    </div>

    <script>
    // Cooldown timer
    let cooldownTime = 60; // seconds
    let timer;

    function startCooldown() {
        timer = setInterval(() => {
            cooldownTime--;
            document.getElementById('cooldown').innerText = cooldownTime;
            if (cooldownTime <= 0) {
                clearInterval(timer);
                document.getElementById('resendOtpBtn').disabled = false;
                document.getElementById('cooldownText').innerText = '';
            }
        }, 1000);
    }

    function resendOtp() {
        document.getElementById('resendOtpBtn').disabled = true;
        cooldownTime = 60; // reset cooldown time
        document.getElementById('cooldownText').innerText = 'You can resend OTP in 60 seconds.';
        startCooldown(); // start the cooldown timer

        // Send a POST request to resend OTP
        fetch("{{ route('resend-otp') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({})
        }).then(response => {
            if (response.ok) {
                alert('OTP has been resent to your email.');

                setTimeout(() => {
                    location.reload();
                }, 1000); 
            } else {
                alert('Failed to resend OTP. Please try again later.');
                // Reset cooldown timer if failed
                cooldownTime = 0;
                document.getElementById('resendOtpBtn').disabled = false;
                document.getElementById('cooldownText').innerText = '';
            }
        });
    }

    // Initialize cooldown only on page load
    window.onload = function() {
        startCooldown();
    }
</script>

@endsection
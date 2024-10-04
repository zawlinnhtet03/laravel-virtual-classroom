<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Toastr;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Email does not exist in our records.']);
        }
        
        $otp = rand(100000, 999999); 
        $user->otp = bcrypt($otp);
        $user->otp_sent_at = Carbon::now();
        $user->save();
        
        // Log the OTP or send a test email to ensure it's working
        // Log::info("OTP: $otp");
        Mail::to($user->email)->send(new \App\Mail\SendOTP($otp));
        
        return redirect()->route('reset-password.form');
    }
    

    public function showResetPasswordForm()
    {
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Toastr::error('Email does not exist', 'Error');
            return redirect()->back();
        }

        // Check if OTP is valid by comparing it with the hashed OTP in the database
        if (!Hash::check($request->otp, $user->otp)) {
            Toastr::error('Invalid OTP', 'Error');
            return redirect()->back();
        }

        // Check if the OTP has expired (5-minute expiration time)
        if (Carbon::parse($user->otp_sent_at)->addMinutes(5)->isPast()) {
            Toastr::error('OTP has expired', 'Error');
            return redirect()->back();
        }

        // Reset the password
        $user->password = Hash::make($request->password);
        $user->otp = null; // Clear the OTP after successful password reset
        $user->otp_sent_at = null; // Clear the OTP sent time as well
        $user->save();

        Toastr::success('Password reset successfully', 'Success');
        return redirect()->route('login');
    }
}




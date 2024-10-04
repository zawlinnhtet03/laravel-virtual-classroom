<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Toastr;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    public function showResetPasswordForm($token)
    {
        $user = User::where('otp', $token)->first();
        if (!$user || $user->otp_sent_at->addMinutes(5)->isPast()) {
            Toastr::error('Invalid or expired OTP', 'Error');
            return redirect()->route('forgot-password');
        }

        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$user || Carbon::parse($user->otp_sent_at)->addMinutes(5)->isPast()) {
            Toastr::error('Invalid or expired OTP', 'Error');
            return redirect()->back();
        }

        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->otp_sent_at = null;
        $user->save();

        Toastr::success('Password reset successfully', 'Success');
        return redirect()->route('login');
    }
}


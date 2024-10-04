<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\SendOTP;
use Illuminate\Support\Facades\Mail;
use Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function register()
    {
        $role = DB::table('role_type_users')->get();
        return view('auth.register',compact('role'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users|regex:/^.+@gmail\.com$/i', // Only allow Gmail addresses
            'role_name' => 'required|string|max:255',
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        // Generate OTP
        $otp = rand(100000, 999999); // Simple OTP generation

        // Save OTP and user details temporarily
        session([
            'otp' => $otp,
            'user_data' => $request->all()
        ]);

        // Send OTP to user's email
        Mail::to($request->email)->send(new \App\Mail\SendOTP($otp));

        Toastr::success('An OTP has been sent to your email. Please verify to complete registration.', 'Success');
        return redirect()->route('verify-otp'); // Route to OTP verification page
    }

    public function showOtpVerificationForm()
    {
        $otpSentAt = session('otp_sent_at', now());
        return view('auth.verify_otp', compact('otpSentAt'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);
    
        $otpSentAt = session('otp_sent_at');
        $otpExpiration = Carbon::parse($otpSentAt)->addMinutes(5);
    
        if ($otpExpiration->isPast()) {
            Toastr::error('The OTP has expired. Please request a new one.', 'Error');
            return redirect()->route('verify-otp');
        }
    
        if ($request->otp == session('otp')) {
            // OTP is correct, proceed with registration
            $userData = session('user_data');
    
            // Create user
            User::create([
                'name'      => $userData['name'],
                'avatar'    => $userData['image'],
                'email'     => $userData['email'],
                'join_date' => Carbon::now()->toDayDateTimeString(),
                'role_name' => $userData['role_name'],
                'password'  => Hash::make($userData['password']),
            ]);
    
            // Clear session data
            session()->forget(['otp', 'user_data', 'otp_sent_at']);
    
            Toastr::success('Account created successfully!', 'Success');
            return redirect()->route('login');
        } else {
            // OTP is incorrect
            Toastr::error('Invalid OTP, please try again.', 'Error');
            return redirect()->route('verify-otp')->withInput(); // Redirect back with the input
        }
    }
      
    public function resendOtp()
    {
        // Retrieve user data from session
        $userData = session('user_data');
        
        if (!$userData) {
            Toastr::error('Session expired, please register again.', 'Error');
            return redirect()->route('register');
        }
    
        // Generate a new OTP
        $otp = rand(100000, 999999);
    
        // Store OTP and timestamp in session
        session(['otp' => $otp, 'otp_sent_at' => now()]);
    
        // Send OTP to user's email
        Mail::to($userData['email'])->send(new \App\Mail\SendOTP($otp));
    
        Toastr::success('A new OTP has been sent to your email.', 'Success');
        return redirect()->route('verify-otp');
    }  
}

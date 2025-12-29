<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

class PasswordController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);
        
         $user = User::where('email', $request->email)->first();

         // Generate OTP
        $otp = rand(100000, 999999);
        $user->password_otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(2);
        $user->save();
        

        // Send OTP via email
        Mail::raw("Your password reset OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Password Reset OTP');
        });
        
        $notification = [
            'message' => "OTP sent to your email",
            'type' => 'success',
        ];
        
        $request->session()->put('otp_mail',$request->email);
        
        return redirect('otp-verification')->with($notification);
        
    }

    public function otp()
    {
        $email=Session::get('otp_mail');
        
        if(empty($email)){
            return redirect('/');
        }
        
        return view('auth.verify-otp',[
            'email'=>$email
        ]);
    }
    
    public function verify(Request $request)
    {
  
        $request->validate([
            'otp' => 'required|digits:6',
        ]);
        
        $email=Session::get('otp_mail');
        
        $user = User::where('email',$email)
                    ->where('password_otp', $request->otp)
                    ->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        if (Carbon::now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'OTP expired']);
        }
    
        return redirect('reset-password');
        
    }
    public function resend(Request $request)
    {
        
        $email=$request->email;
        $user = User::where('email', $email)->first();

         // Generate OTP
        $otp = rand(100000, 999999);
        $user->password_otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(2);
        $user->save();
        

        // Send OTP via email
        Mail::raw("Your password reset OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Password Reset OTP');
        });
        
        $notification = [
            'message' => "OTP resent to your email",
            'type' => 'success',
        ];
        
        return redirect('otp-verification')->with($notification);
        
    }
    
    public function reset()
    {
        if(empty(Session::get('otp_mail'))){
            return redirect('/');
        }
        
        return view('auth.reset-password');
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);
        
        $email=Session::get('otp_mail');
        
        $user = User::where('email',$email)->first();
        $user->password = Hash::make($request->password);
        $user->password_otp = null;
        $user->otp_expires_at = null;
        $user->save();
        
        $request->session()->forget('otp_mail');
        
        $notification = [
            'message' => "Password reset successfully.",
            'type' => 'success',
        ];
        
        return redirect('/')->with($notification);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class RegistrationController extends Controller {

    public function index() {
        return view('auth.registration', [
            'title' => "User Registration Form",
        ]);
    }

    // Check Duplicate Email
    public function duplicate(Request $request) {
        $email = $request->input('email');
        $result = User::where('email', $email)->exists();
        return response()->json([
                    'exists' => $result
        ]);
    }

    public function registration(Request $request) {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);

        $udata = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        User::create($udata);

        return redirect('/user-registration')->with('success', 'Thank you for registrations. Please give us some time to active your acoount');
    }
}

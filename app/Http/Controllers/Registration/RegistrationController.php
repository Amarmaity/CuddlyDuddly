<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class RegistrationController extends Controller
{
    public function index(Request $request){

        return view('Pages.Home');
    }

    public function viewRegister(Request $request){

        return view('Register.RegistrationPage', ['role' => 'customer']);
    }

    public function sellerRegister(Request $request){

        return view('Register.RegistrationPage', ['role' => 'vendor']);
    }


    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email'    => 'required|email|unique:users',
            'phone'    => 'required|digits:10|unique:users',
            'role'     => 'required|in:admin,vendor,customer',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'role'      => $request->role,
            'password'  => Hash::make($request->password),
            'is_active' => 1,
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user'    => $user,
        ], 201);
    }

    public function viewLogin(Request $request){

        return view('Register.Login');
    }
}

<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {

        return view('Pages.Home');
    }

    public function viewRegister(Request $request)
    {

        return view('Register.RegistrationPage', ['role' => 'customer']);
    }

    public function sellerRegister(Request $request)
    {

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

    public function viewLogin(Request $request)
    {

        return view('Register.Login');
    }

    public function apiLogin(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $user = User::where($field, $request->login)->first();

        if (!$user) {
            return response()->json([
                'message' => ucfirst($field) . ' not found'
            ], 404);
        }

        if (!$user->is_active) {
            return response()->json([
                'message' => 'Your account is deactivated. Please contact support.'
            ], 403);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Incorrect password'
            ], 401);
        }

        // 🔹 Generate new token on login
        $token = Str::random(60);
        $user->api_token = hash('sha256', $token);
        $user->save();

        return response()->json([
            'message' => 'Login successful',
            'id'      => $user->id,
            'name'    => $user->name,
            'role'    => $user->role,
            'token'   => $token,
        ]);
    }



    public function apiLogout(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 400);
        }

        $user = User::where('api_token', hash('sha256', $token))->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        $user->api_token = null;
        $user->save();

        return response()->json(['message' => 'Logged out successfully']);
    }
}

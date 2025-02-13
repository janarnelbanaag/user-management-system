<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'error' => 'The provided credentials are incorrect.'
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return ApiService::response(
            'Login successful',
            [
                'token' => $token,
                'user' => $user
            ]
        );
    }

    public function register(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required',
            'postcode' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user'
        ])->validate();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $token = $user->createToken('auth_token')->plainTextToken;

        return ApiService::response(
            'Registration successful',
            [
                'token' => $token,
                'user' => $user
            ],
            201
        );
    }
}

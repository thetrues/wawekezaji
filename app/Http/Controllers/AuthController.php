<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    //login, register, logout, refresh, userProfile methods
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required_without:phone',
            'phone' => 'string|required_without:email',
            'password' => 'required|string|min:6',
        ]);

        // Find user by email or phone
        $user = User::where('email', $request->email)
            ->orWhere('phone_number', $request->phone)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!$user->is_active) {
            return response()->json(['error' => 'Account is inactive. Please contact support.'], 403);
        }

        // Create Sanctum token
        $token = $user->createToken('api_token')->plainTextToken;

        return $this->createNewToken($token, $user);
    }

    protected function createNewToken($token, $user)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20|unique:users,phone_number',
            'password' => 'required|string|min:6',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'password' => Hash::make($request->password),
            'user_type' => 'user', // default user type
            'subscription_tier' => 'free', // default subscription tier
            'is_active' => true, // default active status
        ]);

        // Create Sanctum token
        $token = $user->createToken('api_token')->plainTextToken;

        return $this->createNewToken($token, $user);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        $token = $user->createToken('api_token')->plainTextToken;
        return $this->createNewToken($token, $user);
    }

    public function userProfile(Request $request)
    {
        return response()->json($request->user());
    }
}

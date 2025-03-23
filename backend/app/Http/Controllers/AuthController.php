<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find the user by email.
        $user = Models\User::where('email', $request->email)->first();

        if (!$user) {
            // User not found.
            return response()->json(['message' => 'User not found'], 404);
        }

        // Verify the password.
        if (!Hash::check($request->password, $user->password)) {
            // Invalid password.
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken("Bearer Token");

        return [
            'email' => $user->email,
            'name' => $user->name,
            'token' => $token->plainTextToken,
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'You are now logged out.'
        ];
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->orWhere('username', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['email/username incorrect']
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['password incorrect']
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'jwtToken' => $token,
            'user' => new UserResource($user),
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
            'name' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => 'user',
        ]);

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'jwtToken' => $token,
            'user' => new UserResource($user),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'logout successfully',
        ]);
    }

    public function updateFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required'
        ]);

        $user = $request->user();
        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response()->json([
            'message' => 'fcm token updated successfully',
        ]);
    }
}
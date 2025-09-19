<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        User::create($request->all());
        return response()->json(['message'=>'user registered successfully']);
    }
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message'=>'Unauthorized'], 401);
        }
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json(['user' => $user,
            $user->createToken("Token of user {$user->name}")->plainTextToken,201]);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'logged out',200]);
    }
}

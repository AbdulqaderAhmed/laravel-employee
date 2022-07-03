<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $cred = $request->validate([
            "name" => "required|string",
            "email" => "required|string|unique:users",
            "password" => "required|string|confirmed"
        ]);

        $user = User::create([
            'name' => $cred['name'],
            'email' => $cred['email'],
            'password' => bcrypt($cred['password']),
        ]);
        $accessToken = $user->createToken("userToken")->plainTextToken;
        $message = "user successfully created";

        return response()->json(["message" => $message, "user" => $user, "token" => $accessToken], 201);
    }

    public function login(Request $request)
    {
        $cred = $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        if (!Auth::attempt($cred)) {
            return response(["message" => "invalid credential"]);
        }

        $accessToken = Auth::user()->createToken("addToken")->plainTextToken;
        $message = "user successfully logged in";

        return response()->json(["message" => $message, "user" => auth()->user(), "token" => $accessToken]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        $message = "user successfully logged out";

        return response()->json(["message" => $message]);
    }
}

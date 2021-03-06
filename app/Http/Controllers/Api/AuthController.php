<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required|max:255'],
            'email' => ['required|email'],
            'password' => ['required|confirmed'],
        ]);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->access_token;

        return response([
            'user' => $user,
            'access_token' => $accessToken
        ]);
    }
}

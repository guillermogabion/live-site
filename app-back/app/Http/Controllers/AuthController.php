<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //

    // register 

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        // Dumped information in the response
        return response([
            'request_data' => $request->all(),
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ]);
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6',
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ])->status(403);
        }

        $user = auth()->user();
        $token = $user->createToken('secret')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'Logout Success'
        ], 200);
    }

    public function user()
    {
        return response([
            'user' => auth()->user()
        ]);
    }


    public function test()
    {
        return dd("test");
    }
}

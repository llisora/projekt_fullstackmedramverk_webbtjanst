<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Register user
    public function register(Request $request)
    {
        $validateduser = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'

            ]
        );
        //Incorrect values
        if ($validateduser->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'error' => $validateduser->errors()
            ], 401);
        }

        //Correct values - store user and return a token
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),

        ]);

        $token = $user->createToken('APITOKEN')->plainTextToken;
        $response = [
            'message' => 'User created',
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    //Login user
    public function login(Request $request)
    {
        $validateduser = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'

            ]
        );
        //Incorrect values
        if ($validateduser->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'error' => $validateduser->errors()
            ], 401);
        }

        //Incorrect login credentials
        if(!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid email/password'
            ], 401);
        }

        // Correct - return access token
        $user = User::where('email', $request->email)->first();

        return response()->json([
            'message' => 'User logged in',
            'token' => $user->createToken('APITOKEN')->plainTextToken
        ], 200);
    }

    //Logout user
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        $response = [
            'message' => 'User logged out'
        ];

        return response($response, 200);
    }
}

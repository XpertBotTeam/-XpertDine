<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        // validate data from user
        $request->validate([
            "Username" => "required|string",
            "email" => "required|email|unique:users",
            "Phonenumber" => "required|string",
            "password" => "required|confirmed|min:6",
        ]);

        // create new user and save it to database
        $user = User::create([
            'Username' => $request->Username,
            'email' => $request->email,
            'Phonenumber' => $request->Phonenumber,
            'password' => bcrypt($request->password),
        ]);

        // Authenticate the user
        Auth::login($user);

        $access_token = $user->createToken("authToken")->plainTextToken;

        return response()->json([
            'status' => '201',
            'message' => 'User has been created successfully.',
            'token' => $access_token
        ], 201);
    }

    public function login(Request $request)
{
    // Log the incoming request data for debugging
    Log::info('Login request received', ['request' => $request->all()]);

    // validate data from the user
    $credentials = $request->validate([
        'Username' => 'required|string',
        'password' => 'required|string|min:8',
    ]);

    // Retrieve the user from the database by email
    $user = User::where('email', $request->email)->first();

    if ($user) {
        // Compare the provided password with the hashed password stored in the database
        if (Hash::check($request->password, $user->password)) {
            // Passwords match, authenticate the user
            $access_token = $user->createToken("authToken")->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'Logged In Successfully!',
                'token' => $access_token
            ], 201);
        } else {
            // Passwords do not match
            return response()->json([
                'status' => 200,
                'message' => 'Invalid Email or Password'
            ], 200);
        }
    } else {
        // User not found
        return response()->json([
            'status' => 200,
            'message' => 'Invalid Email or Password'
        ], 200);
    }
}

}

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
    public function signupForm()
    {
        return view('users.signup');
    }


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

        // Check if the request is coming from a Flutter application
        if ($request->header('User-Agent') === 'Flutter') {
            // If it's a Flutter request, return a JSON response
            $access_token = $user->createToken("authToken")->plainTextToken;
            return response()->json([
                'status' => '201',
                'message' => 'User has been created successfully.',
                'token' => $access_token
            ], 201);
        } else {
            // If it's a web request, redirect to the main page
            return redirect('/');
        }
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
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
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

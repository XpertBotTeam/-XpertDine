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

    public function loginForm()
    {
        return view('users.login');
    }


    public function signup(Request $request)
    {

        // validate data from user
        $request->validate([
            "Username" => "required|string",
            "email" => "required|email|unique:users",
            "Phonenumber" => "required|string",
            "password" => "required|confirmed|min:6",
            "role" => "required",
        ]);

        // create new user and save it to database
        $user = User::create([
            'Username' => $request->Username,
            'email' => $request->email,
            'Phonenumber' => $request->Phonenumber,
            'password' => bcrypt($request->password),
            'role' => $request->role,
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
            if ($request->role == "Owner") {
                return redirect('/create/restaurant');
            }
            return redirect('/');
        }
    }


    public function signin (Request $request)
    {
        // Log the incoming request data for debugging
        Log::info('Login request received', ['request' => $request->all()]);

        // validate data from the user
        $credentials = $request->validate([
            'username_or_email' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

       // $user = User::where('email', $credentials['username_or_email'])
            //->orWhere('username', $credentials['username_or_email'])
           // ->first();
            if(Auth::attempt($credentials)){
                $user=Auth::user();
            if (Hash::check($request->password, $user->password)) {
                $access_token = $user->createToken("authToken")->plainTextToken;
                if ($request->header('User-Agent') === 'Flutter') {
                    return response()->json([
                        'success' => true,
                        'message' => 'Logged In Successfully!',
                        'token' => $access_token
                    ], 201);
                } else {
                    // Inside login method
                    return redirect()->intended('/');
                }
            } else {
                // Passwords do not match
                if ($request->header('User-Agent') === 'Flutter') {
                    return response()->json([
                        'status' => 200,
                        'message' => 'Invalid Username/Email or Password'
                    ], 200);
                } else {
                    return back()->withErrors(['loginError' => 'Invalid Username/Email or Password']);
                }
            }
        } else {
            // User not found
            if ($request->header('User-Agent') === 'Flutter') {
                return response()->json([
                    'status' => 200,
                    'message' => 'Invalid Username/Email or Password'
                ], 200);
            } else {
                return back()->withErrors(['loginError' => 'Invalid Username/Email or Password']);
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

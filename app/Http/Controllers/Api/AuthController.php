<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(request $request)
    {
        //validate data from user
        $request->validate([
            "name" => "required|min:3",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed|min:6"
        ]);
        
        //create new user and save it to database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'password_confirmation' => 'required|same:password'
            ]);
         $access_token= $user->createToken("authToken")->plainTextToken;  
         if($user){
            return response()->json([
                'status'=>'201',
                'message'=>'User has been created successfully.',
                'token'=> $access_token
                ], 201);
        }else{
            return response()->json([
                'status'=>'404',
                'message'=>'somethings was worng'
                ], 404);
        }

        // Authenticate the user
        Auth::login($user);

        }
    
    public function login(Request $request){
        //validate data from the user
        $credentials=$request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
       
        if(Auth::attempt($credentials)){
         $user=Auth::user();
         $access_token =$user->createToken('authToken')->plainTextToken;
            return response()->json([
                'succes'=>true,
                'message'=>'Logged In Successfully!',
                 'token'=>$access_token
                ],201);
        }else{
            return response()->json([
                'status'=>200,
                'message'=>'invalid  Email or Password'],200);
        }
    }
         
    
}

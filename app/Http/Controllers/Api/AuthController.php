<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(request $request)
    {
        //validate data from user
        $request->validate([
            "Username" => "required|string",
            "email" => "required|email|unique:users",
            "Phonenumber"=>"required|string",
            "password" => "required|confirmed|min:6",
           
        ]);
        
        //create new user and save it to database
        $user = User::create([
            'Username' => $request->Username,
            'email' => $request->email,
            'Phonenumber'=>$request->Phonenumber,
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
            'Username' => 'required|string',
            'password' => 'required|string|min:8',
        ]);
       
        if(Auth::attempt($credentials)){
         $user=Auth::user();
         $access_token =$user->createToken('authToken')->plainTextToken;
            return response()->json([
                'success'=>true,
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

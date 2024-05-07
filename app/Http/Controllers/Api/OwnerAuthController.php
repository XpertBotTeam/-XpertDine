<?php

namespace App\Http\Controllers\Api;

use App\Models\owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OwnerAuthController extends Controller
{
    public function register(Request $request){

        $post_data = $request->validate([
                'name'=>'required|string',
                'email'=>'required|string|email|unique:owners',
                'password'=>'required'
        ]);

            $owner= owner::create([
            'name' => $post_data['name'],
            'email' => $post_data['email'],
            'password' => Hash::make($post_data['password']),
            ]);

            $token = $owner->createToken('authToken')->plainTextToken;

            return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            ]);
        }
        public function login()
        {
            $credentials = request(['email', 'password']);
            if(Auth::attempt($credentials)){
                $owner=Auth::owner();
                $access_token =$owner->createToken('authToken')->plainTextToken;
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

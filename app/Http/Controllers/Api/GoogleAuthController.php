<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function callbackGoogle()
    {
        try{
            $google_user = Socialite::driver('google')->user();
            $user =User::where('google_id',$google_user->getId())->first();
            if(!$user){
                $new_user =user::create([
                    'Username' => $google_user->getName(),
                    'email'=>$google_user->getEmail(),
                    'Phonenumber'=>$google_user->getphonenumber(),
                    'google_id' => $google_user -> getId(), 
                ]);
              Auth::login( $new_user );
             return response()->json(['data'=>$new_user],201);
            }else{
                Auth::login( $user );
               return response()->json(['message'=>"You are login with google account successfully."]);
            }
        }catch(\Exception $e){
           return response()->json(['error'=>$e->getMessage()],401);  
        }
    }
}

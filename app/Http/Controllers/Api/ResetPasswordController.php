<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordResetToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        return view('password.reset', ['token' => $token]);
    
    }
    public function reset(Request $request,$token)
    {

        $request->validate([
           'password'=>'required',
           'Confirm_Password' => 'required',
           'token'=>'required'
        ]);

        // Retrieve email based on the token
        $passwordResetToken = PasswordResetToken::where('token', $token)->first();
        
        if (!$passwordResetToken) {
            // Handle the case where token is invalid or expired
            return response()->json(['error' => 'Invalid or expired token'], 400);
        }
        // Retrieve user based on the email
        $user = User::where('email', $passwordResetToken->email)->first();

        if (!$user) {
            // Handle the case where user doesn't exist
            return response()->json(['error' => 'User not found'], 404);
        }

        // Reset user's password
        
        $user->update(['password'=>Hash::make($request->password)]);
       $user->tokens()->delete();
      $success['success']=true;

        // Delete the password reset token
       // $passwordResetToken->delete();

        return response()->json(['message' => 'Password has been reset successfully']);
    }
}

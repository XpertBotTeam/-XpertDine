<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\resetPasswordEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\PasswordResetToken;

class PasswordResetlinkController extends Controller
{
    public function sendResetPasswordEmail(Request $request)
{
    $request->validate([
        'email' => 'required'
    ]);
    
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        // Handle the case where user doesn't exist
        return response()->json(['message' => 'User not found'], 404);
     }

    // Generate a unique token
    $token = Str::random(60);

    // Store the token in the password_reset_tokens table
    PasswordResetToken::create([
        'email' => $user->email,
        'token' => $token
    ]);

    // Construct reset URL with token
    $resetUrl = url("/password/reset/$token");

    // Pass reset URL to the email template
    Mail::to($user->email)->send(new ResetPasswordEmail($resetUrl));

    return response()->json(['message' => 'Reset password email sent']);
}
}

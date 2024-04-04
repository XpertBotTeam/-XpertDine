<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordEmail;

class PasswordResetlinkController extends Controller
{
    public function sendResetPasswordEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Handle the case where user doesn't exist
            return response()->json(['message' => 'User not found'], 404);
        }

        $token = $user->createToken('PasswordResetToken')->plainTextToken;
        $resetUrl = url("/password/reset/$token");

        // Pass token and reset URL to the email template
        Mail::to($user->email)->send(new resetPasswordEmail($resetUrl));

        return response()->json(['message' => 'Reset password email sent']);
    }
}

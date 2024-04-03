<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        return view('password.reset', ['token' => $token]);
    }
    public function reset(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        // Retrieve user based on the token
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Handle the case where user doesn't exist
            return response()->json(['error' => 'User not found'], 404);
        }

        // Reset user's password
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Password has been reset successfully']);
    }
}

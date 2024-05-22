<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index(request $request)
    {
        $per_page =$request->get('per_page',25);
        $User=User::paginate($per_page);
        return response()->json($User);
    }
    public function show (request $request, string $token)
    {
        $User=user::findOrFail($token);
        return response()->json($User);
    }

    public function update(Request $request, string $token)
    {
       // $User = $request->user();
       $User=User::findOrFail($token);
        $User->update([
            'Username' => $request->Username,
            'email' => $request->email,
            'Phonenumber' => $request->Phonenumber,
            'password' => bcrypt($request->password)
        ]);        
        return response()->json([
            'message' => 'Profile updated successfully',
            'data'=>$User
        ]);
    }
      public function destroy(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            // Optionally revoke tokens if using Sanctum
            $user->tokens()->delete();

            // Delete the user
            $user->delete();

            return response()->json(['message' => 'User deleted successfully.'], 200);
        }

        return response()->json(['error' => 'User not found.'], 404);
    }
}


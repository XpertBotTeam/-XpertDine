<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;

class VerifiactionController extends Controller
{
    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

       /**
     * create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only('resend');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify','resend');
    }

    
    /**
     * Resend the email verification notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resend(Request $request)
    {
       if($request->user()->hasVerifiedEmail()){
        return response()->json(['message'=>'Your email is already verified']);
       }
       $request->user()->sendEmailVerificationNotification();

       if($request->wantsJson()){
        return response()->json(['message'=>'Email sent']);
       }
       return back()->with('resent', true);
    }
    /**
     * Verify the user's email address.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify(Request $request)
    {
       auth()->loginUsingId($request->route('id'));
       if($request->route('id')!= $request->user()->getKey()){
        throw new AuthorizationException;

       }
       if($request->user()->hasVerifiedEmail()){
        return response()->json(['message'=>'Your email is already verified']);
       }
    }

}

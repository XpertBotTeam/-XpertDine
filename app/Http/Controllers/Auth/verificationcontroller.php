<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;

class verificationcontroller extends Controller
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
        $this->middleware('auth')->only('resend');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify','resend');
    }
    
    public function resend(Request $request)
    {
       if($request->user()->hasVerifiedEmail()){
       return redirect($this->redirectPath());
       }
       $request->user()->sendEmailVerificationNotification();

       return back()->with('resent', true);
    }

    public function verify(Request $request)
    {
        auth()->loginUsingId($request->route('id'));
       if($request->route('id') !=$request->user()->getKey()){ 
        throw new AuthorizationException;

       }
       if($request->user()->hasVerifiedEmail()){
        return  redirect($this->redirectPath());
       }
       if ($request->user()->markEmailAsVerified()){
         event(new Verified($request->user()));
       }
       return redirect($this->redirectPath())->with('verified',true);
    }
    }




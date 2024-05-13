<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function userAgreement(request $request)
    {
        return view('user_agreement');
    }

    public function privacyPolicy(request $request)
    {
        return view('privacy_policy');
    }
}

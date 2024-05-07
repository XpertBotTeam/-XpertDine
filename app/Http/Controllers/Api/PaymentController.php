<?php

namespace App\Http\Controllers\Api;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $per_page=$request->get('per_page',25);
        $payment=Payment::paginate($per_page);
        return response()->json($payment);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            "nameofcard"=>'required|string',
            'Cardnumber'=>'required|numeric',
            'expirydate'=>'required',
            'cvv'=>'required|digits:3'
        
        ]);
        $user=auth()->user();
       if(!$user->id==$request->get('user_id')){
       $payment = Payment::create($request->all());
      return response()->json(['message'=>"Payment Method has been added successfully",
      'data'=>$payment
    ],201);
   }else{
        return resposne()->json([
            'status'=>false,
            'data'=> null,
            'message'=>'User is not Authenticated '
        ]);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment=payment::finadOrFail($id);
        return response()->json([
            'data'=>$payment,
            'message'=>'Retrieved Successfully'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment=payment::findOrFail($id);
        $payment->update($request->all());
        return response()->json([
        'status'=>true,
        'message'=>$payment
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrfail($id);
        $payment->delete();

        return response()->json([
            'message'=>'The payment method has been deleted']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $per_page =$request->get('per_page',25);
        $reservation= reservation ::paginate($per_page);
        return response()->json($reservation);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)

    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reservation= reservation::create($request->all());
        return response()->json([
            'status'=>true,
            'data'=> $reservation,
            'message'=>'Your reservation has been completed successfully '
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation= reservation::findOrFails($id);
        if( $reservation){
            return response()->json([
                'status'=>true,
                'data'=> $reservation,
                'message'=>'Your reservation has been completed successfully '
            ]);
        }else{
            return response()->json([
                'status'=>false,
                 'data'=>null,
                 'message'=>'NO reservation found '
            ]);
        }
        
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
        $reservation= reservation::findOrFails($id);
        $reservation->update($request->all);
        return response()->json([
            'status'=>true,
            'message'=>"Updated success",
            'data'=> $reservation
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation= reservation::findOrFails($id);
        $reservation->destroy();
        if($result){
            return response()->json([
                'status'=>true,
                'data'=>null,
                'message'=>"The Reservation deleted success"
            ]);

        }else{
            return response()->json([
                'status'=>false,
                 'data'=>null,
                 'message'=>'NO reservation found'
            ]);
        }
     
    }
}

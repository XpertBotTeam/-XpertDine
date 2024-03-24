<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function create(requets $request)

    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reservation= reservation::create($request->all());
        return response()->json([
            'status'=>201,
            'message'=> $reservation
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation= reservation::findOrFails($id);
        return response()->json($reservation);
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
            'status'=>200,
            'message'=>"Updated success",
            'data'=> $reservation
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation= reservation::findOrFails($id);
        $reservation->delete();
        return response()->json([
            'status'=>202,
            'message'=>"The Reservation deleted success"
        ],202);
    }
}

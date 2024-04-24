<?php

namespace App\Http\Controllers\Api;

use App\Models\GuestHouse;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;

class GuestHousesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function  search(request $request) {
            $search =$request['search']  ?? "";
            if ($request->header('User-Agent') === 'Flutter') {
            if($search !="") {
                $GuestHouse = GuestHouse::where('name','like',"%".$search."%")->get();
            } else {
                $GuestHouse = GuestHouse::all();
            }
             return response()->json([
                 'data'=>$restaurant,
                 "status"=>true
             ]);
            }
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
            'name' =>'required',
            'image'=>'required',
            'Facilities'=>'required',
            'prices'=>'required',
            'location'=>'required',
            'Phone_for_reservation'=>'required',
            'status'=>['available', 'fully_booked'],
            
        ]);
        
        $imagePath = null;
        if ($request->hasFile('image')) {
            $logoPath = $request->file('image')->store('logos', 'public');
        }   
       $GuestHouse = GuestHouse::create([
        'name'=>$request->name,
        'Facilities'=>$request->Facilities,
        'prices'=>$request->prices,
        'image'=>$imagePath,
        'location'=>$request->location,
        'phone_for_reservation'=>$request->Phoneforreservation,
        'status'=>($request->status)
        ]);

        if ($request->header('User-Agent') === 'Flutter') {
       return response()->json([
        'status'=>true,
        'message'=>'GuestHouses Added Successfully',
        'data'=>$GuestHouse
       ]);
    }else{
      return response()->json([
          'status'=>false,
          'message'=>'Something Went Wrong!'
          ]) ;  
      }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $GuestHouse = GuestHouse::findOrFail($id);
    
         return response()->json( $GuestHouse );
    }
    public function all()
    {
        $GuestHouse = GuestHouse::all();
    
         return response()->json( $GuestHouse );
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
        $GuestHouse = GuestHouse::findOrFail($id);
        $GuestHouse->update($request->all());  
       if ($GuestHouse){
            return response()->json([
                "status"=>true ,  
                "data" =>$GuestHouse ,"message"=>"Updated Successfully",
             ]);
             }else{
                 return response()->json("Error In The Process");
             }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $GuestHouse = GuestHouse::findOrFail($id);
        $GuestHouse->delete();
        return response()->json([
            "status"=>true,
            "message"=>'Deleted Successfully'
        ]);
    
        }
    
    
}

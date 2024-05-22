<?php

namespace App\Http\Controllers\Api;

use App\Models\GuestHouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuesthousesController extends Controller
{
    public function  index (request $request)
    {

        $per_page =$request->get('per_page',25);
        $GuestHouse=GuestHouse::paginate($per_page);
        return response()->json($GuestHouse);
    }


/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $request->validate([
        'name' =>'required',
       'images'=>'required|array',
        'Facilities'=>'required|array',
        'prices'=>'required',
        'location'=>'required',
        'Phonenumber'=>'required',
        'city'=>'required',
        'status'=>'required',
        
    ]);
    $images =$request->file('images');
    $imageNames=[];
    foreach($images as $image){
      $new_name =rand().'.' .$image->getClientOriginalExtension();
      $image->move(public_path('/assets/guesthouses'), $new_name);    
      $imageNames[] = $new_name; 
    }
    $imagedb= implode(',',$imageNames);
  
      
   $GuestHouse = GuestHouse::create([
    'name'=>$request->name,
    'Facilities'=>$request->Facilities,
    'prices'=>$request->prices,
    'images'=>$imageNames,
    'location'=>$request->location,
    'city'=>$request->city,
    'Phonenumber'=>$request->Phonenumber,
    'city'=>$request->city, 
    'status'=>$request->status,
  ]);    

    if ($request->header('User-Agent') === 'Flutter') {
   return response()->json([
    'status'=>true,
    'message'=>'GuestHouses Added Successfully',
    'data'=>$GuestHouse,
    'images'=>$imagedb
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
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    $GuestHouse = GuestHouse::findOrFail($id);
    $GuestHouse->update($request->all());  
   if ($GuestHouse){
        return response()->json([
            "status"=>true ,  
            "data" =>$GuestHouse ,
            "message"=>"Updated Successfully"
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

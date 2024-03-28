<?php

namespace App\Http\Controllers\Api;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requestrestaurant;

class RestaurantController extends Controller
{
    //Add a restaurant
    public function store(Request $request)
    {
        //validate data from user
        $request->validate([
            "name" => "required|min:3",
            "location" => "required",
            "description" => "required",
            "phoneNumber" => "required",
            'rating'=>'required|numeric|between:1,5'
        ]);

        //create new restaurant and save it to database
        $restaurant = restaurant::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'phoneNumber' => $request->phoneNumber,
            'rating'=>$request->rating
        ]);

        if($restaurant){
            return response()->json([
                'status'=>true,
                'message'=>'Restaurant has been created successfully.',
                'data'=>$restaurant
                ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'The restaurant not found'
                ]);
        }
    }
    //Get all restaurants
    public function index()
    {
        $restaurant=Restaurant::all();
        return response()->json(['data'=>$restaurant],200);
    }

    //get one restaurant by id
    public function show($id)
    {
       $restaurant=restaurant::find($id);
       if(!is_object($restaurant)){
           return response()->json(["message"=>"The restaurant with the given ID is not found!"],404);
       }
       return response()->json(['data'=>$restaurant]);
   }

//Update a restaurant information
public function update(Request $request , $id)
{
    $restaurant=restaurant::findOrFails($id);
    $restaurant->update($request->all);
    return response()->json("The restaurant was updated", 201);
}

//Delete a restaurant
public function destroy($id)
{
    $restaurant = restaurant::find($id);
    $restaurant->delete();
    
    if ($restaurant)
    {
        return response()->json([
            "message"=>"The restaurant was deleted successfully"
        ]);
    }else{
        return response()->json([
            "message"=>"The restaurant not found "
        ]);
    }
}
}
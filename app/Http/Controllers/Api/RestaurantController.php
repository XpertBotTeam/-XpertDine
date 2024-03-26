<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

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
        ]);

        //create new restaurant and save it to database
        $restaurant = Restaurant::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'phoneNumber' => $request->phoneNumber
        ]);

        if($restaurant){
            return response()->json([
                'status'=>'201',
                'message'=>'Restaurant has been created successfully.'
                ], 201);
        }else{
            return response()->json([
                'status'=>'404',
                'message'=>'somethings was worng'
                ], 404);
        }
    }
}
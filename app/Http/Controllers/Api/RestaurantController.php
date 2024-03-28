<?php

namespace App\Http\Controllers\Api;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requestrestaurant;
use App\Http\Requests\restaurant as RequestsRestaurant;

class RestaurantController extends Controller
{
    //Add a restaurant
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|min:3",
            "location" => "required",
            "description" => "required",
            "phoneNumber" => "required",
            'rating' => 'required|numeric|between:1,5'
        ]);
    
        $logoPath = null;
    
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }
    
        //create new restaurant and save it to database
        $restaurant = Restaurant::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'phoneNumber' => $request->phoneNumber,
            'rating' => $request->rating,
            'logo' => $logoPath // Assign the logo path here
        ]);

        if ($restaurant) {
            return response()->json([
                'status' => true,
                'message' => 'Restaurant has been created successfully.',
                'data' => $restaurant
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'The restaurant not found'
            ]);
        }
    }

    // show all the restaurnat for the web 
    public function all()
    {
        $restaurants = Restaurant::all();
        return view('restaurant.index', compact('restaurants'));
    }
    public function single($id)
    {
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return response()->json(["message" => "The restaurant with the given ID is not found!"], 404);
        }
        return view('restaurant.show', compact('restaurant'));
    }


    //Get all restaurants
    public function index()
    {
        $restaurant = Restaurant::all();
        return response()->json(['data' => $restaurant], 200);
    }

    //get one restaurant by id
    public function show($id)
    {
        $restaurant = restaurant::find($id);
        if (!is_object($restaurant)) {
            return response()->json(["message" => "The restaurant with the given ID is not found!"], 404);
        }
        return response()->json(['data' => $restaurant]);
    }

    //Update a restaurant information
    public function update(Request $request, $id)
    {
        $restaurant = restaurant::findOrFails($id);
        $restaurant->update($request->all);
        return response()->json("The restaurant was updated", 201);
    }

    //Delete a restaurant
    public function destroy($id)
    {
        $restaurant = restaurant::find($id);
        $restaurant->delete();

        if ($restaurant) {
            return response()->json([
                "message" => "The restaurant was deleted successfully"
            ]);
        } else {
            return response()->json([
                "message" => "The restaurant not found "
            ]);
        }
    }
}

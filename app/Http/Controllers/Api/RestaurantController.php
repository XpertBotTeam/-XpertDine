<?php

namespace App\Http\Controllers\Api;


use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\RestaurantCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requestrestaurant;
use App\Http\Requests\restaurant as RequestsRestaurant;

class RestaurantController extends Controller
{
   
    public function show(){
        return view('Restaurant.newRestaurant', [
            'category' => RestaurantCategory::all()
        ]);
    }
    //Add a restaurant
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|min:3",
            "location" => "required|max:512",
            "description" => "required",
            "phoneNumber" => "required",
            "logo" => "required",
            'category' => 'required',
            'openTime' => 'required',
            'closeTime' => 'required',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }
        $user=auth()->user();
        if(!$user->id==$request->get('user_id')){
        $restaurant = Restaurant::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'phoneNumber' => $request->phoneNumber,
            'category' => $request->category,
            'openTime' => $request->openTime,
            'closeTime' => $request->closeTime,
            'logo' => $logoPath
        ]);
    }
    

        if ($request->header('User-Agent') === 'Flutter') {
            return response()->json([
                'status' => '201',
                'data'=>$restaurant,
                'message' => 'Restaurant has been created successfully.'
            ], 201);
        } else {
            return redirect('/');
        }
    }

    // show all the restaurnat for the web 
    public function all()
    {
        $restaurants = Restaurant::all();
        return view('Restaurant.index', compact('restaurants'));
    }

    public function single($id)
    {
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return response()->json(["message" => "The restaurant with the given ID is not found!"], 404);
        }
        return view('restaurant.show', compact('restaurant'));
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


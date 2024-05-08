<?php

namespace App\Http\Controllers\Api;


use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\RestaurantCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requestrestaurant;

class RestaurantController extends Controller
{
    public function index(request $request)
    {
        
        $per_page =$request->get('per_page',25);
        $restaurant = Restaurant::paginate($per_page);
        return response()->json( $restaurant);
    }
   
    public function show(request $request ,string $id){
        $restaurant = Restaurant::findOrFail($id);
        return response()->json( $restaurant );
    }
    //Add a restaurant
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|min:3",
            "location" => "required|max:512",
            "description" => "required",
            "phoneNumber" => "required",
            "images" => "required|array|min:1", 
            'category' => 'required',
            'city'=>'required',
            'openTime' => 'required',
            'closeTime' => 'required',
        ]);
        $images =$request->file('images');
        $imageNames=[];
        foreach($images as $image){
          $new_name =rand().'.' .$image->getClientOriginalExtension();
          $image->move(public_path('/assets/restaruant'), $new_name);    
          $imageNames[] = $new_name; 
        }
        $imagedb= implode(',',$imageNames);
      
        $restaurant = Restaurant::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'phoneNumber' => $request->phoneNumber,
            'category' => $request->category,
            'city'=>$request->city,
            'openTime' => $request->openTime,
            'closeTime' => $request->closeTime,
            'images' => $imageNames
        ]);
    

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


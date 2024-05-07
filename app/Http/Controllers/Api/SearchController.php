<?php

namespace App\Http\Controllers\Api;

use App\Models\Activities;
use App\Models\GuestHouse;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function SearchRestaurant(Request $request)
    {
        $query = $request->input('search');

        $restaurants = Restaurant::where('name', 'like', "%$query%")
            ->orWhere('location', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        $data = [];
        foreach ($restaurants as $restaurant) {
            $restauData = $restaurant->getOriginal();
            array_push($data, $restauData);
        }

        if (count($data) === 0)
            return response()->json([
                
            ]);

        if (!($request->header('User-Agent') === 'Flutter')) {
            return response()->json([
                'status' => 'success',
                'data' =>  $data
            ]);
        } else {
            return  response()->json([
                
            ]);
        }
    }
    public function SearchGuestHouse(Request $request)
    {
        $query = $request->input('search');
       $query = $request->input('sort');

        $GuestHouse = GuestHouse::where('name', 'like', "%$query%")
            ->orWhere('Facilities', 'like', "%$query%")
            ->orWhere('location', 'like', "%$query%")

            ->get();

            // sort data 
            $GuestHouse = GuestHouse::orderBy('prices', 'asc')->get();
            $GuestHouse = GuestHouse::orderBy('prices', 'desc')->get();
            return $query=$GuestHouse;
        
            

        $data = [];
        foreach ($GuestHouse as $GH) {
            $GHData = $GH->getOriginal();
            array_push($data, $GHData);
        }

        if (count($data) === 0)
            return response()->json([
               
            ]);

        if (($request->header('User-Agent') === 'Flutter')) {
            return response()->json([
                'status' => 'success',
                'data' =>  $data
            ]);
        } else {
            return  response()->json([
               
            ]);
        }
    }
    public function SearchActivities(Request $request)
    {
        $query = $request->input('search');

        $Activities = Activities::where('name', 'like', "%$query%")
            ->orWhere('location', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        $data = [];
        foreach ($Activities as $Act) {
            $ActData = $Act->getOriginal();
            array_push($data, $ActData);
        }

        if (count($data) === 0)
            return response()->json([
                
            ]);

        if (($request->header('User-Agent') === 'Flutter')) {
            return response()->json([
                
            ]);
        } else {
            return  response()->json([
               
            ]);
        }
    }
}

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

        $restaurant = Restaurant::where('name', 'like', "%$query%")
            ->orWhere('location', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        if (($request->header('User-Agent') === 'Flutter')) {
            return response()->json([
                'status' => 'success',
                'data' => $restaurant
            ]);
        } else {
            return  response()->json([
                'status' => false,
                'data' => 'No data found'
                ]) ;
        }
    }
    public function SearchGuestHouse (Request $request)
    {
        $query = $request->input('search');

        $GuestHouse = GuestHouse::where('name', 'like', "%$query%")
            ->orWhere('location', 'like', "%$query%")
            ->get();

        if (($request->header('User-Agent') === 'Flutter')) {
            return response()->json([
                'status' => 'success',
                'data' =>  $GuestHouse
            ]);
        } else {
            return  response()->json([
                'status' => false,
                'data' => 'No data found'
                ]) ;
        }
    }
    public function SearchActivities(Request $request)
    {
        $query = $request->input('search');

        $Activities = Activities::where('name', 'like', "%$query%")
            ->orWhere('location', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        if (($request->header('User-Agent') === 'Flutter')) {
            return response()->json([
                'status' => 'success',
                'data' =>  $Activities
            ]);
        } else {
            return  response()->json([
                'status' => false,
                'data' => 'No data found'
                ]) ;
        }
    }
  
}

<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');

        $restaurants = Restaurant::where('name', 'like', "%$query%")
            ->orWhere('location', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        // $items = Item::where('title', 'like', "%$query%")
        //     ->orWhere('description', 'like', "%$query%")
        //     ->get();

        if (($request->header('User-Agent') === 'Flutter')) {
            return response()->json([
                'status' => 'success',
                'data' => $restaurants
            ]);
        } else {
            return view('Restaurant.index', compact('restaurants'));
        }
    }
}

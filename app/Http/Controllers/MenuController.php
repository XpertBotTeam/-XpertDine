<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function show()
    {
        return view('Restaurant.newMenu', [
            'category' => Category::all()
        ]);
    }

    public function check(Request $request)
    {
        $user = Auth::user();
        if (!$user->isRestaurantOwner()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ], 403);
        }

        // Validate user data
        $request->validate([
            "name" => "required|string|unique:menu_items",
            "description" => "required|string",
            "price" => "required|numeric|min:0.01",
            "category_id" => "required",
            "logo" => "required|image"
        ]);

        // Associate the menu item with the authenticated restaurant owner
        $restaurant = $user->restaurant;

        $logoPath = $request->file('logo')->store('logos', 'public');

        // Create new menu item and save it to the database
        $menu = MenuItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'logo' => $logoPath,
            'restaurant_id' => $restaurant->id,
        ]);

        if ($request->header('User-Agent') === 'Flutter') {
            return response()->json([
                'status' => '201',
                'message' => 'Menu has been created successfully.'
            ], 201);
        } else {
            return redirect('/');
        }
    }
}

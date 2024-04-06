<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RestaurantCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            "American Cuisine",
            "Italian Cuisine",
            "Mexican Cuisine",
            "Chinese Cuisine",
            "Japanese Cuisine",
            "Indian Cuisine",
            "French Cuisine",
            "Mediterranean Cuisine",
            "Thai Cuisine",
            "Greek Cuisine",
            "Vegetarian/Vegan Cuisine",
            "Seafood Restaurants",
            "Steakhouse",
            "Barbecue (BBQ)",
            "Fast Food Restaurants",
            "Cafés and Coffee Shops",
            "Pizzerias",
            "Fine Dining Restaurants",
            "Buffet Restaurants",
            "Food Trucks"
        ];

        foreach ($categories as $category) {
            DB::table('restaurant_categories')->insert([
                'name' => $category,
            ]);
        }
    }
}

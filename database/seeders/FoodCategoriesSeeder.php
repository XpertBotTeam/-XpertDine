<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Burgers',
            'Pizza',
            'Drinks',
            'Appetizers',
            'Salads',
            'Sandwiches',
            'Soups',
            'Pasta',
            'Seafood',
            'Steaks and Grills',
            'Chicken dishes',
            'Vegetarian dishes',
            'Vegan dishes',
            'Desserts',
            'Breakfast items',
            'Sushi and Sashimi',
            'Tacos and Burritos',
            'Asian dishes',
            'Mediterranean dishes',
            'BBQ',
            'Wraps and Rolls',
            'Tapas',
            'Street food',
            'Gluten-free options',
            'Dairy-free options',
            'Asian dishes',
            'Italian dishes',
            'Lebanese dishes'
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
            ]);
        }
    }
}

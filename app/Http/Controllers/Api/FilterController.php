<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Guesthouse;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public function filterByPrice(Request $request)
    {
        $lowPrice = $request->input('low_price');
        $highPrice = $request->input('high_price');

        $Guesthouse= Guesthouse::whereBetween('price', [$lowPrice, $highPrice])->get();

      return response()->json($Guesthouse);
    }

}

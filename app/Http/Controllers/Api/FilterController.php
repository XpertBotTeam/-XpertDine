<?php

namespace App\Http\Controllers\Api;

use App\Models\GuestHouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public function index(Request $request)
    {
        $lowPrices = $request->input('50');
        $highPrices = $request->input('100');

        $GuestHouse = GuestHouse::whereBetween('prices', [50, 100])->get();

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
 public function SortPriceGuesthouses(Request $request){
  $query = $request->input('sort');
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
}}
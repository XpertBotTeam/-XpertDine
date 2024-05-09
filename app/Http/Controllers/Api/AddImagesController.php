<?php

namespace App\Http\Controllers\Api;

use App\Models\AddImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddImagesController extends Controller
{
    public function store (request$request) {
        $request->validate([
            'images' => 'required|array'
        ]);
        $images =$request->file('images');
        $imageNames=[];
        foreach($images as $image){
          $new_name =rand().'.' .$image->getClientOriginalExtension();
          $image->move(public_path('/assets/images'), $new_name);    
          $imageNames[] = $new_name; 
        }
        $imagedb= implode(',',$imageNames);

        $AddImage= AddImage::create([
            'images'=> $imageNames
        ]);  
         return response()->json([
            'message'=>"Image Uploaded Successfully",
             "status"=>$imageNames
         ]);


        }
        public function  show(request $request){
           //return all images from the database
           $AddImage=AddImage::all();
           return response()->json($AddImage);
       }
    
}

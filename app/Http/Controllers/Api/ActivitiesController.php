<?php

namespace App\Http\Controllers\Api;

use App\Models\Activities;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ActivitiesController extends Controller
{
    public function index(request $request)
    {
        
        $per_page =$request->get('per_page',25);
        $Activities= Activities::paginate($per_page);
        return response()->json(  $Activities);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'images' => 'required|array',
            'Description' => 'required',
            'Location' => 'required',
            'PhoneNumber' => 'required',
            'status'=>'required',
            'city'=>'required'
        ]);
        $images =$request->file('images');
        $imageName='';
        foreach($images as $image){
          $new_name =rand().'.' .$image->getClientOriginalExtension();
          $image->move(public_path('/assets/activities'), $new_name);    
          $imageName = $imageName.$new_name.","; 
        }
        $imagedb=$imageName;
       
        
        $Activities = Activities::create([
            'Name' => $request->Name,
            'images' => $imageName,
            'Description' => $request->Description,
            'Location' => $request->Location,
            'PhoneNumber' => $request->PhoneNumber,
            'status'=>($request->status),
            'city'=>$request->city
        ]);

        if ($request->header('User-Agent') === 'Flutter') {
            return response()->json([
                'status' => '201',
                'data'=>$Activities,
                'message' => 'Activities has been created successfully.'
            ], 201);
        } else {
            return response()->json([
                'status' => '201',
                'data'=>$Activities,
                'message' => 'Activities has been created successfully.'
            ], 201);
        }
    }
   public function show(request $request ,string $id){
        $Activities= Activities::findOrFail($id);
        return response()->json(  $Activities);
    }
  
    public function destroy(string $id)
    {
        $Activities = Activities::findOrFail($id);
        $Activities->delete();
        return response()->json([
            "status"=>true,
            "message"=>'Deleted Successfully'
        ]);
        }
}

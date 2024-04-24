<?php

namespace App\Http\Controllers\Api;

use App\Models\Activities;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ActivitiesController extends Controller
{
    

    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'Images' => 'required',
            'Description' => 'required',
            'Location' => 'required',
            'PhoneNumber' => 'required',
            'status'=>'required'
        ]);

        $ImagesPath = null;
        if ($request->hasFile('Images')) {
            $ImagesPath = $request->file('Images')->store('logos', 'public');
        }
        $Activities = Activities::create([
            'Name' => $request->Name,
            'Images' => $ImagesPath,
            'Description' => $request->Description,
            'Location' => $request->Location,
            'PhoneNumber' => $request->PhoneNumber,
            'status'=>($request->status)
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
    public function show(string $id)
    {
        $Activities= Activities::findOrFail($id);
    
         return response()->json( $Activities);
    }
    public function all()
    {
        $Activities= Activities::all();
    
         return response()->json( $Activities );
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

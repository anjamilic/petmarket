<?php

namespace App\Http\Controllers;
use App\Models\Pet;
use App\Models\User;
use App\Models\Necklace;
use App\Http\Resources\PetResource;
use App\Http\Resources\NecklaceResource;
use App\Http\Resources\PetCollection;
//use App\Http\Resources\NecklaceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Hash;

class NecklaceController extends Controller
{
    public function index()
    {
        $necklaces=Necklace::all();
        return $necklaces;
    }
    public function show(Necklace $necklace)
    {
        return new NecklaceResource($necklace);
    }
    public function store(Request $request)
    {  
        $validator = Validator::make($request->all(),[
            'item'=>'required',
            'material'=>'required', 
            'pet_id'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->error());
        }
        $necklace = Necklace::create([
            'item'=>$request->item,
            'material'=>$request->material,
            'pet_id'=>$request->pet_id,
        ]);
        return response()->json( ["Necklace is created successfully", new NecklaceResource($necklace)]);
    }
    public function update(Request $request, Necklace $necklace)
    {
        $validator = Validator::make($request->all(),[
            'item'=>'required|string|max:255',
            'material'=>'required|string|max:255', 
            'pet_id'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->error());
        }
        $necklace->item =$request->item;
        $necklace->material =$request->material;
        $necklace->pet_id =$request->pet_id;

        $necklace->save();
        return response()->json( ["Necklace is updated successfully", new NecklaceResource($necklace)]);
    }
    public function destroy(Necklace $necklace)
    {
        $necklace->delete();
        return response()->json( ["Necklace is deleted successfully"]);
    }
}


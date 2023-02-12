<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Http\Resources\PetResource;
use App\Http\Resources\PetCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Hash;


class PetController extends Controller
{   
    public function index()
    {
        $pets=Pet::all();
        return new PetCollection($pets);
    }
    public function show(Pet $pet)
    {
        return new PetResource($pet);
    }

    public function store(Request $request)
    {  
        $validator = Validator::make($request->all(),[
            'species'=>'required',
            'breed'=>'required', 
            'nickname'=>'required',
            'user_id'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->error());
        }
        $pet = Pet::create([
            'species'=>$request->species,
            'breed'=>$request->breed,
            'nickname'=>$request->nickname,
            'user_id'=>$request->user_id,
        ]);
        return response()->json( ["Pet is created successfully", new PetResource($pet)]);
    }
    public function update(Request $request, Pet $pet)
    {
        $validator = Validator::make($request->all(),[
            'species'=>'required|string|max:255',
            'breed'=>'required|string|max:255', 
            'nickname'=>'required|string|max:255',
            'user_id'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->error());
        }
        $pet->species =$request->species;
        $pet->breed =$request->breed;
        $pet->nickname =$request->nickname;
        $pet->user_id =$request->user_id;

        $pet->save();
        return response()->json( ["Pet is updated successfully", new PetResource($pet)]);
    }
    public function destroy(Pet $pet)
    {
        $pet->delete();
        return response()->json( ["Pet is deleted successfully"]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pet;
use Illuminate\Http\Request;

class UserPetController extends Controller
{
    public function index($user_id){
        $pets=Pet::get()->where('user_id',$user_id);
        if(is_null($pets)){
            return response()->json('Data not found',404);
        }
        return response()->json($pets);
    }
}

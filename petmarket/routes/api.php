<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\PetController;
use \App\Http\Controllers\UserPetController;
use \App\Http\Controllers\NecklaceController;
use \App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('users',[UserController::class, 'index']);
Route::get('users/{id}',[UserController::class, 'show']);
Route::resource('pets',PetController::class)->only(['index']);
Route::resource('necklaces', NecklaceController::class);

Route::get('users/{id}/pets', [UserPetController::class, 'index'])->name('users.pets.index');

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);


Route::group(['middleware'=>['auth:sanctum']], function(){ //ne moze da pristupi rutama ako user nije autorizovan
    Route::get('/profile',function(Request $request){
        return auth()->user();
    });
    Route::resource('pets',PetController::class)->only(['update', 'store', 'destroy']);
    Route::resource('necklaces',NecklaceController::class)->only(['update', 'store', 'destroy']);
    Route::post('/logout',[AuthController::class, 'logout']);

});


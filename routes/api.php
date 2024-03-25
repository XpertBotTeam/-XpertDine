<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\ReservationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('signup', 'App\Http\Controllers\API\AuthController@signup' );  
Route::get('signup', 'App\Http\Controllers\API\AuthController@signup' );  // user registration
Route::post('login', 'App\Http\Controllers\API\AuthController@login' )->name('login'); 
Route::get('login', 'App\Http\Controllers\API\AuthController@login' )->name('login');  // user login

Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::resource('reservations',ReservationController::class); 
});

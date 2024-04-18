<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\ActivitiesController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\GuestHousesController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\PasswordResetlinkController;
use App\Http\Controllers\Api\SearchController;

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

// USER AUTH
Route::post('signup', 'App\Http\Controllers\API\AuthController@signup' );  
Route::get('signup', 'App\Http\Controllers\API\AuthController@signup' );  // user registration
Route::post('signin', 'App\Http\Controllers\API\AuthController@signin' )->name('signin'); 
Route::get('signin', 'App\Http\Controllers\API\AuthController@sigin' )->name('signin');  // user login


// OWNER AUTH 
Route::get('register','App\Http\Controllers\API\OwnerAuthController@register');
Route::post('register','App\Http\Controllers\API\OwnerAuthController@register');
Route::get('login','App\Http\Controllers\API\OwnerAuthController@login');
Route::post('login','App\Http\Controllers\API\OwnerAuthController@login');



Route::group(['middleware'=>['auth:sanctum']],function(){
    
    Route::resource('reservation',ReservationController::class); 
    Route::resource('restaurant', RestaurantController::class);
});

Route::resource('guesthouses',GuestHousesController::class); 
Route::post("/activities", [ActivitiesController::class, 'store']);
Route::get('search', [SearchController::class, 'search'])->name('search');
//Route::get('search',[GuestHousesController::class],'search');

//forget password and Reset It
Route::post('forgot-password', [PasswordResetlinkController::class, 'sendResetPasswordEmail']);
Route::post('/password/reset/{token}', [ResetPasswordController::class, 'reset'])->name('password.update');
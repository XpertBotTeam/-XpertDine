<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\PasswordResetlinkController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\PasswordResetController;



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
Route::post('login', 'App\Http\Controllers\API\AuthController@login' )->name('login'); 
Route::get('login', 'App\Http\Controllers\API\AuthController@login' )->name('login');  // user login


// OWNER AUTH 
Route::get('register','App\Http\Controllers\API\OwnerAuthController@register');
Route::post('register','App\Http\Controllers\API\OwnerAuthController@register');
Route::get('login','App\Http\Controllers\API\OwnerAuthController@login');
Route::post('login','App\Http\Controllers\API\OwnerAuthController@login');



Route::group(['middleware'=>['auth:sanctum']],function(){
    
    Route::resource('reservation',ReservationController::class); 
    Route::resource('restaurant', RestaurantController::class);

    Route::post('forgot-password', [PasswordResetlinkController::class, 'store'])
    ->name('password.email');
    Route::post('reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');
});

Route::post('forgot-password', [PasswordResetlinkController::class, 'sendResetPasswordEmail']);
Route::post('/password/reset/{token}', [ResetPasswordController::class, 'reset'])->name('password.update');
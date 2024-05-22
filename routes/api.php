<?php

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\AddImagesController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Api\ActivitiesController;
use App\Http\Controllers\Api\GoogleAuthController;
use App\Http\Controllers\Api\RestaurantController;

use App\Http\Controllers\Api\GuesthousesController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\VerifiactionController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\PasswordResetlinkController;




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
Route::post('signup', 'App\Http\Controllers\API\AuthController@signup');  
Route::get('signup', 'App\Http\Controllers\API\AuthController@signup');  // user registration
Route::post('signin', 'App\Http\Controllers\API\AuthController@signin')->name('signin'); 
Route::get('signin/{id}', 'App\Http\Controllers\API\AuthController@signin')->name('signin');  // user login
//Route::delete('/delete/account/{token}','App\Http\Controllers\API\AuthController@destroy');

// OWNER AUTH 
Route::get('register','App\Http\Controllers\API\OwnerAuthController@register');
Route::post('register','App\Http\Controllers\API\OwnerAuthController@register');
Route::get('login','App\Http\Controllers\API\OwnerAuthController@login');
Route::post('login','App\Http\Controllers\API\OwnerAuthController@login');

//route for profile info
//Route::group(['middleware'=>['auth:sanctum']],function(){
Route::get('profile', [UserProfileController::class,'index']);
Route::get('profile/{token}', [UserProfileController::class,'show']);
Route::post('profile/update/{token}',[UserProfileController::class,'update']);
Route::delete('profile/delete', [UserProfileController::class, 'destroy']);
Route::post('logout', 'App\Http\Controllers\API\AuthController@logout');
//});



   

         // owner only route
         // Route::group(['middleware'=>['owner']],function() {
         // Route::get("myRestaurants",[MyRestaurantController::class,"index"]);
         // Route::post("addNewRestauant",[MyRestaurantController::class,"store"])->name("addnewrestauant");
         // Route::delete("deleterestauant/{id} ",[MyRestaurantController::class,"destroy"])->name("deleterestauant");
Route::resource('reservation',ReservationController::class); 
Route::resource('restaurant', RestaurantController::class);
Route::put('restaurant/update/{id}',[RestaurantController::class,'update']);




//route for guesthouses
Route::post('/guesthouses',[GuesthousesController::class,'store']);
Route::get('/guesthouses',[GuesthousesController::class,'index']);
Route::get('/guesthouses/{id}',[GuesthousesController::class,'show']);
Route::put('/guesthouses/update/{id}',[GuesthousesController::class,'update']);
Route::delete('/guesthouses/delete/{id}',[GuesthousesController::class,'destroy']);






Route::post('activities', [ActivitiesController::class, 'store']);
Route::get('activities', [ActivitiesController::class, 'index']);
Route::get('activities/{id}', [ActivitiesController::class, 'show']);
// route  For search  
Route::get('/searchR', [SearchController::class, 'SearchRestaurant']);
Route::get('/searchG', [SearchController::class, 'SearchGuestHouse']);
Route::get('/searchA', [SearchController::class, 'SearchActivities']);
//route for payment
Route::resource('/payment', PaymentController::class);

//route for filter
Route::get('/filterG', [FilterController::class, 'index']);
Route::get('/sortByPriceG', [FilterController::class, 'SortPriceGuesthouses']);


//route for GoogleAuth

Route::get('auth/google',[GoogleAuthController::class,'redirect']);
Route::get('auth/google/callback',[GoogleAuthController::class,'callbackGoogle']);

//forget password and Reset It
Route::post('/forgot-password', [PasswordResetlinkController::class, 'sendResetPasswordEmail']);
Route::post('/password/reset/{token}', [ResetPasswordController::class, 'reset'])->name('password.update');


//route for add images only 
Route::post('addimages',[AddImagesController::class,'store']);
Route::get('/showimages',[AddImagesController::class,'show']);


//route for verification 
Route::get('/email/resend',[VerifiactionController::class,'resend'])->name('verification.resend');
Route::post('/email/resend/',[VerifiactionController::class,'resend'])->name('verification.resend');
Route::post('email/verify/{id}/{hash}',[VerifiactionController::class,'verfiy'])->name('verification.verfiy');
//Auth::routes([
   // 'verify'=> true
//]);

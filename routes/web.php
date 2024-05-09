<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Api\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Welcome Page
Route::get('/', [RestaurantController::class, 'all']);

// Single Restaurant Informations
Route::get('/restaurant/{id}', [RestaurantController::class, 'single'])->name('restaurant.show');

// Reset Password
Route::get('/password/reset/{token}',  [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
//Route::get('/password/reset/{token}',  [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/password/reset/{token}', [ResetPasswordController::class, 'reset'])->name('password.update');

// Add a new Account
Route::get('/register', [AuthController::class, 'signupForm']);
Route::post('/signup', [AuthController::class, 'signup']);

Route::get('/searchR', [SearchController::class, 'SearchRestaurant'])->name('search');

// Add a new Account
Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/loginCheck', [AuthController::class, 'login']);

// Add a new Restaurant
Route::get('/create/restaurant', [RestaurantController::class, 'show']);
Route::post('/create/restaurantCheck', [RestaurantController::class, 'store']);

// Add a new Menu Item
Route::get('/create/menu', [MenuController::class, 'show']);
Route::post('/create/menuCheck', [MenuController::class, 'check']);

// Logout from account
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


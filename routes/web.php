<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ResetPasswordController;
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
Route::get('/', [RestaurantController::class, 'all']);

Route::get('/restaurant/{id}', [RestaurantController::class, 'single'])->name('restaurant.show');

Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::get('/register', [AuthController::class, 'signupForm']);

Route::post('/signup', [AuthController::class, 'signup']);

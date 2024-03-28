<?php

use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Support\Facades\Route;

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

Route::get('/restaurant/{title}', [RestaurantController::class, 'single']);

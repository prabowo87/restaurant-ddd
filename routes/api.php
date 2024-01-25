<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\RestaurantTableController;

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
Route::post('login', [AuthController::class,'loginUser'])->name('user-login');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('users', UserController::class);
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('logout', [AuthController::class,'logout'])->name('user-logout');
    Route::resource('tables', RestaurantTableController::class);
    Route::resource('reservations', ReservationController::class);
    Route::get('tables-available', [RestaurantTableController::class,'getAvailableRestaurantTables'])->name('tables-available');
});


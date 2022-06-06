<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RolesController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\PricesController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\TransportationController;

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

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// roles routes
Route::get('/roles', [RolesController::class , 'index']);
Route::get('/roles/{id}', [RolesController::class , 'show']);
Route::post('/roles', [RolesController::class ,'store']);
Route::put('/roles/{id}', [RolesController::class , 'update']);
Route::delete('/roles/{id}', [RolesController::class , 'destroy']);

// users routes
Route::get('/users', [UsersController::class , 'index']);
Route::get('/users/{id}', [UsersController::class ,'show']);
Route::post('/users', [UsersController::class, 'store']);
Route::put('/users/{id}', [UsersController::class,'update']);
Route::delete('/users/{id}', [UsersController::class,'destroy']);

// Transportation routes
Route::get('/transportation', [TransportationController::class, 'index']);
Route::get('/transportation/{id}', [TransportationController::class, 'show']);
Route::post('/transportation', [TransportationController::class, 'store']);
Route::put('/transportation/{id}', [TransportationController::class, 'update']);
Route::delete('/transportation/{id}', [TransportationController::class, 'destroy']);

// Prices routes
Route::get('/prices', [PricesController::class, 'index']);
Route::get('/prices/{id}', [PricesController::class, 'show']);
Route::post('/prices', [PricesController::class, 'store']);
Route::put('/prices/{id}', [PricesController::class, 'update']);
Route::delete('/prices/{id}', [PricesController::class, 'destroy']);

// Reservation routes
// Route::middleware('auth:sanctum')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::get('/reservations/{id}', [ReservationController::class, 'show']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::put('/reservations/{id}', [ReservationController::class, 'update']);
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);
// });

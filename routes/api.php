<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BillingController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/admin-only', function () {
        return response()->json(['message' => 'Welcome Admin']);
    })->middleware('role:admin');

    Route::get('/users', [UserController::class, 'index']);


    Route::get('/billings', [BillingController::class, 'index']);
    Route::get('/billings/{id}', [BillingController::class, 'show']);
    Route::post('/billings', [BillingController::class, 'store']);

});
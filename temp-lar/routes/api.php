<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ProductionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard/machine/{id}', [DashboardController::class, 'machine']);
Route::get('/production-orders', [ProductionController::class, 'orders']);
Route::post('/production-results', [ProductionController::class, 'store']);

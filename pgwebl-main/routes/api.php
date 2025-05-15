<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\Api\PointsApiController; // Ensure this class exists in the specified namespace

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/points', [ApiController::class, 'points'])->name('api.points');
Route::get('/polylines', [ApiController::class, 'polylines'])->name('api.polylines');
Route::get('/polygons', [ApiController::class, 'polygons'])->name('api.polygons');


Route::get('/points', [PointsController::class, 'getPoints']);


// Ensure the PointsApiController class is correctly defined and imported
Route::get('/points', [PointsApiController::class, 'index'])->name('api.points');

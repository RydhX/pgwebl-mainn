<?php

use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolylinesController;
use App\Http\Controllers\PolygonsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PointController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PointsController::class, 'index'])->name('map');


Route::get('/table', [TableController::class, 'index'])->name('table');


Route::resource('points', PointsController::class);

Route::resource('polylines', PolylinesController::class);

Route::resource('polygons', PolygonsController::class);



Route::patch('/points/{id}', [PointController::class, 'update'])->name('points.update');



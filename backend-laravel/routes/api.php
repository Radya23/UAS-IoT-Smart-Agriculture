<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;

Route::post('/sensor', [SensorController::class, 'store']);
Route::get('/sensor/latest', [SensorController::class, 'latest']);
Route::post('/sensor/update-status', [SensorController::class, 'updateStatus']);
Route::get('/sensor/status', [SensorController::class, 'getStatus']);
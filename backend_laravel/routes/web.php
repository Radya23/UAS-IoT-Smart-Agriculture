<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;

Route::get('/', [SensorController::class, 'index']);
Route::post('/api/sensor/update-pompa', [SensorController::class, 'updatePompa']);
Route::get('/api/sensor/status', [SensorController::class, 'getStatus']);
Route::get('/api/sensor/histori', [SensorController::class, 'getHistori']);
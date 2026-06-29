<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;

Route::post('/sensor/update-otomatis', [SensorController::class, 'updateSensor']);
Route::get('/sensor/status', [SensorController::class, 'getStatus']);
Route::get('/sensor/histori', [SensorController::class, 'getHistori']);

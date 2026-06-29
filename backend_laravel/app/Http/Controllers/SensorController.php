<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SensorController extends Controller 
{
    public function index() {
        return view('dashboard');
    }

    // Fungsi baru: ESP32 akan memanggil ini setiap 3 detik untuk mengirim data kelembapan
public function updateSensor(Request $request) {
    // Debugging: Log data yang diterima ke file log Laravel
    // agar kita tahu apa yang sebenarnya dikirim ESP32
    \Log::info('Data diterima:', $request->all());

    $kelembapan = $request->input('kelembapan');
    $status = $request->input('status');
    
    DB::table('sensor_data')->insert([
        'encoded_data' => $kelembapan, // Pastikan ini nilainya bukan 0
        'status_pompa' => $status,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    
    return response()->json(['message' => 'Sukses']);
}

public function getStatus() {
    // Ambil baris terakhir, tidak peduli apa status pompanya
    $latest = DB::table('sensor_data')->latest('created_at')->first();
    
    return response()->json([
        'status' => $latest ? $latest->status_pompa : 'OFF',
        // Pastikan kita mengambil encoded_data sebagai angka
        'kelembapan' => ($latest && is_numeric($latest->encoded_data)) ? (int)$latest->encoded_data : 0
    ]);
}

    public function getHistori() {
        return response()->json(DB::table('sensor_data')->latest()->limit(10)->get());
    }
}
